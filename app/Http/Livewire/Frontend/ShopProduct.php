<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopProduct extends Component
{
    use WithPagination;

    protected $products;
    public $paginate = 8;
    public $slug;
    public $sort = 'default';
    protected $paginationTheme = 'bootstrap';


    public function mount($slug = null)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        switch ($this->sort) {
            case 'default':
                $sort_failed = 'created_at';
                $sort_type = 'desc';
                break;
            case 'lowePrice':
                $sort_failed = 'price';
                $sort_type = 'asc';
                break;
            case 'highPrice':
                $sort_failed = 'price';
                $sort_type = 'desc';
                break;
            default:
                $sort_failed = 'created_at';
                $sort_type = 'desc';

        }
        if ($this->slug) {
            $this->products = Product::with('media')->CategoriesBySlug($this->slug);
        } else {
            $this->products = Product::with('translations', 'media');
        }
        $products = $this->products->orderBy($sort_failed, $sort_type)->paginate($this->paginate);
        $categories = Category::whereNotNull('parent_id')->with('translations')->get()->toTree();
        return view('livewire.frontend.shop-product', ['categories' => $categories, 'products' => $products])->extends('layouts.frontend.app');
    }
}
