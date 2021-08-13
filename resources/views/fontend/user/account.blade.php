@extends('fontend.layouts.master')
@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container"> 
            <h1 class="page-title">{{ucfirst($user->full_name)}}<span>{{ucfirst($user->role)}}</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('fontend.user.sidebar')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content"> 

                            <div class="tab-pane fade show active" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                <form action="{{route('account.update',$user->id)}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Full Name </label>
                                            <input type="text" class="form-control"  placeholder="{{$user->full_name}}" name="full_name" value="{{$user->full_name}}"  required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>User Name *</label>
                                            <input type="text" class="form-control"  placeholder="{{$user->username}}" name="username" value="{{$user->username}}" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->
 
                                    <label>Email address *</label>
                                    <input type="email" class="form-control"  placeholder="{{$user->email}}" name="email" value="{{$user->email}}" required>
 
                                    <label>Phone </label>
                                    <input type="phone" class="form-control"  placeholder="{{$user->phone}}" name="phone" required>
 
                                    <label>Current password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control" name="oldpassword">

                                    <label>New password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control" name="newpassword">
 

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection 