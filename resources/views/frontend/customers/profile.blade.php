@extends('layouts.frontend.app')
@section('styles')
    <style>
        .title-name {
            padding-bottom: 21px;
            margin-bottom: 21px;
            border-bottom: 2px solid #DCDCDD;
        }
        .title-name a.current
        {
            color: red;
        }
    </style>

@endsection
@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Detail</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="home.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="single-product.html">Detail</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <div class="page-shop u-s-p-t-80">
        <div class="container">
            <!-- Shop-Intro -->
            <div class="shop-intro">
                <h3>Men's Clothing</h3>
            </div>

            <div class="row">
                <!-- Shop-Left-Side-Bar-Wrapper -->
                @include('frontend.customers.sidebar')
                <div class="col-lg-9 col-md-9 col-sm-12">
                    index
                </div>
            </div>
        </div>
    </div>




@endsection
@section('js')



@endsection
