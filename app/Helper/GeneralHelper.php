<?php

use Gloudemans\Shoppingcart\Facades\Cart;

function getNumbers()
{
    $subtotal = round(Cart::instance('default')->subtotal(), 2);
    $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0.00;
    $subtotalAfterDiscount = ($subtotal - $discount) > 0 ? round(($subtotal - $discount), 2) : 0.00;
    $taxRate = config('cart.tax') / 100;
    $taxText = config('cart.tax') . ' %';
    $tax = ($subtotalAfterDiscount * $taxRate) > 0 ? round(($subtotalAfterDiscount * $taxRate), 2) : 0.00;
    $subtotalAfterTax = ($subtotalAfterDiscount + $tax) > 0 ? round(($subtotalAfterDiscount + $tax), 2) : 0.00;
    $shipping = session()->has('shipping') ? session()->get('shipping')['cost'] : 0.00;
    $total = ($subtotalAfterTax + $shipping) > 0 ?  round(($subtotalAfterTax + $shipping), 2) : 0.00;
    return collect(['subtotal' => $subtotal,
        'discount' => $discount,
        'subtotalAfterDiscount' => $subtotalAfterDiscount,
        'taxText' => $taxText,
        'tax' => $tax,
        'subtotalAfterTax' => $subtotalAfterTax,
        'shipping' => $shipping,
        'total' => $total,
    ]);

}

function getRate($product)
{
    $rate = ($product->reviews_avg_rating) ? round($product->reviews_avg_rating, 1) : 0;
    $titleRate = $rate . ' out of 5 - based on ' . $product->reviews_count;
    $widthRate = ($rate / 5 * 75) . 'px';
    return collect([
        'titleRate' => $titleRate,
        'widthRate' => $widthRate
    ]);
}

function cartItems()
{
    return Cart::instance('default')->content();
}

function matchRoute($routeName)
{
    return Route::currentRouteName() == $routeName ? 'current' : '' ;
}
function matchUrl($routeName)
{
    return Route::currentRouteName() == $routeName ? 'javascript:void(0)' : route($routeName);
}

function encryptor($action, $string) {
    $output = FALSE;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'halaSayed';
    $secret_iv  = 'SecretIV@123GKrQp';
    // hash
    $key = hash('sha256', $secret_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    //do the encryption given text/string/number
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } elseif ($action == 'decrypt') {
        //decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function setCrypt($data) {
    return urlencode(encryptor('encrypt', $data));
}

function getDecrypt($data) {
    return encryptor('decrypt', urldecode($data));
}


