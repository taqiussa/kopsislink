<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;

class Kopsis extends Component
{
    use WithPagination;

    public $model;
    public $name;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    protected $listeners = ["deleteItem" => "delete_item"];

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
                            'create_new' => route('barang'),
                            'create_new_text' => 'Buat Barang Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'stok':
                $stoks = $this->model::search($this->search)
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

    public function delete_item($id)
    {
        $data = $this->model::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data " . $this->name
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->name . " berhasil dihapus!"
        ]);
    }

    public function render()
    {
        $data = $this->get_pagination_data();

        return view($data['view'], $data);
    }
}
