@extends('layout.main')
@section('html-title', 'Dashboard')
@section('page-title','Dashboard Page')
@section('main-content-template')
<div class="container-xxl flex-grow-1">
    <div class="row">
        <div class="col-lg-12 my-3 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Welcome {{auth()->user()->name}}! 🎉</h5>
                            <p class="mb-3">
                                မင်္ဂလာပါ။ <span class="fw-bold"></span> သင့်ကို ကြိုဆိုပါတယ်။ ရောင်းအားတွေတိုးတက်ပြီး
                                အမြတ်ငွေတွေပိုမိုရရှိပါစေ။
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
