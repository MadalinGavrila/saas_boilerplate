@extends('account.layouts.default')

@section('account.content')

    <div class="card">
        <div class="card-body">
            <form action="{{route('account.deactivate.store')}}" method="POST">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="password_current" class="col-sm-4 col-form-label text-md-right">Current Password:</label>

                    <div class="col-md-6">
                        <input id="password_current" type="password" class="form-control{{$errors->has('password_current') ? ' is-invalid' : ''}}" name="password_current">

                        @if($errors->has('password_current'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('password_current')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @subscriptionnotcancelled
                    <p class="col-md-6 offset-md-4">This will also cancel your active subscription.</p>
                @endsubscriptionnotcancelled

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">Deactivate Account</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
