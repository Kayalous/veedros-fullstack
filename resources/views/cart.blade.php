@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles/cart.css')}}">
@endsection

@section('content')

<div class="new-bg"></div>
<section class="sntra">
    
    <div class="container ">
        <div class="row flex-row-reverse ">
            <div class="col-12 col-lg-4">
                <div class="cart-sammery shadow-sm p-3 my-3 rounded">
                    <ul>
                        <li>
                            <div class="">
                                <p class="total">Total:</p>
                                <p class="sum">1200+1400</p>
                                <hr>
                            </div>
                        </li>
                        <li>
                            <h2>LE 3600</h2>
                        </li>
                        <li>
                            <a href="#" class="btn btn-veedros-new btn-veedros-red m-auto btn-veedros-md border-0">Check out </a>

                        </li>
                        <li>
                            <div class="btn-redeem-veedros m-auto pt-3">
                                <form>
                                    <input class="btn-redeem form-control profile-form-field email-field-props border-light border-radius-sm is-valid" placeholder="Add Coupon" type="text">
                                    <button class="btn-redeem-icon border-0">
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-auto  col-12 test-best px-4">
                <!-- @@@@@@@@@@@@@@@@@@ -->
                <div class="row  cart-card shadow-sm my-3   rounded-lg-mine">
                    <div class="col-3 align-self-center ">
                        <div class="card course-card  development-card noJquery" style="background-image: url(https://veedros.s3.eu-central-1.amazonaws.com/courses/2/hellloo/images/tdzHq4nTU7zkOOmjoTEXVq8ZFlpqoTBAxIljBlhl.jpeg)">
                        </div>
                    </div>
                    <div class="col-5 align-self-center ">
                        <div class="container ">
                            <div class="">

                                <div class=" expend-description">

                                    <input class="menu-btn" type="checkbox" id="pass-menu-btn" />
                                    <label class="menu-text" for="pass-menu-btn">
                            </label>
                                    <p class="p-title">Everett Mohr</p>
                                    <ul class="menu">
                                        <p class="p-description d-none-mine">999 Erin Field New Damaris, TN 03450 999 Erin Field New Damaris, TN 03450999 Erin Field New Damaris, TN 03450999 Erin Field New Damaris, TN 03450 999 Erin Field New Damaris, TN 03450999 Erin Field New Damaris, TN
                                            03450999 Erin Field New Damaris, TN 03450 9
                                        </p>

                                    </ul>
                                </div>

                            </div>



                        </div>
                    </div>
                    <div class="col-4 vertical-border align-self-center ">
                        <div class="cart-options">
                            <ul class="px-2">
                                <div class="">
                                    <li>
                                        <a href="">Remove</a>
                                    </li>
                                    <li>
                                        <a href="">Add to saved</a>
                                    </li>

                                </div>

                            </ul>

                            <ul class="px-2">
                                <div class="">
                                    <li>
                                        <span>Price</span>
                                    </li>
                                    <li>
                                        <span class="Price">$1200</span>
                                    </li>
                                </div>

                            </ul>
                        </div>

                    </div>
                </div>
                <!-- @@@@@@@@@@@@@@@@@@ -->


            </div>
            
        </div>
        <div class="row my-5">
            <a href="courses/" class="btn btn-veedros-new btn-veedros-md border-0 mx-auto">
                <span>Explore more courses</span>
            </a>
        </div>
    </div>
</section>
<a id="cart-tip" class="btn btn-veedros-new btn-veedros-md border-0 mx-auto">
    <i class="fas text-white fa-shopping-cart"></i>
</a>

@endsection