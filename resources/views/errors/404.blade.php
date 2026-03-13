@extends('layout.app')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/errors.css')}}" />
<div class="container-xxl container-p-y">
    <div class="misc-wrapper">
        <h2 class="mb-2 mx-2">စာမျက်နှာ မတွေ့ပါ။ :(</h2>
        <p class="mb-4 mx-2">Oops! 😖 တောင်းဆိုထားသော URL ကို ဤဆာဗာတွင် ရှာမတွေ့ပါ။.</p>
        <a href="{{route('index')}}" class="btn btn-primary">မူလနေရာသို့ပြန်သွားရန်</a>
        <div class="mt-3">
            <img src="{{asset('assets/img/404error.png')}}" alt="page-misc-error-light" width="500"
                class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png"
                data-app-light-img="illustrations/page-misc-error-light.png" />
        </div>
    </div>
</div>

@endsection
