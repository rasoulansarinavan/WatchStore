<?php

namespace App\Http\Livewire\Admin;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class Properties extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'delete',
        'refreshComponent' => '$refresh'
    ];

    public function deleteProperty($id)
    {
        $this->dispatchBrowserEvent('deleteProperty', ['id' => $id]);
    }

    public function delete($id)
    {
        Property::query()->find($id)->delete();
        $this->emit('refreshComponent');
    }

    public function render()
    {
        $properties = Property::query()->
        where('title', 'like', '%' . $this->search . '%')->
        paginate(5);
        return view('livewire.admin.properties', compact('properties'));
    }
}
