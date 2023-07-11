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
    public $product_id;

    public function deleteGallery($product_id, $id)
    {
        $this->dispatchBrowserEvent('deleteGallery', ['product_id' => $product_id, 'id' => $id]);
    }

    public function delete($product_id, $id)
    {
        $gallery = Gallery::query()->where('product_id', $product_id)->where('id', $id)->first();
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
