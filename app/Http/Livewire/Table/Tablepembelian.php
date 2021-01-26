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
use App\Models\Stok;

class Tablepembelian extends Component
{
    use WithPagination;

    public $model;
    public $name;

    public $perPage = 10;
    public $sortField = "namabarang";
    public $sortAsc = true;
    public $search = '';
    public $isOpen = 0;
    public $action;
    public $button;

    //Pembelian
    public $pembelian;
    public $idpembelian;
    public $tanggal;
    public $barang_id;
    public $hargabeli;
    public $total;
    public $bayar;
    public $kembali;
    public $jumlah;

    protected $rules = [
        'barang_id' => 'required',
        'tanggal' => 'required',
        'jumlah' => 'required|numeric',
    ];
    protected $messages = [
        'barang_id.required' => 'Nama Barang Harus di isi',
        'jumlah.numeric' => 'Jumlah Harus Berupa Angka',
        'jumlah.required' => 'Jumlah Barang Harus di isi',
        'tanggal.required' => 'Tanggal Harus di isi',
    ];
    protected $listeners = ["deleteItem" => "delete_item"];

    public function showModal()
    {
        $this->isOpen = true;
        //$cek = Auth::user()->name;
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
            case 'pembelian':
                $pembelians = $this->model::search($this->search)
                    ->join('barang', 'barang.id', '=', 'pembelian.barang_id')
                    ->select(
                        'barang.namabarang as namabarang',
                        'pembelian.id as id',
                        'pembelian.jumlah as jumlah',
                        'pembelian.total as total',
                        'pembelian.tanggal as tanggal',
                        'pembelian.user as user',
                    )
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                $barang = Barang::get();
                if (!empty($this->barang_id)) {
                    $cari = Barang::find($this->barang_id);
                    $this->hargabeli = Konversi::rupiah($cari->hargabeli);
                }
                $this->total = Konversi::rupiah(intval($this->jumlah) * intval(Konversi::angka($this->hargabeli)));
                return [
                    "view" => 'livewire.table.pembelian',
                    "pembelians" => $pembelians,
                    'barang' => $barang,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => 'showModal()',
                            'create_new_text' => 'Pembelian',
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
        $this->hargabeli = '';
        $this->total = '';
        $this->jumlah = '';
        $this->tanggal = gmdate('Y-m-d');
    }
    public function store()
    {
        $data = [
            'barang_id' => $this->barang_id,
            'total' => Konversi::angka($this->total),
            'jumlah' => $this->jumlah,
            'tanggal' => $this->tanggal,
            'user' => Auth::user()->name,
        ];
        $this->validate();
        $this->model::updateOrCreate(['id' => $this->idpembelian], $data);
        $jumlahstok = Pembelian::where('barang_id', $this->barang_id)->sum('jumlah');
        $datastok = [
            'barang_id' => $this->barang_id,
            'jumlah' => $jumlahstok,
        ];
        Stok::updateOrCreate(['barang_id' => $this->barang_id], $datastok);
        $this->clearVar();
        $this->emit('saved'); /* Untuk Menampilkan Message Toast ke x-jet-nofity-message di modal */
        $this->hideModal();
    }
    public function edit($id)
    {
        $cari = $this->model::findOrFail($id);
        $this->idpembelian = $id;
        $this->tanggal = date('Y-m-d', strtotime($cari->tanggal));
        $this->barang_id = $cari->barang_id;
        $this->jumlah = $cari->jumlah;
        $this->showModal();
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

        $data->delete();
        $this->emit('deleteResult', [
            'status' => true,
            'message' => 'Data ' . $this->name . ' berhasil di hapus !'
        ]);
    }

    public function render()
    {
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
