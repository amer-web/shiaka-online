<div class="mini-cart-wrapper">
    <div class="mini-cart">
        <div class="mini-cart-header">
            YOUR CART
            <button type="button" class="button ion ion-md-close" id="mini-cart-close"></button>
        </div>
        <ul class="mini-cart-list">
            @forelse(cartItems() as $product)
                <li class="clearfix">
                    <a href="{{route('product.details',$product->model->slug)}}">
                        <img src="{{ asset($product->model->get_image()) }}" alt="Product">
                        <span class="mini-item-name">{{$product->model->name}}</span>
                        <span class="mini-item-price d-inline-block">{{$product->model->currencyPrice()}}</span>
                        <div class="d-inline-block">x</div>
                        <span class="mini-item-quantity"> {{$product->qty}}</span>
                    </a>
                </li>
            @empty
            @endforelse
        </ul>
        <div class="mini-shop-total clearfix">
            <span class="mini-total-heading float-left">Total:</span>
            <span class="mini-total-price float-right">{{ currency(getNumbers()->get('total')) }}</span>
        </div>
        <div class="mini-action-anchors">
            <a href="{{route('frontend.cart')}}" class="cart-anchor">View Cart</a>
            <a href="{{route('frontend.checkout')}}" class="checkout-anchor">Checkout</a>
        </div>
    </div>
</div>
