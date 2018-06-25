@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Subscription</div>
                <div class="card-body">
                    <form action="{{route('subscription.store')}}" method="POST" id="payment-form">
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="plan" class="col-md-4 col-form-label text-md-right">Plan</label>

                            <div class="col-md-6">
                                <select name="plan" id="plan" class="form-control{{$errors->has('plan') ? ' is-invalid' : ''}}">
                                    @foreach($plans as $plan)
                                        <option value="{{$plan->gateway_id}}" {{request('plan') === $plan->slug || old('plan') === $plan->gateway_id ? 'selected="selected"' : ''}}>{{$plan->name}} (&euro;{{$plan->price}})</option>
                                    @endforeach
                                </select>

                                @if($errors->has('plan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('plan')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coupon" class="col-sm-4 col-form-label text-md-right">Coupon code</label>

                            <div class="col-md-6">
                                <input id="coupon" type="text" class="form-control{{$errors->has('coupon') ? ' is-invalid' : ''}}" name="coupon" value="{{old('coupon')}}">

                                @if($errors->has('coupon'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('coupon')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div id="payment" class="col-md-6 offset-md-4"></div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="pay">Pay</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>

    <script>

        $(document).ready(function(){
            $.ajax({
                url: '{{route('braintree.token')}}',
                type: 'get',
                dataType: 'json',
                success: function(data){
                    braintree.setup(data.token, 'dropin', {
                        container: 'payment'
                    });
                }
            });
        });

    </script>

@endsection