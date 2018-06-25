@extends('account.layouts.default')

@section('account.content')

    <div class="card">
        <div class="card-body">
            <form action="{{route('account.subscription.cancel.store')}}" method="POST">
                {{csrf_field()}}

                <p>Confirm your subscription cancellation.</p>

                <button type="submit" class="btn btn-primary">Cancel</button>
            </form>
        </div>
    </div>

@endsection
