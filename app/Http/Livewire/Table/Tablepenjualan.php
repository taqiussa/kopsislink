<?php

namespace App\Http\Livewire\Table;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\KopsisController;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Table\Konversi;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Stok;
use App\Models\Trans;
use App\Models\Transaksi;

class Tablepenjualan extends Component
{
    use WithPagination;

    public $model;
    public $name;

    public $perPage = 10;
    public $sortField = "tanggal";
    public $sortAsc = false;
    public $search = '';
    public $isOpen = 0;
    public $action;
    public $button;

    //penjualan
    public $penjualan;
    public $idpenjualan;
    public $tanggal;
    public $barang_id;
    public $total;
    public $jumlah;
    public $stok;
    public $info;
    public $kembalian;
    public $pembayaran;

    protected $rules = [
        'barang_id' => 'required|unique:transaksi',
        'tanggal' => 'required',
        'jumlah' => 'required|numeric',
    ];
    protected $messages = [
        'barang_id.required' => 'Nama Barang Harus di isi',
        'barang_id.unique' => 'Barang Tidak boleh sama',
        'jumlah.numeric' => 'Jumlah Harus Berupa Angka',
        'jumlah.required' => 'Jumlah Barang Harus di isi',
        'tanggal.required' => 'Tanggal Harus di isi',
    ];
    protected $listeners = [
        "deleteItem" => "delete_item"
    ];

    public function showModal()
    {
        $this->isOpen = true;
    }
    public function hideModal()
    {
        $this->resetErrorBag();
        $this->clearVar();
        $this->isOpen = false;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function get_pagination_data()
    {
        switch ($this->name) {
            case 'penjualan':
                $penjualans = $this->model::search($this->search)
                    ->join('barang', 'barang.id', '=', 'penjualan.barang_id')
                    ->select(
                        'barang.namabarang as namabarang',
                        'barang.keterangan as keterangan',
                        'penjualan.id as id',
                        'penjualan.jumlah as jumlah',
                        'penjualan.total as total',
                        'penjualan.tanggal as tanggal',
                        'penjualan.user as user',
                    )
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                $transaksi = Transaksi::join('barang', 'barang.id', '=', 'transaksi.barang_id')
                    ->select(
                        'barang.namabarang as namabarang',
                        'transaksi.id as id',
                        'transaksi.jumlah as jumlah',
                        'transaksi.harga as harga',
                        'transaksi.total as total',
                    )
                    ->orderBy('barang.namabarang', 'asc')->get();
                $barang = Barang::get();
                if (!empty($this->barang_id)) {
                    $cari = Barang::find($this->barang_id);
                    $this->stok = 'Stok : ' . $cari->jumlah;
                }
                if (!empty($this->jumlah)) {
                    $cari2 = Barang::find($this->barang_id);
                    $cek = $cari2->jumlah - $this->jumlah;
                    if ($cek < 0) {
                        $this->info = 'Jumlah tidak boleh melebihi Stok';
                    } else {
                        $this->info = '';
                    }
                }
                $totaljual = Transaksi::sum('total');
                $this->total = Konversi::rupiah($totaljual);
                Konversi::rupiah(intval($this->pembayaran));
                $kembali = intval($this->pembayaran) - (Konversi::angka($totaljual));
                $this->kembalian = Konversi::rupiah($kembali);
                return [
                    "view" => 'livewire.table.penjualan',
                    "penjualans" => $penjualans,
                    'transaksi' => $transaksi,
                    'barang' => $barang,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => 'showModal()',
                            'create_new_text' => 'penjualan',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            default:
                # code...
                break;
        }
    }
    public function clearVar()
    {

        $this->barang_id = '';
        $this->jumlah = '';
        $this->stok = '';
        $this->info = '';
        $this->pembayaran = '';
        $this->tanggal = gmdate('Y-m-d');
    }
    public function add()
    {
        $barang = Barang::where('id', $this->barang_id)->first();
        $data = [
            'tanggal' => $this->tanggal,
            'barang_id' => $this->barang_id,
            'jumlah' => $this->jumlah,
            'harga' => $barang->hargajual,
            'total' => ($barang->hargajual * $this->jumlah),
            'user' => Auth::user()->name,
        ];
        $this->validate();
        $cari2 = Barang::find($this->barang_id);
        $cek = $cari2->jumlah - $this->jumlah;
        if ($cek < 0) {
            $this->info = 'Jumlah tidak boleh melebihi Stok';
        } else {
            $this->info = '';
            Transaksi::create($data);
            $this->emit('saved');
        }
        $this->clearVar();
    }
    public function store()
    {
        $trans = Transaksi::get();
        foreach ($trans as $t) {
            $data = [
                'tanggal' => $t->tanggal,
                'barang_id' => $t->barang_id,
                'jumlah' => $t->jumlah,
                'total' => $t->total,
                'user' => $t->user,
            ];
            $jumlahjual = $t->jumlah;
            $barang = Barang::where('id', $t->barang_id)->first();
            $jumlahstok = ($barang->jumlah) - $jumlahjual;
            Barang::where('id', $t->barang_id)->update(['jumlah' => $jumlahstok]);
            Penjualan::create($data);
        }
        Transaksi::truncate();
        $this->clearVar();
        $this->emit('saved');
        $this->hideModal();
    }
    public function mount()
    {
        $this->button = create_button($this->action, 'Barang');
        // this button untuk menampilkan emit atau message toast 
    }
    public function delete_item($id)
    {
        $data = $this->model::find($id);
        if (!$data) {
            $this->emit('deleteResult', [
                'status' => false,
                'message' => 'Gagal menghapus data' . $this->name
            ]);
            return;
        }
        $barang = Barang::find($data->barang_id);
        $jumlahbaru = $barang->jumlah + $data->jumlah;
        $barang->update(['jumlah' => $jumlahbaru]);
        $data->delete();
        $this->emit('deleteResult', [
            'status' => true,
            'message' => 'Data ' . $this->name . ' berhasil di hapus !'
        ]);
    }
    public function delete_t($id)
    {

        $data = Transaksi::find($id);
        if (!$data) {
            $this->emit('deleteResult', [
                'status' => false,
                'message' => 'Gagal menghapus data Transaksi'
            ]);
            return;
        }
        $data->delete();
        $this->emit('saved');
    }

    public function render()
    {
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
