<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class Colors extends Component
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
        Color::query()->find($id)->delete();
        $this->emit('refreshComponent');
    }


    public function render()
    {
        $colors = Color::query()->where('title', 'like', '%' . $this->search . '%')->
        paginate(5);
        return view('livewire.admin.colors', compact('colors'));
    }
}
