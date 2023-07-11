<?php

namespace App\Http\Livewire\Admin;

use App\Models\PropertyGroup;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyGroups extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'delete',
        'refreshComponent' => '$refresh'
    ];

    public function deletePropertyGroup($id)
    {
        $this->dispatchBrowserEvent('deletePropertyGroup', ['id' => $id]);
    }

    public function delete($id)
    {
        PropertyGroup::query()->find($id)->delete();
        $this->emit('refreshComponent');
    }


    public function render()
    {
        $property_groups = PropertyGroup::query()->where('title', 'like', '%' . $this->search . '%')->
        paginate(5);
        return view('livewire.admin.property-groups', compact('property_groups'));
    }
}
