@extends('layouts.website')
@section('content')
{{-- @dd(Cart::getContent()) --}}
<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>Shopping Cart</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row ">
                <div class="shopping-cart">
                    <div class="shopping-cart-table ">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="cart-romove item">Remove</th>
                        <th class="cart-description item">Image</th>
                        <th class="cart-product-name item">Product Name</th>
                        <th class="cart-edit item">Edit</th>
                        <th class="cart-qty item">Quantity</th>
                        <th class="cart-sub-total item">Subtotal</th>
                        <th class="cart-total last-item">Grandtotal</th>
                    </tr>
                </thead><!-- /thead -->
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <div class="shopping-cart-btn">
                                <span class="">
                                    <a href="{{ route('website.home')}}" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
                                    {{-- <a href="#" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a> --}}
                                </span>
                            </div><!-- /.shopping-cart-btn -->
                        </td>
                    </tr>
                </tfoot>
                <tbody>

                    @forelse ($allcart as $cart)

                    <tr>
                        <td class="romove-item"><a href="{{ route('cart.destroy',$cart->id) }}" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
                        <td class="cart-image">
                            <a class="entry-thumbnail" href="#">
                                <img src="{{ asset('uploads/product/'.$cart->attributes->product_image)}}" alt="">
                            </a>
                        </td>
                        <td class="cart-product-name-info">
                            <h4 class='cart-product-description'><a href="#">{{ $cart->name }}</a></h4>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="rating rateit-small"></div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="reviews">
                                        (06 Reviews)
                                    </div>
                                </div>
                            </div><!-- /.row -->
                            <div class="cart-product-info">
                                <span class="product-color">COLOR:<span>Blue</span></span>
                            </div>
                        </td>
                        <td class="cart-product-edit"><a href="#" class="product-edit">Edit</a></td>

                        <td class="cart-product-edit">
                            <form action="{{ route('cart.quantity.update',$cart->id) }}" method="POST">
                                <input name="cart_id" type="hidden" value="{{ $cart->id }}">
                                @csrf
                                <input value="{{ $cart->quantity }}" type="number" name="quantity" style="width: 20%; height: 30px; margin-right: 10px;">
                                <button type="submit" class="btn btn-sm btn-success" style="color: white;"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                            </form>
                            </td>

                        <td class="cart-product-sub-total"><span class="cart-sub-total-price">$ {{ $cart->price }}</span></td>
                        <td class="cart-product-grand-total"><span class="cart-grand-total-price">$ {{ $cart->getPriceSum() }}</span></td>
                    </tr>

                    @empty
                    <tr>
                        No Product in Cart
                    </tr>
                    @endforelse
                </tbody><!-- /tbody -->
            </table><!-- /table -->
        </div>
    </div><!-- /.shopping-cart-table -->
    <div class="col-md-4 col-sm-12 estimate-ship-tax">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <span class="estimate-title">Estimate shipping and tax</span>
                        <p>Enter your destination to get shipping and tax.</p>
                    </th>
                </tr>
            </thead><!-- /thead -->
            <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="info-title control-label">Country <span>*</span></label>
                                <select name="country" id="country" class="form-control unicase-form-control selectpicker search">
                                    <option>--Select Country--</option>
                                    @foreach (App\Models\Country::orderBy('name')->get() as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="info-title control-label">State/Province <span>*</span></label>
                                <select name="state" id="state" class="form-control">
                                    <option>--Select options--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="info-title control-label">City<span>*</span></label>
                                <select name="city" id="city" class="form-control">
                                    <option>--Select options--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="info-title control-label">Zip/Postal Code</label>
                                <input type="text" class="form-control unicase-form-control text-input" placeholder="">
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn-upper btn btn-primary">GET A QOUTE</button>
                            </div>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div><!-- /.estimate-ship-tax -->

    <div class="col-md-4 col-sm-12 estimate-ship-tax">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <span class="estimate-title">Discount Code</span>
                        <p>Enter your coupon code if you have one..</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $couponcount = Cart::getConditions()->count();
                    $coupon = Cart::getConditions()->first();
                @endphp
                <form action="{{ route('cart.coupon.apply') }}" method="POST">
                    @csrf
                    <tr>
                        <td>
                            <div class="form-group">
                                <input name="coupon_code" type="text" class="form-control unicase-form-control text-input"
                                    placeholder="You Coupon..">
                                @if($couponcount > 0)
                                <span class="text-danger">Coupon Code Apply Success <a href="{{ route('cart.coupon.remove') }}" title="cancel" class="icon text-danger">
                                    <i class="fa fa-times"></i></a> </span>
                                    @endif
                                    <input name="user_id" type="hidden" value="@auth {{ auth()->user()->id }} @endauth">
                            </div>
                            <div class="clearfix pull-right">
                                <button type="submit" class="btn-upper btn btn-primary">APPLY COUPON</button>
                            </div>
                        </td>
                    </tr>
                </form>

            </tbody><!-- /tbody -->
        </table><!-- /table -->
    </div><!-- /.estimate-ship-tax -->

    <div class="col-md-4 col-sm-12 cart-shopping-total">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <div class="cart-sub-total">
                            Subtotal<span class="inner-left-md">$ {{ Cart::getSubTotal()}}</span>
                        </div>
                        @if ($couponcount > 0)
                            <div class="cart-sub-total">Discount <span class="inner-left-md"> $ {{ $coupon->getValue() }}</span></div>
                        @endif
                        <div class="cart-grand-total">
                            Grand Total<span class="inner-left-md">${{ Cart::getTotal() }}</span>
                        </div>
                    </th>
                </tr>
            </thead><!-- /thead -->
            <tbody>
                    <tr>
                        <td>
                            <div class="cart-checkout-btn pull-right">
                                <a href="{{ route('website.checkout')}}" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a>
                                <span class="">Checkout with multiples address!</span>
                            </div>
                        </td>
                    </tr>
            </tbody><!-- /tbody -->
        </table><!-- /table -->
    </div><!-- /.cart-shopping-total -->
</div><!-- /.shopping-cart -->
</div> <!-- /.row -->
</div><!-- /.container -->
    </div><!-- /.body-content -->
</div>
</div>
</div>
</div>


@endsection


