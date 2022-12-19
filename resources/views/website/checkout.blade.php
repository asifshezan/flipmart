@extends('layouts.website')
@section('content')

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="wrapper">
    <div class="row">
        <div class="col-12 col">
            <div class="info-bar">
                <p>
                    <i class="fa fa-info"></i>
                    Returning customer? <a href="#">Click here to login</a>
                </p>
            </div>
            <p>
                If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col">
            <form method="get" class="user-pswd">
                <div class="width50 padright">
                    <label for="username">Username or email</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="width50">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                    <input type="submit" name="submit" value="Login"><input type="checkbox" value="1" name="checkbox"><p>Remember me</p>
            </form>
            <p><a href="#">Lost your password?</a></p>
        </div>
    </div>


    <div class="row">
        <form method="post ">
            <div class="col-7 col">
                <h3 class="topborder card-header" style="padding-bottom: 20px;"><span>Billing Details</span></h3>

                <div class="width50 padright">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" required>
                </div>
                <div class="width50">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" required>
                </div>

                <label for="address">Address</label>
                <input type="text" name="address" id="address" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>

                <div class="width50 padright">
                    <label for="country">Country</label>
                <select name="country" id="country" required>
                    <option value="">Please select a country</option>
                    <option value="Canada">Canada</option>
                    <option value="Not Canada">Not Canada</option>
                </select>
                    </div>

                    <div class="width50">
                        <label for="city">Town / City</label>
                        <input type="text" name="city" id="city" required>
                    </div>


                <div class="width50 padright">
                <label for="postcode">Postcode</label>
                    <input type="text" name="postcode" id="postcode" placeholder="Postcode / Zip" required>
                </div>

                <div class="width50">
                    <label for="tel">Phone</label>
                    <input type="text" name="tel" id="tel" required>
                </div>
                <input type="checkbox" value="2" name="checkbox"><p>Create an account?</p>
                <h3 class="topborder"><span>Shipping Address</span></h3>
                <input type="checkbox" value="3" name="checkbox"><p>Ship to a different address?</p>
                <label for="notes" class="notes">Order Notes</label>
                <textarea name="notes" id="notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
            </div>
            <div class="col-5 col order">
                <h3 class="topborder"><span>Your Order</span></h3>
                <div class="row">
                    <h4 class="inline">Product</h4>
                    <h4 class="inline alignright">Total</h4>
                </div>
                <div>
                    <p class="prod-description inline">Nice Dress<div class="qty inline"><span class="smalltxt">x</span> 1</div>
                    </p>
                </div>
                <div><h5>Cart Subtotal</h5></div>
                <div>
                    <h5 class="inline difwidth">Shipping and Handling</h5>
                    <p class="inline alignright center">Free Shipping</p>
                </div>
                <div><h5>Order Total</h5></div>

                <div>
                    <h3 class="topborder"><span>Payment Method</span></h3>
                    <input type="radio" value="banktransfer" name="payment" checked><p>Direct Bank Transfer</p>
                    <p class="padleft">
                        Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.
                    </p>
                </div>

                <div><input type="radio" value="cheque" name="payment"><p>Cheque Payment</p></div>
                <input type="submit" name="submit" value="Place Order" class="redbutton">
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
@endsection
