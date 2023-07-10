<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'delete',
        'refreshComponent' => '$refresh'
    ];

    public function deleteProduct($id)
    {
        $this->dispatchBrowserEvent('deleteProduct', ['id' => $id]);
    }

    public function delete($id)
    {
        $product = Product::query()->find($id);
        $path = public_path() . '/images/admin/products/big/' . $product->image;
        $path1 = public_path() . '/images/admin/products/small/' . $product->image;
        unlink($path);
        unlink($path1);
        $product->delete();

        $this->emit('refreshComponent');
    }


    public function render()
    {
        $products = Product::query()->
        where('title', 'like', '%' . $this->search . '%')->
        orWhere('title_en', 'like', '%' . $this->search . '%')->
        orWhere('price', 'like', '%' . $this->search . '%')->
        orWhere('brand_id', 'like', '%' . $this->search . '%')->
        orWhere('category_id', 'like', '%' . $this->search . '%')->
        paginate(5);
        return view('livewire.admin.products', compact('products'));
    }

}
