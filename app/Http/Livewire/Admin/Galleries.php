<?php

namespace App\Http\Livewire\Admin;

use App\Models\Gallery;
use App\Models\Product;
use Livewire\Component;

class Galleries extends Component
{
    protected $listeners = [
        'delete',
        'refreshComponent' => '$refresh'
    ];

    public function deleteGallery($id)
    {
        $this->dispatchBrowserEvent('deleteGallery', ['id' => $id]);
    }

    public function delete($id)
    {
        $gallery = Gallery::query()->find($id);
        $path = public_path() . '/images/admin/products/big/' . $gallery->image;
        $path1 = public_path() . '/images/admin/products/small/' . $gallery->image;
        unlink($path);
        unlink($path1);
        $gallery->delete();
        $this->emit('refreshComponent');
    }


    public function render()
    {
        $galleries = Gallery::query()->get();
        return view('livewire.admin.galleries', compact('galleries'));
    }
}
