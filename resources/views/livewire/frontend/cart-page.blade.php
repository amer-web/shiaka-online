<div>

    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Cart</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="home.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="cart.html">Cart</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Cart-Page -->
    <div class="page-cart u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Products-List-Wrapper -->
                    <div class="table-wrapper u-s-m-b-60">
                        <table>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td>
                                        <div class="cart-anchor-image">
                                            <a href="{{route('product.details',$item->model->slug)}}">
                                                <img src="{{asset($item->model->get_image()) }}" alt="Product">
                                                <h6>{{$item->model->name}}</h6>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="cart-price">
                                            {{$item->model->currencyPrice()}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="cart-quantity">
                                            <div class="quantity">
                                                <input readonly type="text" class="quantity-text-field"
                                                       value="{{$item->qty}}">
                                                <a wire:click.prevent="inCreaseQuantityProduct('{{$item->rowId}}')"
                                                   class="plus-a" data-max="1000">&#43;</a>
                                                <a wire:click.prevent="deCreaseQuantityProduct('{{$item->rowId}}')"
                                                   class="minus-a" data-min="1">&#45;</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="cart-price">
                                           {{currency($item->subtotal()) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-wrapper">
                                            <button wire:click.prevent="itemRemove('{{$item->rowId}}')"
                                                    class="button button-outline-secondary fas fa-trash"></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Products-List-Wrapper /- -->
                    <!-- Coupon -->
                    <div class="coupon-continue-checkout u-s-m-b-60">
                        @if($countCart > 0)
                            <div  class="coupon-area">
                                <h6>Enter your coupon code if you have one.</h6>
                                <form wire:submit.prevent="">
                                    <div class="coupon-field">
                                        <label class="sr-only" for="coupon-code">Apply Coupon</label>
                                        @if(!session()->has('coupon'))
                                            <input wire:model.defer="coupon_code" id="coupon-code" type="text"
                                                   class="text-field"
                                                   placeholder="Coupon Code">
                                            <button wire:click.prevent="applyDiscount()" type="submit" class="button">
                                                Apply Coupon
                                            </button>
                                        @else
                                            <input value="{{session()->get('coupon')['code']}}" id="coupon-code2"
                                                   readonly type="text"
                                                   class="text-field"
                                                   placeholder="Coupon Code">
                                            <button wire:click.prevent="removeCoupon()" type="submit"
                                                    class="button btn-danger">Remove Coupon
                                            </button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="button-area">
                            <a href="{{route('frontend.shop')}}" class="continue">Continue Shopping</a>
                            <a href="{{route('frontend.checkout')}}" class="checkout">Proceed to Checkout</a>
                        </div>

                    </div>
                    <!-- Coupon /- -->

                    <!-- Billing -->
                    <div class="calculation u-s-m-b-60">
                        <div class="table-wrapper-2">
                            <table>
                                <thead>
                                <tr>
                                    <th colspan="2">Cart Totals</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <h3 class="calc-h3 u-s-m-b-0">Subtotal</h3>
                                    </td>
                                    <td>
                                        <span class="calc-text">{{$subtotal}}</span>
                                    </td>
                                </tr>
                                @if($discount > 0)
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Discount</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{currency($discount) }}</span>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>
                                        <h3 class="calc-h3 u-s-m-b-8">Shipping</h3>
                                        <div class="calc-choice-text u-s-m-b-4">Flat Rate: Not Available</div>
                                        <div class="calc-choice-text u-s-m-b-4">Free Shipping: Not Available</div>
                                        <a data-toggle="collapse" href="#shipping-calculation"
                                           class="calc-anchor u-s-m-b-4">Calculate Shipping
                                        </a>
                                        <div class="collapse" id="shipping-calculation">
                                            <form>
                                                <div class="select-country-wrapper u-s-m-b-8">
                                                    <div class="select-box-wrapper">
                                                        <label class="sr-only" for="select-country">Choose your country
                                                        </label>
                                                        <select class="select-box" id="select-country">
                                                            <option selected="selected" value="">Choose your country...
                                                            </option>
                                                            <option value="">United Kingdom (UK)</option>
                                                            <option value="">United States (US)</option>
                                                            <option value="">United Arab Emirates (UAE)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="select-state-wrapper u-s-m-b-8">
                                                    <div class="select-box-wrapper">
                                                        <label class="sr-only" for="select-state">Choose your state
                                                        </label>
                                                        <select class="select-box" id="select-state">
                                                            <option selected="selected" value="">Choose your state...
                                                            </option>
                                                            <option value="">Alabama</option>
                                                            <option value="">Alaska</option>
                                                            <option value="">Arizona</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="town-city-div u-s-m-b-8">
                                                    <label class="sr-only" for="town-city"></label>
                                                    <input type="text" id="town-city" class="text-field"
                                                           placeholder="Town / City">
                                                </div>
                                                <div class="postal-code-div u-s-m-b-8">
                                                    <label class="sr-only" for="postal-code"></label>
                                                    <input type="text" id="postal-code" class="text-field"
                                                           placeholder="Postcode / Zip">
                                                </div>
                                                <div class="update-totals-div u-s-m-b-8">
                                                    <button class="button button-outline-platinum">Update Totals
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3 class="calc-h3 u-s-m-b-0" id="tax-heading">Tax</h3>
                                        <span> (estimated for your country)</span>
                                    </td>
                                    <td>
                                        <span class="calc-text">{{$tax}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                                    </td>
                                    <td>
                                        <span class="calc-text">{{$total}}</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Billing /- -->
                </div>
            </div>
        </div>
    </div>
    <!-- Cart-Page /- -->
</div>
