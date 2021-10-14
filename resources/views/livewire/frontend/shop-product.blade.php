<div>
{{--    {{dd($products)}}--}}
<!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Shop</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="home.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="shop-v1-root-category.html">Shop</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Shop-Page -->
    <div class="page-shop u-s-p-t-80">
        <div class="container">
            <!-- Shop-Intro -->
            <div class="shop-intro">
                <h3>Men's Clothing</h3>
            </div>
            <!-- Shop-Intro /- -->
            <div class="row">
                <!-- Shop-Left-Side-Bar-Wrapper -->
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <!-- Fetch-Categories-from-Root-Category  -->
                    <div class="fetch-categories">
                        <h3 class="title-name">Browse Categories</h3>
                        <!-- Level-2 -->
                        @foreach($categories as $category)
                            <h3 class="fetch-mark-category">
                                <a href="{{route('frontend.shop',$category->slug)}}">{{$category->name}}
                                    <span class="total-fetch-items">({{$category->getAllProducts()}})</span>
                                </a>
                            </h3>
                            <!-- Level-2 /- -->
                            <!-- Level-3 -->
                            @forelse($category->children as $subCategory)
                                <ul>
                                    <li>
                                        <a href="{{route('frontend.shop',$subCategory->slug)}}">{{$subCategory->name}}
                                            <span class="total-fetch-items">({{$subCategory->getAllProducts()}})</span>
                                        </a>
                                    </li>

                                </ul>
                            @empty
                                <ul>
                                    <li>
                                    </li>

                                </ul>
                            @endforelse
                        <!-- Level-3 /- -->
                        @endforeach
                    </div>
                    <!-- Fetch-Categories-from-Root-Category  /- -->
                </div>
                <!-- Shop-Left-Side-Bar-Wrapper /- -->
                <!-- Shop-Right-Wrapper -->
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <!-- Page-Bar -->
                    <div class="page-bar clearfix">
                        <div class="shop-settings">
                            <a id="list-anchor" class="active">
                                <i class="fas fa-th-list"></i>
                            </a>
                            <a id="grid-anchor">
                                <i class="fas fa-th"></i>
                            </a>
                        </div>
                        <!-- Toolbar Sorter 1  -->
                        <div class="toolbar-sorter">
                            <div class="select-box-wrapper">
                                <label class="sr-only" for="sort-by">Sort By</label>
                                <select wire:model="sort" class="select-box" id="sort-by">
                                    <option selected="selected" value="default">Sort By: Latest</option>
                                    <option value="">Sort By: Best Selling</option>
                                    <option value="lowePrice">Sort By: Lowest Price</option>
                                    <option value="highPrice">Sort By: Highest Price</option>
                                    <option value="">Sort By: Best Rating</option>
                                </select>
                            </div>
                        </div>
                        <!-- //end Toolbar Sorter 1  -->
                        <!-- Toolbar Sorter 2  -->
                        <div class="toolbar-sorter-2">
                            <div class="select-box-wrapper">
                                <label class="sr-only" for="show-records">Show Records Per Page</label>
                                <select wire:model="paginate" class="select-box" id="show-records">
                                    <option selected="selected" value="8">Show: 8</option>
                                    <option value="16">Show: 16</option>
                                    <option value="28">Show: 28</option>
                                </select>
                            </div>
                        </div>
                        <!-- //end Toolbar Sorter 2  -->
                    </div>
                    <!-- Page-Bar /- -->
                    <!-- Row-of-Product-Container -->
                    <div class="row product-container list-style">

                        @forelse($products as $product)
                            <div class="product-item col-lg-4 col-md-6 col-sm-6">
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link"
                                           href="{{route('product.details',$product->slug)}}">
                                            <img class="img-fluid" src="{{asset($product->get_image())}}" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a wire:click.prevent="$emit('viewProduct','{{$product->id}}')"
                                               class="item-quick-look" data-toggle="modal" data-target="#quick-view">Quick
                                                Look</a>
                                            {{--                                            <a class="item-mail" href="javascript:void(0)">Mail</a>--}}
                                            <a class="item-addwishlist"
                                               wire:click.prevent="$emit('addToWishlistComponent','{{$product->id}}')">Add
                                                to Wishlist</a>
                                            <a class="item-addCart"
                                               wire:click.prevent="$emit('addToCartComponent','{{$product->id}}')">Add
                                                to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb separatorContent">
                                                @foreach($product->ancestorsProduct() as $category)
                                                    <li class="">
                                                        <a href="{{route('frontend.shop',$category->slug)}}">{{$category->name}}</a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{route('product.details',$product->slug)}}">{{$product->name}}</a>
                                            </h6>
                                            <div class="item-description">
                                                {!! $product->description !!}
                                            </div>
                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span>(23)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                {{$product->price}}
                                            </div>
                                            <div class="item-old-price">
                                                $60.00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <!-- Row-of-Product-Container /- -->
                </div>
                <!-- Shop-Right-Wrapper /- -->
                <!-- Shop-Pagination -->
                <div  class="col justify-content-center">
                    {!! $products->appends(request()->all())->onEachSide(1)->links() !!}
                </div>


                <!-- Shop-Pagination /- -->
            </div>
        </div>
    </div>
    <!-- Shop-Page /- -->
</div>
@push('styles')
    <style>
        .separatorContent > li:after {
            content: ' >';
        }

        .separatorContent > li:last-child:after {
            content: '';
        }
    </style>
@endpush
@push('scripts')
    <script>

            let $shopProductContainer = $('.product-container');
            const attachClickGridAndList = function () {
                $('#list-anchor').on('click', function () {
                    $(this).addClass('active');
                    $(this).next().removeClass('active');
                    $shopProductContainer.removeClass('grid-style');
                    $shopProductContainer.addClass('list-style');
                });
                $('#grid-anchor').on('click', function () {
                    $(this).addClass('active');
                    $(this).prev().removeClass('active');
                    $shopProductContainer.removeClass('list-style');
                    $shopProductContainer.addClass('grid-style');
                });
            };
            console.log('amer lolo');
            attachClickGridAndList();

    </script>
@endpush
