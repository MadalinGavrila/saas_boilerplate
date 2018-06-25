@extends('account.layouts.default')

@section('account.content')

    <div class="card">
        <div class="card-body">
            <form action="{{route('account.subscription.team.update')}}" method="POST">
                {{csrf_field()}}
                {{method_field('PATCH')}}

                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-md-right">Team name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{$errors->has('name') ? ' is-invalid' : ''}}" name="name" value="{{old('name', $team->name)}}">

                        @if($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('name')}}</strong>
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

    <hr>

    <div class="card">
        <div class="card-body">
            @if($team->users->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th>Member name</th>
                            <th>Member email</th>
                            <th>Added</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($team->users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->pivot->created_at->toDateString()}}</td>
                                <td>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('remove-{{$user->id}}').submit();">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>You've not added any team members yet.</p>
            @endif

            @foreach($team->users as $user)
                <form action="{{route('account.subscription.team.member.destroy', $user)}}" method="POST" id="remove-{{$user->id}}" class="hidden">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                </form>
            @endforeach

            <form action="{{route('account.subscription.team.member.store')}}" method="POST">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label text-md-right">Add a member by email</label>

                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control{{$errors->has('email') ? ' is-invalid' : ''}}" name="email" value="{{old('email')}}">

                        @if($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('email')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">Add Member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
