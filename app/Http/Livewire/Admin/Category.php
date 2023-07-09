<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'delete',
        'refreshComponent' => '$refresh'
    ];

    public function deleteCategory($id)
    {
        $this->dispatchBrowserEvent('deleteCategory', ['id' => $id]);
    }

    public function delete($id)
    {
        \App\Models\Category::query()->find($id)->delete();
        $this->emit('refreshComponent');
    }

    public function render()
    {
        $categories = \App\Models\Category::query()->
        where('title', 'like', '%' . $this->search . '%')->
        paginate(5);
        return view('livewire.admin.category', compact('categories'));
    }

}
