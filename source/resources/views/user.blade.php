@extends('master')
@section('content')
    <form class="form-signin userNameSelectionWrap" action="/user" method="post">
        {{ csrf_field() }}
        <h2 class="form-signin-heading">Please select a name</h2>
        <label for="name" class="sr-only">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Name" required autofocus>

        <hr>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Select</button>
    </form>
@endsection