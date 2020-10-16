@extends('layouts.public')
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-5 mx-auto mt-5">
            <h4 class="text-center"><u>Reset Your Password</u></h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('/change/password') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="New Password" >
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re type" >
                </div>

                <div class="form-group">
                    <button class="btn btn-lg btn-secondary btn-block">CHANGE</button>
                </div>
            </form>
        </div>
    </div>
@endsection
