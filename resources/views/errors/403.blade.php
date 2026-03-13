@extends('layout.app')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/errors.css')}}" />
<div id="background"></div>
<div class="top">
    <h1>403!</h1>
    <h3>Access Denied!</h3>
</div>
<div class="container">
    <div class="ghost-copy">
        <div class="one"></div>
        <div class="two"></div>
        <div class="three"></div>
        <div class="four"></div>
    </div>
    <div class="ghost">
        <div class="face">
            <div class="eye"></div>
            <div class="eye-right"></div>
            <div class="mouth"></div>
        </div>
    </div>
    <div class="shadow"></div>
</div>
<div class="bottom">
    <div class="buttons">
        <a href=""><button class="btn">Home</button></a>
    </div>
</div>

@endsection