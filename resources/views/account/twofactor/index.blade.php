@extends('account.layouts.default')

@section('account.content')

    <div class="card">
        <div class="card-body">
            @if(auth()->user()->twoFactorEnabled())
                <p>Two factor authentication is enabled for your account.</p>

                <form action="{{route('account.twofactor.destroy')}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}

                    <button type="submit" class="btn btn-primary">Disable</button>
                </form>
            @else
                @if(auth()->user()->twoFactorPendingVerification())
                    <form action="{{route('account.twofactor.verify')}}" method="POST">
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="token" class="col-sm-4 col-form-label text-md-right">Verification Token:</label>

                            <div class="col-md-6">
                                <input type="text" name="token" id="token" class="form-control{{$errors->has('token') ? ' is-invalid' : ''}}">

                                @if($errors->has('token'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('token')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Verify</button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <form action="{{route('account.twofactor.destroy')}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-default">Cancel Verification</button>
                            </div>
                        </div>
                    </form>
                @else
                    <form action="{{route('account.twofactor.store')}}" method="POST">
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="dial_code" class="col-md-4 col-form-label text-md-right">Dialling Code</label>

                            <div class="col-md-6">
                                <select name="dial_code" id="dial_code" class="form-control{{$errors->has('dial_code') ? ' is-invalid' : ''}}">
                                    @foreach($countries as $country)
                                        <option value="{{$country->dial_code}}">{{$country->name}} (+{{$country->dial_code}})</option>
                                    @endforeach
                                </select>

                                @if($errors->has('dial_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('dial_code')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-sm-4 col-form-label text-md-right">Phone Number:</label>

                            <div class="col-md-6">
                                <input type="text" name="phone_number" id="phone_number" class="form-control{{$errors->has('phone_number') ? ' is-invalid' : ''}}">

                                @if($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('phone_number')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Enable</button>
                            </div>
                        </div>
                    </form>
                @endif
            @endif
        </div>
    </div>

@endsection
