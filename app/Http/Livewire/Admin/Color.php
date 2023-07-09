<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Colors;
use Livewire\Component;
use Livewire\WithPagination;

class Color extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'delete',
        'refreshComponent' => '$refresh'
    ];

    public function deleteColor($id)
    {
        $this->dispatchBrowserEvent('deleteColor', ['id' => $id]);
    }

    public function delete($id)
    {
        Colors::query()->find($id)->delete();
        $this->emit('refreshComponent');
    }


    public function render()
    {
        $colors= Colors::query()->where('title', 'like', '%' . $this->search . '%')->paginate(5);
        return view('livewire.admin.colors', compact('colors'));
    }
}
