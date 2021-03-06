<div>
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">

        <div class="container">
            <div class="page-intro">
                <h2>Checkout</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="home.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="checkout.html">Checkout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Checkout-Page -->
    <div class="page-checkout u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                @if(!auth()->check())
                    <!-- First-Accordion -->
                        <div>
                            <div class="message-open u-s-m-b-24">
                                Returning customer?
                                <strong>
                                    <a class="u-c-brand" data-toggle="collapse" href="#showlogin">Click here to login
                                    </a>
                                </strong>
                            </div>
                            <div class="collapse u-s-m-b-24" id="showlogin">
                                <h6 class="collapse-h6">Welcome back! Sign in to your account.</h6>
                                <h6 class="collapse-h6">If you have shopped with us before, please enter your details in
                                    the
                                    boxes below. If you are a new customer, please proceed to the Billing & Shipping
                                    section.</h6>
                                <form>
                                    <div class="group-inline u-s-m-b-13">
                                        <div class="group-1 u-s-p-r-16">
                                            <label for="user-name-email">Username or Email
                                                <span class="astk">*</span>
                                            </label>
                                            <input type="text" id="user-name-email" class="text-field"
                                                   placeholder="Username / Email">
                                        </div>
                                        <div class="group-2">
                                            <label for="password">Password
                                                <span class="astk">*</span>
                                            </label>
                                            <input type="text" id="password" class="text-field" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="u-s-m-b-13">
                                        <button type="submit" class="button button-outline-secondary">Login</button>
                                        <input type="checkbox" class="check-box" id="remember-me-token">
                                        <label class="label-text" for="remember-me-token">Remember me</label>
                                    </div>
                                    <div class="page-anchor">
                                        <a href="#" class="u-c-brand">Lost your password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- First-Accordion /- -->
                    @endif


                    <div class="row">
                        <!-- Billing-&-Shipping-Details -->
                        <div class="col-lg-6">
                            <h4 class="section-h4">Billing Details</h4>
                            <!-- Form-Fields -->
                            <div class="group-inline u-s-m-b-13">
                                <div class="group-1 u-s-p-r-16">
                                    <label for="first-name">First Name
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="first-name" class="text-field">
                                </div>
                                <div class="group-2">
                                    <label for="last-name">Last Name
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="last-name" class="text-field">
                                </div>
                            </div>
                            <div class="u-s-m-b-13">
                                <label for="select-country">Country
                                    <span class="astk">*</span>
                                </label>
                                <div class="select-box-wrapper">
                                    <select class="select-box" id="select-country">
                                        <option selected="selected" value="">Choose your country...</option>
                                        <option value="">United Kingdom (UK)</option>
                                        <option value="">United States (US)</option>
                                        <option value="">United Arab Emirates (UAE)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="street-address u-s-m-b-13">
                                <label for="req-st-address">Street Address
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="req-st-address" class="text-field"
                                       placeholder="House name and street name">
                                <label class="sr-only" for="opt-st-address"></label>
                                <input type="text" id="opt-st-address" class="text-field"
                                       placeholder="Apartment, suite unit etc. (optional)">
                            </div>
                            <div class="u-s-m-b-13">
                                <label for="town-city">Town / City
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="town-city" class="text-field">
                            </div>
                            <div class="u-s-m-b-13">
                                <label for="select-state">State / Country
                                    <span class="astk"> *</span>
                                </label>
                                <div class="select-box-wrapper">
                                    <select class="select-box" id="select-state">
                                        <option selected="selected" value="">Choose your state...</option>
                                        <option value="">Alabama</option>
                                        <option value="">Alaska</option>
                                        <option value="">Arizona</option>
                                    </select>
                                </div>
                            </div>
                            <div class="u-s-m-b-13">
                                <label for="postcode">Postcode / Zip
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="postcode" class="text-field">
                            </div>
                            <div class="group-inline u-s-m-b-13">
                                <div class="group-1 u-s-p-r-16">
                                    <label for="email">Email address
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="email" class="text-field">
                                </div>
                                <div class="group-2">
                                    <label for="phone">Phone
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="phone" class="text-field">
                                </div>
                            </div>
                            <div class="u-s-m-b-30">
                                <input type="checkbox" class="check-box" id="create-account">
                                <label class="label-text" for="create-account">Create Account</label>
                            </div>
                            <!-- Form-Fields /- -->
                            <h4 class="section-h4">Shipping Details</h4>
                            <div class="u-s-m-b-24">
                                <input type="checkbox" class="check-box" id="ship-to-different-address"
                                       data-toggle="collapse" data-target="#showdifferent">
                                <label class="label-text" for="ship-to-different-address">Ship to a different
                                    address?</label>
                            </div>
                            <div class="collapse" id="showdifferent">
                                <!-- Form-Fields -->
                                <div class="group-inline u-s-m-b-13">
                                    <div class="group-1 u-s-p-r-16">
                                        <label for="first-name-extra">First Name
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="first-name-extra" class="text-field">
                                    </div>
                                    <div class="group-2">
                                        <label for="last-name-extra">Last Name
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="last-name-extra" class="text-field">
                                    </div>
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="select-country-extra">Country
                                        <span class="astk">*</span>
                                    </label>
                                    <div class="select-box-wrapper">
                                        <select class="select-box" id="select-country-extra">
                                            <option selected="selected" value="">Choose your country...</option>
                                            <option value="">United Kingdom (UK)</option>
                                            <option value="">United States (US)</option>
                                            <option value="">United Arab Emirates (UAE)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="street-address u-s-m-b-13">
                                    <label for="req-st-address-extra">Street Address
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="req-st-address-extra" class="text-field"
                                           placeholder="House name and street name">
                                    <label class="sr-only" for="opt-st-address-extra"></label>
                                    <input type="text" id="opt-st-address-extra" class="text-field"
                                           placeholder="Apartment, suite unit etc. (optional)">
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="town-city-extra">Town / City
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="town-city-extra" class="text-field">
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="select-state-extra">State / Country
                                        <span class="astk"> *</span>
                                    </label>
                                    <div class="select-box-wrapper">
                                        <select class="select-box" id="select-state-extra">
                                            <option selected="selected" value="">Choose your state...</option>
                                            <option value="">Alabama</option>
                                            <option value="">Alaska</option>
                                            <option value="">Arizona</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="postcode-extra">Postcode / Zip
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="postcode-extra" class="text-field">
                                </div>
                                <div class="group-inline u-s-m-b-13">
                                    <div class="group-1 u-s-p-r-16">
                                        <label for="email-extra">Email address
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="email-extra" class="text-field">
                                    </div>
                                    <div class="group-2">
                                        <label for="phone-extra">Phone
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="phone-extra" class="text-field">
                                    </div>
                                </div>
                                <!-- Form-Fields /- -->
                            </div>
                            <div>
                                <label for="order-notes">Order Notes</label>
                                <textarea class="text-area" id="order-notes"
                                          placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                        <!-- Billing-&-Shipping-Details /- -->
                        <!-- Checkout -->
                        <div class="col-lg-6">
                            <h4 class="section-h4">Your Order</h4>
                            <div class="order-table">
                                <table class="u-s-m-b-13">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(cartItems() as $item)
                                        <tr>
                                            <td>
                                                <h6 class="order-h6">{{$item->model->name}}</h6>
                                                <div class="d-inline-block order-span-quantity">x</div>
                                                <span class="order-span-quantity">{{$item->qty}}</span>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">{{currency($item->subtotal) }}</h6>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>
                                            <h3 class="order-h3">Subtotal</h3>
                                        </td>
                                        <td>
                                            <h3 class="order-h3">{{currency(getNumbers()->get('subtotal'))}}</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="order-h3">Discount</h3>
                                        </td>
                                        <td>
                                            <h3 class="order-h3">{{currency(getNumbers()->get('discount'))}}</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="order-h3">Tax</h3>
                                        </td>
                                        <td>
                                            <h3 class="order-h3">{{currency(getNumbers()->get('tax')) }}</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="order-h3">Shipping</h3>
                                        </td>
                                        <td>
                                            <h3 class="order-h3">{{currency(getNumbers()->get('shipping')) }}</h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h3 class="order-h3">Total</h3>
                                        </td>
                                        <td>
                                            <h3 class="order-h3">{{currency(getNumbers()->get('total')) }}</h3>
                                        </td>
                                    </tr>
                                    @if(currency()->getUserCurrency() != "USD")
                                        <tr>
                                            <td>
                                                <h5 class="order-h3" style="font-size: 12px !important;">Paid Total from
                                                    USD</h5>
                                            </td>
                                            <td>
                                                <h5 class="order-h3"
                                                    style="font-size: 12px !important;">{{currency(getNumbers()->get('total'),null,'USD') }}</h5>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>



                                <div>

                                    <form action="{{\LaravelLocalization::localizeURL('/checkout')}}" method="post">
                                        @csrf
                                        <div class="u-s-m-b-13">
                                            <input type="radio" class="radio-box" name="payment-method"
                                                   id="credit-card-stripe"  value="Myfatoorah">
                                            <label class="label-text" for="credit-card-stripe">Credit Card (Myfatoorah)</label>
                                        </div>
                                        <div class="u-s-m-b-13">
                                            <input type="radio" class="radio-box" name="payment-method" id="paypal"
                                                   value="PayPal_Express">
                                            <label class="label-text" for="paypal">Paypal</label>
                                        </div>

                                        <div class="u-s-m-b-13">
                                            <input type="checkbox" class="check-box" id="accept">
                                            <label class="label-text no-color" for="accept">I???ve read and accept the
                                                <a href="terms-and-conditions.html" class="u-c-brand">terms &
                                                    conditions</a>
                                            </label>
                                        </div>


                                        <input type="hidden" name="shipping_company_id" value="">
                                        <input type="hidden" name="user_address_id" value="">
                                        <button type="submit" class="button button-outline-secondary">Place Order
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- Checkout /- -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Checkout-Page /- -->
</div>
