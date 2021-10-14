<div>
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Wishlist</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="home.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="wishlist.html">Wishlist</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Wishlist-Page -->
    <div class="page-wishlist u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Products-List-Wrapper -->
                    <div class="table-wrapper u-s-m-b-60">
                        <table>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th>Move To Cart</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($items as $item)
                            <tr>
                                <td>
                                    <div class="cart-anchor-image">
                                        <a href="{{route('product.details',$item->model->slug)}}">
                                            <img src="{{asset($item->model->get_image())}}" alt="Product">
                                            <h6>{{$item->model->name}}</h6>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-price">
                                        ${{$item->model->price}}
                                    </div>
                                </td>
                                <td>
                                    <div class="action-wrapper">
                                        <button wire:click.prevent="removeAndMoveToCart('{{$item->rowId}}')" class="button button-outline-secondary">Add to Cart</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-wrapper">
                                        <button wire:click.prevent="itemRemove('{{$item->rowId}}')" class="button button-outline-secondary fas fa-trash"></button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Empty WishList</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Products-List-Wrapper /- -->
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist-Page /- -->
</div>
