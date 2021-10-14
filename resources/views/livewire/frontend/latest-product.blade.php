<div wire:ignore class="tab-pane active show fade" id="men-latest-products">
    <div class="slider-fouc">
        <div class="products-slider owl-carousel" data-item="4">
            @forelse($products as $product)
                <div class="item">
                    <div class="image-container">
                        <a class="item-img-wrapper-link" href="{{  route('product.details',  $product->slug) }}">
                            <img style="height: 287px !important;" class="img-fluid" src="{{asset($product->get_image())}}"
                                 alt="Product">
                        </a>
                        <div class="item-action-behaviors">
                            <a wire:click="$emit('viewProduct','{{$product->id}}')" class="item-quick-look" data-toggle="modal"  data-target="#quick-view">Quick
                                Look
                            </a>
                            {{--                        <a class="item-mail" href="javascript:void(0)">Mail</a>--}}
                            <a class="item-addwishlist" wire:click.prevent="$emit('addToWishlistComponent','{{$product->id}}')">Add to
                                Wishlist</a>
                            <a class="item-addCart" wire:click.prevent="$emit('addToCartComponent','{{$product->id}}')">Add to Cart</a>
                        </div>
                    </div>
                    <div class="item-content">
                        <div class="what-product-is">
                            <ul class="bread-crumb">
                                <li class="has-separator">
                                    <a href="shop-v1-root-category.html">Men's</a>
                                </li>
                                <li class="has-separator">
                                    <a href="shop-v2-sub-category.html">Tops</a>
                                </li>
                                <li>
                                    <a href="shop-v3-sub-sub-category.html">Hoodies</a>
                                </li>
                            </ul>
                            <h6 class="item-title">
                                <a href="single-product.html">{{$product->name}}</a>
                            </h6>
                            <div class="item-stars">
                                <div class='star' title="{{getRate($product)->get('titleRate')}}">
                                    <span style="width:{{getRate($product)->get('widthRate') }}"></span>
                                </div>
                                <span>({{$product->reviews_count}})</span>
                            </div>
                        </div>
                        <div class="price-template">
                            <div class="item-new-price">
                                 {{ $product->currencyPrice() }}
                            </div>
                            <div class="item-old-price">
                                $60.00
                            </div>
                        </div>
                    </div>
                    <div class="tag new">
                        <span>NEW</span>
                    </div>
                </div>

            @empty
                no product
            @endforelse
        </div>
    </div>

</div>
@push('scripts')
    <script>
        // $('.item-quick-look').click(function () {
        //     window.livewire.emit('viewProduct','510');
        //     $("#quick-view").modal('show');
        // });
    </script>
@endpush
{{--wire:click="$emit('viewProduct','{{$product->id}}')"--}}
