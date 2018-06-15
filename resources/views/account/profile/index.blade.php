@extends('account.layouts.default')

@section('account.content')

    <div class="card">
        <div class="card-body">
            <form action="{{route('account.profile.store')}}" method="POST">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control{{$errors->has('name') ? ' is-invalid' : ''}}" id="name" value="{{old('name', auth()->user()->name)}}">

                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control{{$errors->has('email') ? ' is-invalid' : ''}}" id="email" value="{{old('email', auth()->user()->email)}}">

                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{$errors->first('email')}}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

@endsection
