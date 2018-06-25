@extends('account.layouts.default')

@section('account.content')

    <div class="card">
        <div class="card-body">

            <p>Current plan: {{auth()->user()->plan->name}} (&euro;{{auth()->user()->plan->price}})</p>

            <form action="{{route('account.subscription.swap.store')}}" method="POST">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="plan" class="col-md-4 col-form-label text-md-right">Plan</label>

                    <div class="col-md-6">
                        <select name="plan" id="plan" class="form-control{{$errors->has('plan') ? ' is-invalid' : ''}}">
                            @foreach($plans as $plan)
                                <option value="{{$plan->gateway_id}}">{{$plan->name}}</option>
                            @endforeach
                        </select>

                        @if($errors->has('plan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('plan')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
