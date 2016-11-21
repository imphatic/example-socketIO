@extends('master')
@section('content')

<header>
    <h1>chat room</h1>
    <h5>You are <span class="thisUser">{{ session('user') }}</span></h5>
</header>

<section>
    <div class="chat-area"></div>
</section>

<footer>
    <div class="attachment"></div>
    <input type="file" name="upload">
    <div class="textinput text-muted" contenteditable="true"></div>

</footer>

@endsection
