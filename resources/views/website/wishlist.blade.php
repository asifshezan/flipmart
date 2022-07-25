@extends('layouts.website')
@section('content')
<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>Wishlist</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div>
        <div class="row">
            <div class="col-md-12 my-wishlist">
                <div class="table-responsive">
                    <table class="table" cellspacing="10">
                        <thead>
                            <tr>
                                <th class="heading-title">My Wishlist</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($wishlists as $wishlist)
                            @php
                                $products = App\Models\Product::where('product_id',$wishlist->product_id)->get();
                            @endphp

                            @foreach ($products as $product)
                            <tr>
                                <td><img style="height: 200px;" src="{{ asset('uploads/product/'.$product->product_image) }}" alt="image"></td>
                                <td>
                                    <div class="product-name"><a href="#">{{ $product->product_name }}</a></div>
                                    <div class="rating">
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star-half-stroke"></i><br>
                                        <span class="review">( 06 Reviews )</span>
                                    </div>
                                    <div class="price">
                                        ${{ $product->product_discount_price }}<br>

                                        <span>${{ $product->product_price }}</span>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="btn-upper btn btn-primary">Add to cart</a>
                                </td>
                                <td class="col-md-1 close-btn">
                                    <a href="{{ route('wishlist.destroy',$product->product_slug) }}" class=""><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach

                            @empty
                            <tr>
                                <td class="text-center"><h3>Wishlist Empty ...</h3></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
        </div>
    </div>
</div>
    </div></div>
                </div>
                    </div>
@endsection
