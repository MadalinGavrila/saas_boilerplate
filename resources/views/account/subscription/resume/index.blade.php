@extends('account.layouts.default')

@section('account.content')

    <div class="card">
        <div class="card-body">
            <form action="{{route('account.subscription.resume.store')}}" method="POST">
                {{csrf_field()}}

                <p>Confirm to resume your subscription.</p>

                <button type="submit" class="btn btn-primary">Resume</button>
            </form>
        </div>
    </div>

@endsection
