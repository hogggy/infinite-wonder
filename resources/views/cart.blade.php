@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/my-cart.css') }}">
@stop

@section('content')
    <div class="summary col-md-12">
        <div class="col-md-2"></div>

        <div class="col-md-8 col-sm-12 text-left">
            <ul>
                <li class="row columnCaptions">
                    <span class="quantityHeader">QTY</span>
                    <span>ITEM</span>
                    <span>Price</span>
                </li>
                @foreach ($items as $item)
                    <li class="row cart-item" id="{{ $item->id }}">
                        <span class="quantity"><input pattern="[0-9]*" min="0" max="99" class="change-quantity" type="number" value="{{ $item->quantity }}"/></span>
                        <span class="itemName">{{ $item->product->name }}</span>
                        <span class="glyphicon glyphicon-remove remove"></span>
                        <span class="price">${{ $item->product->price }}</span>
                    </li>
                @endforeach
                <li class="row totals">
                    <span class="itemName">Total:</span>
                    <span class="price">${{ $cartTotalPrice }}</span>
                    <span class="order"><a class="text-center">ORDER</a></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="shippingInfo col-md-12" style="display:none">
        <div class='col-md-3'></div>
        <div class='col-md-6'>
            <div class='col-md-12 form-group'>
                <div class="form-row text-center">
                    <h1>Shipping Info</h1>
                </div>
            </div>
            <form accept-charset="UTF-8" action="/user/address" data-toggle="validator" id="shipping-form" method="post" role="form">
                <div class='form-row'>
                    <div class="col-xs-4">
                        <label class='control-label nowrap'>Name</label>
                    </div>
                    <div class='col-xs-8 form-group required'>
                        <input name="name" class='form-control' size='4' type='text' required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class='form-row'>
                    <div class="col-xs-4">
                        <label class='control-label nowrap'>Email</label>
                    </div>
                    <div class='col-xs-8 form-group required'>
                        <input name="email" class='form-control' size='4' type='email' data-error="Email is invalid" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class='form-row'>
                    <div class="col-xs-4">
                        <label class='control-label nowrap'>Address Line 1</label>
                    </div>
                    <div class='col-xs-8 form-group required'>
                        <input name="address1" class='form-control' size='4' type='text' required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class='form-row'>
                    <div class="col-xs-4">
                        <label class='control-label nowrap'>Address Line 2</label>
                    </div>
                    <div class='col-xs-8 form-group'>
                        <input name="address2" class='form-control' size='4' type='text'>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class='form-row'>
                    <div class="col-xs-4">
                        <label class='control-label nowrap'>City</label>
                    </div>
                    <div class='col-xs-8 form-group'>
                        <input name="city" class='form-control' size='4' type='text' required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class='form-row'>
                    <div class="col-xs-4">
                        <label class='control-label nowrap'>State/Region</label>
                    </div>
                    <div class='col-xs-8 form-group'>
                        <input name="state" class='form-control' size='4' type='text' required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class='form-row'>
                    <div class="col-xs-4">
                        <label class='control-label nowrap'>Zip</label>
                    </div>
                    <div class='col-xs-8 form-group'>
                        <input name="postal" class='form-control' size='4' type='number' required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <input type="hidden" name="type" value="shipping" />
                <hr>
                <div class='form-row text-center'>
                    <div class='col-md-12 form-group'>
                        <hr class="featurette-divider"/>
                        <div class='error form-group hide'>
                            <div class='alert-danger alert'>
                                Please correct the errors and try again.
                            </div>
                        </div>
                        <button class='billing cart-button' type='submit'> Enter Billing Info </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Start billing Info -->

    <div class="billingInfo" style="display:none">
        <form accept-charset="UTF-8" action="/user/billingInfo" class="require-validation" id="payment-form" method="post">
            <div class="col-md-12">
                <div class='col-md-4'></div>
                <div class='col-md-4'>
                    <div class='col-md-12 form-group'>
                        <div class="form-row">
                            <h1>Billing Info</h1>
                        </div>
                    </div>
                    <br>
                    <div class='form-row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Name on Card</label>
                            <input id='billing-account-name' class='form-control card-name' size='4' type='text'>
                        </div>

                    </div>
                    <div class='form-row'>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Card Number</label>
                            <input name="billing-cc-number" class='form-control card-number' size='20' type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-6 form-group cvc required'>
                            <label class='control-label'>CVC</label>
                            <input name="billing-cvv" class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                        </div>
                        <div class='col-xs-6 form-group expiration required'>
                            <label class='control-label'>Expiration</label>
                            <input name="billing-cc-exp" class='form-control card-expiry-year' placeholder='MMYY' size='4' type='text'>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class='col-md-12 form-group'>
                            <label class='control-label'>Billing Address</label>
                            <div style="float: right;">
                                <input type="checkbox" id="same-as-shipping" checked="true"/> Same as Shipping
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'></div>
            </div>
            <div class="billing-address col-md-12" style="display: none">
                <input type="hidden" name="type" value="billing" />
                <div class="col-md-6 col-md-offset-3">
                    <div class='form-row'>
                        <div class="col-xs-4">
                            <label class='control-label nowrap'>Address Line 1</label>
                        </div>
                        <div class='col-xs-8 form-group required'>
                            <input name="billing-address1" class='form-control' size='4' type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class="col-xs-4">
                            <label class='control-label nowrap'>Address Line 2</label>
                        </div>
                        <div class='col-xs-8 form-group'>
                            <input name="billing-address2" class='form-control' size='4' type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class="col-xs-4">
                            <label class='control-label nowrap'>City</label>
                        </div>
                        <div class='col-xs-8 form-group'>
                            <input name="billing-city" class='form-control' size='4' type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class="col-xs-4">
                            <label class='control-label nowrap'>State/Region</label>
                        </div>
                        <div class='col-xs-8 form-group'>
                            <input name="billing-state" class='form-control' size='4' type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class="col-xs-4">
                            <label class='control-label nowrap'>Zip</label>
                        </div>
                        <div class='col-xs-8 form-group'>
                            <input name="billing-postal" class='form-control' size='4' type='text'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <div class='form-row'>
                        <div class='col-md-12 form-group'>
                            <hr class="featurette-divider"/>
                            <div class='error form-group hide'>
                                <div class='alert-danger alert'>
                                    Please correct the errors and try again.
                                </div>
                            </div>
                            <button id='payment-button' class='cart-button' type="submit"> Review Order </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('javascript')
    <script src="{{ URL::asset('js/my-cart.js') }}"></script>
@stop

