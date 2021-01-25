<?php

namespace App\Http\Livewire\Table;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\KopsisController;
use Illuminate\Support\Facades\Auth;

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
    public $namabarang;
    public $jumlah;
    public $hargabeli;
    public $hargajual;

    protected $rules = [
        'namabarang' => 'required',
    ];
    protected $messages = [
        'namabarang.required' => 'Nama Barang Harus di isi',
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
            case 'barang':
                $barangs = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.barang',
                    "barangs" => $barangs,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => 'showModal()',
                            'create_new_text' => 'Buat Barang Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'stok':
                $stoks = $this->model::search($this->search)
                    ->join('barang', 'barang.id', '=', 'stok.barang_id')
                    ->select(
                        'barang.namabarang as namabarang',
                        'stok.id as id',
                        'stok.hargabeli as hargabeli',
                        'stok.hargajual as hargajual',
                        'stok.jumlah as jumlah',
                    )
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.stok',
                    "stoks" => $stoks,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('stok'),
                            'create_new_text' => 'Buat stok Baru',
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

        $this->namabarang = '';
        $this->keterangan = '';
        // $this->tanggal = gmdate('Y-m-d');

    }
    public function store()
    {
        $data = [
            'namabarang' => $this->namabarang,
            'keterangan' => $this->keterangan,
        ];
        $this->validate();
        $this->model::updateOrCreate(['id' => $this->idbarang], $data);
        $this->clearVar();
        $this->emit('saved'); /* Untuk Menampilkan Message Toast ke x-jet-nofity-message di modal */
        $this->hideModal();
    }
    public function edit($id)
    {
        $cari = $this->model::findOrFail($id);
        $this->idbarang = $id;
        // $this->tanggal = date('Y-m-d', strtotime($cari->tanggal));
        $this->nama = $cari->nama;
        $this->keterangan = $cari->keterangan;
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
