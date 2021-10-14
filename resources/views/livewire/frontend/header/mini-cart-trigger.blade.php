<div class="col-lg-4 col-md-3 col-sm-6 justify-content-center">
    <nav>
        <ul class="mid-nav g-nav">
            <li class="u-d-none-lg">
                <a href="{{url('/')}}">
                    <i class="ion ion-md-home u-c-brand"></i>
                </a>
            </li>
            <li class="u-d-none-lg">
                <a href="{{route('frontend.wishlist')}}">
                    <i class="far fa-heart">
                        @if($countWishlist > 0)
                            <span class="item-counter">{{$countWishlist}}</span>
                        @endif
                    </i>
                </a>
            </li>
            <li>
                <a id="mini-cart-trigger">
                    <i class="ion ion-md-basket"></i>
                    @if($countCart > 0)
                        <span class="item-counter">{{$countCart}}</span>
                        <span class="item-price">{{$totalCart }}</span>
                    @endif
                </a>
            </li>
        </ul>
    </nav>
</div>
