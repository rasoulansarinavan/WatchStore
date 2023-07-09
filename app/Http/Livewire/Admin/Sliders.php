<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class Sliders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'delete',
        'refreshComponent' => '$refresh'
    ];

    public function deleteSlider($id)
    {
        $this->dispatchBrowserEvent('deleteSlider', ['id' => $id]);
    }

    public function delete($id)
    {
        Slider::query()->find($id)->delete();
        $this->emit('refreshComponent');
    }


    public function render()
    {
        $sliders = Slider::query()->
        where('title', 'like', '%' . $this->search . '%')->
        paginate(5);
        return view('livewire.admin.sliders', compact('sliders'));
    }
}
