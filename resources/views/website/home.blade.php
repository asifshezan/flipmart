@extends('layouts.website')
@section('content')

        <!-- ================================== TOP NAVIGATION ================================== -->
        <div class="side-menu animate-dropdown outer-bottom-xs">
            <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
            <nav class="yamm megamenu-horizontal">
            <ul class="nav">
                    @php
                    $categories = App\Models\ProductCategory::where('pro_cat_status',1)->where('pro_cat_parent',NULL)->get();
                    @endphp
                    @foreach ($categories as $category)
                    <li class="dropdown menu-item">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if ($category->pro_cat_icon)
                            <i class="{{ $category->pro_cat_icon }}" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-bars" aria-hidden="true"></i>
                            @endif
                                {{ $category->pro_cat_name }}</a>
                                @php
                                    $catid = $category->pro_cat_id;
                                    $subCategory = App\Models\ProductCategory::where('pro_cat_status',1)->where('pro_cat_parent',$catid)->get();
                                    $totalSubCategory = App\Models\ProductCategory::where('pro_cat_status',1)->where('pro_cat_parent',$catid)->count();
                                @endphp
                                @if ($totalSubCategory != 0)
                                <ul class="dropdown-menu mega-menu">
                                    <li class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3">
                                        <ul class="links list-unstyled">
                                            @foreach ($subCategory as $childCategory)
                                            <li><a href="#">{{ $childCategory-> pro_cat_name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- /.yamm-content -->
                        </ul>
                        <!-- /.dropdown-menu -->
                                @endif
                            </li>
                            <!-- /.menu-item -->
                    @endforeach

                </ul>
                <!-- /.nav -->
                </nav>
                <!-- /.megamenu-horizontal -->
            </div>
            <!-- /.side-menu -->
          <!-- ================================== TOP NAVIGATION : END ================================== -->

          <!-- ============================================== HOT DEALS ============================================== -->
          <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
            <h3 class="section-title">hot deals</h3>
            <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
              <div class="item">

              </div>
              <div class="item">
                <div class="products">
                  <div class="hot-deal-wrapper">
                    <div class="image"> <img src="{{asset('contents/website')}}/images/hot-deals/p5.jpg" alt=""> </div>
                    <div class="sale-offer-tag"><span>35%<br>
                      off</span></div>
                    <div class="timing-wrapper">
                      <div class="box-wrapper">
                        <div class="date box"> <span class="key">120</span> <span class="value">Days</span> </div>
                      </div>
                      <div class="box-wrapper">
                        <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                      </div>
                      <div class="box-wrapper">
                        <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                      </div>
                      <div class="box-wrapper hidden-md">
                        <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.hot-deal-wrapper -->

                  <div class="product-info text-left m-t-20">
                    <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="product-price"> <span class="price"> $600.00 </span> <span class="price-before-discount">$800.00</span> </div>
                    <!-- /.product-price -->

                  </div>
                  <!-- /.product-info -->

                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <div class="add-cart-button btn-group">
                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                      </div>
                    </div>
                    <!-- /.action -->
                  </div>
                  <!-- /.cart -->
                </div>
              </div>
              <div class="item">
                <div class="products">
                  <div class="hot-deal-wrapper">
                    <div class="image"> <img src="{{asset('contents/website')}}/images/hot-deals/p10.jpg" alt=""> </div>
                    <div class="sale-offer-tag"><span>35%<br>
                      off</span></div>
                    <div class="timing-wrapper">
                      <div class="box-wrapper">
                        <div class="date box"> <span class="key">120</span> <span class="value">Days</span> </div>
                      </div>
                      <div class="box-wrapper">
                        <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                      </div>
                      <div class="box-wrapper">
                        <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                      </div>
                      <div class="box-wrapper hidden-md">
                        <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.hot-deal-wrapper -->

                  <div class="product-info text-left m-t-20">
                    <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="product-price"> <span class="price"> $600.00 </span> <span class="price-before-discount">$800.00</span> </div>
                    <!-- /.product-price -->

                  </div>
                  <!-- /.product-info -->

                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <div class="add-cart-button btn-group">
                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                      </div>
                    </div>
                    <!-- /.action -->
                  </div>
                  <!-- /.cart -->
                </div>
              </div>
            </div>
            <!-- /.sidebar-widget -->
          </div>
          <!-- ============================================== HOT DEALS: END ============================================== -->

          <!-- ============================================== SPECIAL OFFER ============================================== -->

          <!-- /.sidebar-widget -->
          <!-- ============================================== SPECIAL OFFER : END ============================================== -->
          <!-- ============================================== PRODUCT TAGS ============================================== -->

          <!-- /.sidebar-widget -->
          <!-- ============================================== PRODUCT TAGS : END ============================================== -->
          <!-- ============================================== SPECIAL DEALS ============================================== -->

          <!-- /.sidebar-widget -->
          <!-- ============================================== SPECIAL DEALS : END ============================================== -->
          <!-- ============================================== NEWSLETTER ============================================== -->
          <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
            <h3 class="section-title">Newsletters</h3>
            <div class="sidebar-widget-body outer-top-xs">
              <p>Sign Up for Our Newsletter!</p>
              <form>
                <div class="form-group">
                  <label class="sr-only" for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
                </div>
                <button class="btn btn-primary">Subscribe</button>
              </form>
            </div>
            <!-- /.sidebar-widget-body -->
          </div>
          <!-- /.sidebar-widget -->
          <!-- ============================================== NEWSLETTER: END ============================================== -->

        </div>
        <!-- /.sidemenu-holder -->
        <!-- ============================================== SIDEBAR : END ============================================== -->

        <!-- ============================================== CONTENT ============================================== -->
        <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
          <!-- ========================================== SECTION – HERO ========================================= -->

          <div id="hero">
            <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
              <div class="item" style="background-image: url({{asset('contents/website')}}/images/sliders/01.jpg);">
                <div class="container-fluid">
                  <div class="caption bg-color vertical-center text-left">
                    <div class="slider-header fadeInDown-1">Top Brands</div>
                    <div class="big-text fadeInDown-1"> New Collections </div>
                    <div class="excerpt fadeInDown-2 hidden-xs"> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span> </div>
                    <div class="button-holder fadeInDown-3"> <a href="index6c11.html?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
                  </div>
                  <!-- /.caption -->
                </div>
                <!-- /.container-fluid -->
              </div>
              <!-- /.item -->

              <div class="item" style="background-image: url({{asset('contents/website')}}/images/sliders/02.jpg);">
                <div class="container-fluid">
                  <div class="caption bg-color vertical-center text-left">
                    <div class="slider-header fadeInDown-1">Spring 2016</div>
                    <div class="big-text fadeInDown-1"> Women <span class="highlight">Fashion</span> </div>
                    <div class="excerpt fadeInDown-2 hidden-xs"> <span>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</span> </div>
                    <div class="button-holder fadeInDown-3"> <a href="index6c11.html?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
                  </div>
                  <!-- /.caption -->
                </div>
                <!-- /.container-fluid -->
              </div>
              <!-- /.item -->

            </div>
            <!-- /.owl-carousel -->
          </div>

          <!-- ========================================= SECTION – HERO : END ========================================= -->

          <!-- ============================================== INFO BOXES ============================================== -->
          <div class="info-boxes wow fadeInUp">
            <div class="info-boxes-inner">
              <div class="row">
                <div class="col-md-6 col-sm-4 col-lg-4">
                  <div class="info-box">
                    <div class="row">
                      <div class="col-xs-12">
                        <h4 class="info-box-heading green">money back</h4>
                      </div>
                    </div>
                    <h6 class="text">30 Days Money Back Guarantee</h6>
                  </div>
                </div>
                <!-- .col -->

                <div class="hidden-md col-sm-4 col-lg-4">
                  <div class="info-box">
                    <div class="row">
                      <div class="col-xs-12">
                        <h4 class="info-box-heading green">free shipping</h4>
                      </div>
                    </div>
                    <h6 class="text">Shipping on orders over $99</h6>
                  </div>
                </div>
                <!-- .col -->

                <div class="col-md-6 col-sm-4 col-lg-4">
                  <div class="info-box">
                    <div class="row">
                      <div class="col-xs-12">
                        <h4 class="info-box-heading green">Special Sale</h4>
                      </div>
                    </div>
                    <h6 class="text">Extra $5 off on all items </h6>
                  </div>
                </div>
                <!-- .col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.info-boxes-inner -->

          </div>
          <!-- /.info-boxes -->
          <!-- ============================================== INFO BOXES : END ============================================== -->
          <!-- ============================================== SCROLL TABS ============================================== -->
          <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
            <div class="more-info-tab clearfix ">
              <h3 class="new-product-title pull-left">New Products</h3>
              <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
                @php
                    $categories = App\Models\ProductCategory::where('pro_cat_status', 1)->limit(4)->get();
                @endphp
                @foreach ($categories as $category)
                <li><a data-transition-type="backSlide" href="{{ $category->pro_cat_id }}" data-toggle="tab">{{ $category->pro_cat_name }}</a></li>
                @endforeach
              </ul>
              <!-- /.nav-tabs -->
            </div>
            <div class="tab-content outer-top-xs">
              <div class="tab-pane in active" id="all">
                <div class="product-slider">
                  <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                    @php
                        $products = App\Models\Product::where('product_status',1)->orderBy('product_id','DESC')->get();
                    @endphp
                    @foreach ($products as $product)
                        @php
                            $sub_category = App\Models\ProductCategory::where('pro_cat_parent', $product->pro_category_id)->get();
                        @endphp
                        <div class="item item-carousel">
                            <div class="products">
                            <div class="product">
                            <div class="product-image">
                                <div class="image"> <a href="#"><img src="{{asset('uploads/product/'.$product->product_image)}}" alt=""></a> </div>
                                <!-- /.image -->
                                @if ($product->product_feature == 1)
                                <div class="tag hot"><span>hot</span></div>
                                @else
                                <div class="tag new"><span>new</span></div>
                                @endif
                            </div>
                            <!-- /.product-image -->
                            <div class="product-info text-left">
                                <h3 class="name"><a href="#">{{ $product->product_name }}</a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price"> <span class="price"> $ {{ $product->product_price }} </span>
                                    <span class="price-before-discount"> $ {{ $product->product_discount_price }}</span> </div>
                                <!-- /.product-price -->
                            </div>
                            <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                            <div class="action">
                            <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                    <a href="{{ route('cart.store', $product->product_slug)}}" data-toggle="tooltip"
                                        class="btn btn-primary icon" title="Add Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="{{ route('wishlist.store', $product->product_slug)}}" title="Wishlist">
                                    <i class="icon fa fa-heart"></i> </a> </li>
                                <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="#" title="Compare">
                                    <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                            </ul>
                            </div>
                            <!-- /.action -->
                        </div>
                        <!-- /.cart -->
                        </div>
                        <!-- /.product -->
                    </div>
                    <!-- /.products -->
                    </div>
                    @endforeach
                    <!-- /.item -->
                  </div>
                  <!-- /.home-owl-carousel -->
                </div>
                <!-- /.product-slider -->
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.scroll-tabs -->
          <!-- ============================================== SCROLL TABS : END ============================================== -->
          <!-- ============================================== WIDE PRODUCTS ============================================== -->
          <div class="wide-banners wow fadeInUp outer-bottom-xs">
            <div class="row">
              <div class="col-md-7 col-sm-7">
                <div class="wide-banner cnt-strip">
                  <div class="image"> <img class="img-responsive" src="{{asset('contents/website')}}/images/banners/home-banner1.jpg" alt=""> </div>
                </div>
                <!-- /.wide-banner -->
              </div>
              <!-- /.col -->
              <div class="col-md-5 col-sm-5">
                <div class="wide-banner cnt-strip">
                  <div class="image"> <img class="img-responsive" src="{{asset('contents/website')}}/images/banners/home-banner2.jpg" alt=""> </div>
                </div>
                <!-- /.wide-banner -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.wide-banners -->


                <!-- ============================================== BEST SELLER ============================================== -->

                <div class="best-deal wow fadeInUp outer-bottom-xs">
                    <h3 class="section-title">Best seller</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                      <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                        <div class="item">
                          <div class="products best-product">
                            <div class="product">
                              <div class="product-micro">
                                <div class="row product-micro-row">
                                  <div class="col col-xs-5">
                                    <div class="product-image">
                                      <div class="image"> <a href="#"> <img src="{{ asset('contents/website')}}/images/products/p20.jpg" alt=""> </a> </div>
                                      <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col2 col-xs-7">
                                    <div class="product-info">
                                      <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                      <div class="rating rateit-small"></div>
                                      <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                      <!-- /.product-price -->

                                    </div>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.product-micro-row -->
                              </div>
                              <!-- /.product-micro -->

                            </div>
                            <div class="product">
                              <div class="product-micro">
                                <div class="row product-micro-row">
                                  <div class="col col-xs-5">
                                    <div class="product-image">
                                      <div class="image"> <a href="#"> <img src="{{ asset('contents/website')}}/images/products/p21.jpg" alt=""> </a> </div>
                                      <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col2 col-xs-7">
                                    <div class="product-info">
                                      <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                      <div class="rating rateit-small"></div>
                                      <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                      <!-- /.product-price -->

                                    </div>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.product-micro-row -->
                              </div>
                              <!-- /.product-micro -->

                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="products best-product">
                            <div class="product">
                              <div class="product-micro">
                                <div class="row product-micro-row">
                                  <div class="col col-xs-5">
                                    <div class="product-image">
                                      <div class="image"> <a href="#"> <img src="{{ asset('contents/website')}}/images/products/p22.jpg" alt=""> </a> </div>
                                      <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col2 col-xs-7">
                                    <div class="product-info">
                                      <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                      <div class="rating rateit-small"></div>
                                      <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                      <!-- /.product-price -->

                                    </div>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.product-micro-row -->
                              </div>
                              <!-- /.product-micro -->

                            </div>
                            <div class="product">
                              <div class="product-micro">
                                <div class="row product-micro-row">
                                  <div class="col col-xs-5">
                                    <div class="product-image">
                                      <div class="image"> <a href="#"> <img src="{{ asset('contents/website')}}/images/products/p23.jpg" alt=""> </a> </div>
                                      <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col2 col-xs-7">
                                    <div class="product-info">
                                      <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                      <div class="rating rateit-small"></div>
                                      <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                      <!-- /.product-price -->

                                    </div>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.product-micro-row -->
                              </div>
                              <!-- /.product-micro -->

                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="products best-product">
                            <div class="product">
                              <div class="product-micro">
                                <div class="row product-micro-row">
                                  <div class="col col-xs-5">
                                    <div class="product-image">
                                      <div class="image"> <a href="#"> <img src="{{ asset('contents/website')}}/images/products/p24.jpg" alt=""> </a> </div>
                                      <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col2 col-xs-7">
                                    <div class="product-info">
                                      <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                      <div class="rating rateit-small"></div>
                                      <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                      <!-- /.product-price -->

                                    </div>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.product-micro-row -->
                              </div>
                              <!-- /.product-micro -->

                            </div>
                            <div class="product">
                              <div class="product-micro">
                                <div class="row product-micro-row">
                                  <div class="col col-xs-5">
                                    <div class="product-image">
                                      <div class="image"> <a href="#"> <img src="{{ asset('contents/website')}}/images/products/p25.jpg" alt=""> </a> </div>
                                      <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col2 col-xs-7">
                                    <div class="product-info">
                                      <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                      <div class="rating rateit-small"></div>
                                      <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                      <!-- /.product-price -->

                                    </div>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.product-micro-row -->
                              </div>
                              <!-- /.product-micro -->

                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="products best-product">
                            <div class="product">
                              <div class="product-micro">
                                <div class="row product-micro-row">
                                  <div class="col col-xs-5">
                                    <div class="product-image">
                                      <div class="image"> <a href="#"> <img src="{{ asset('contents/website')}}/images/products/p26.jpg" alt=""> </a> </div>
                                      <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col2 col-xs-7">
                                    <div class="product-info">
                                      <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                      <div class="rating rateit-small"></div>
                                      <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                      <!-- /.product-price -->

                                    </div>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.product-micro-row -->
                              </div>
                              <!-- /.product-micro -->

                            </div>
                            <div class="product">
                              <div class="product-micro">
                                <div class="row product-micro-row">
                                  <div class="col col-xs-5">
                                    <div class="product-image">
                                      <div class="image"> <a href="#"> <img src="{{ asset('contents/website')}}/images/products/p27.jpg" alt=""> </a> </div>
                                      <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col2 col-xs-7">
                                    <div class="product-info">
                                      <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                      <div class="rating rateit-small"></div>
                                      <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                      <!-- /.product-price -->

                                    </div>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.product-micro-row -->
                              </div>
                              <!-- /.product-micro -->

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                  </div>
                  <!-- /.sidebar-widget -->
                  <!-- ============================================== BEST SELLER : END ============================================== -->


          <!-- ============================================== WIDE PRODUCTS ============================================== -->
          <div class="wide-banners wow fadeInUp outer-bottom-xs">
            <div class="row">
              <div class="col-md-12">
                <div class="wide-banner cnt-strip">
                  <div class="image"> <img class="img-responsive" src="{{asset('contents/website')}}/images/banners/home-banner.jpg" alt=""> </div>
                  <div class="strip strip-text">
                    <div class="strip-inner">
                      <h2 class="text-right">New Mens Fashion<br>
                        <span class="shopping-needs">Save up to 40% off</span></h2>
                    </div>
                  </div>
                  <div class="new-label">
                    <div class="text">NEW</div>
                  </div>
                  <!-- /.new-label -->
                </div>
                <!-- /.wide-banner -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.wide-banners -->
        </div>
      </div>
      <!-- /.row -->
      <!-- ============================================== BRANDS CAROUSEL ============================================== -->

      <!-- /.logo-slider -->
      <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /#top-banner-and-menu -->

  @endsection
