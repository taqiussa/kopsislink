<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;

class Tablestok extends Component
{
    use WithPagination;

    public $model;
    public $name;

    public $perPage = 10;
    public $sortField = "namabarang";
    public $sortAsc = true;
    public $search = '';


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
            case 'stok':
                $stoks = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.stok',
                    "stoks" => $stoks,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => '',
                            'create_new_text' => 'Disabled',
                            'export' => '',
                            'export_text' => 'Disabled'
                        ]
                    ])
                ];
                break;
            default:
                # code...
                break;
        }
    }

    public function render()
    {
        $data = $this->get_pagination_data();

        return view($data['view'], $data);
    }
}
