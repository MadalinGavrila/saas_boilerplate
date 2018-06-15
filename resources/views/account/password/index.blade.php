@extends('account.layouts.default')

@section('account.content')

    <div class="card">
        <div class="card-body">
            <form action="{{route('account.password.store')}}" method="POST">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="password_current">Current Password:</label>
                    <input type="password" name="password_current" class="form-control{{$errors->has('password_current') ? ' is-invalid' : ''}}" id="password_current">

                    @if($errors->has('password_current'))
                        <div class="invalid-feedback">
                            {{$errors->first('password_current')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" name="password" class="form-control{{$errors->has('password') ? ' is-invalid' : ''}}" id="password">

                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{$errors->first('password')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>

@endsection
