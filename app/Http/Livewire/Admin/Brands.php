<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class Brands extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'delete',
        'refreshComponent' => '$refresh'
    ];

    public function deleteBrand($id)
    {
        $this->dispatchBrowserEvent('deleteBrand', ['id' => $id]);
    }

    public function delete($id)
    {
        Brand::query()->find($id)->delete();
        $this->emit('refreshComponent');
    }


    public function render()
    {
        $brands = Brand::query()->where('title', 'like', '%' . $this->search . '%')->
        paginate(5);
        return view('livewire.admin.brands', compact('brands'));
    }
}
