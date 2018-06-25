@extends('account.layouts.default')

@section('account.content')

    <div class="card">
        <div class="card-body">
            <form action="{{route('account.subscription.card.store')}}" method="POST" id="payment-form">
                {{csrf_field()}}

                <p>Your new card will be used for future payments.</p>

                <div id="payment" class="col-md-6"></div>

                <button id="update" class="btn btn-primary">Update Card</button>
            </form>
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