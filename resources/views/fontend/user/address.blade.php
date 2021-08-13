@extends('fontend.layouts.master')
@section('content')

    <main class="main">
    <div class="page-header text-center" style="background-image: url('{{asset('fontend/assets/images/page-header-bg.jpg')}}')">
            <div class="container">
                <h1 class="page-title">{{ ucfirst($user->full_name) }}<span>{{ ucfirst($user->role) }}</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
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
                                <div class="tab-pane fade  show active" id="tab-address" role="tabpanel"
                                    aria-labelledby="tab-address-link">
                                    <p>The following addresses will be used on the checkout page by default.</p>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card card-dashboard">
                                                <div class="card-body">
                                                    <h3 class="card-title">Billing Address</h3><!-- End .card-title -->
                                                    <p>{{ucwords($user->country )}}<br>
                                                        {{ucwords($user->state)}},
                                                        {{ucwords($user->city)}}<br>
                                                        {{ucwords($user->country)}}<br>
                                                        {{ $user->postcode}}<br>
                                                         </p>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#editAddress">
                                                        Edit
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editAddress" tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Address </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="{{route('billing.address',$user->id)}}" method="POST" >
                                                                    @csrf
                                                                    <div class="modal-body px-2">
                                                                        <div class="form-group">
                                                                            <label for="" class="text-capitalize">
                                                                                address</label>
                                                                            <input type="text" name="address" id="address"
                                                                                class="form-control " placeholder="address"
                                                                                aria-describedby="address"
                                                                                style="border-radius: 20px" value="{{$user->address}}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="text-capitalize">
                                                                                state</label>
                                                                            <input type="text" name="state" id="state"
                                                                                class="form-control " placeholder="state"
                                                                                aria-describedby="address"
                                                                                style="border-radius: 20px" value="{{$user->state}}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="text-capitalize">
                                                                                country</label>
                                                                            <input type="text" name="country" id="country"
                                                                                class="form-control " placeholder="country"
                                                                                aria-describedby="address"
                                                                                style="border-radius: 20px" value="{{$user->country}}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="text-capitalize">
                                                                                city</label>
                                                                            <input type="text" name="city" id="city"
                                                                                class="form-control " placeholder="city"
                                                                                aria-describedby="address"
                                                                                style="border-radius: 20px" value="{{$user->city}}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="text-capitalize" required>
                                                                                postcode</label>
                                                                            <input type="number" name="postcode" id="postcode"
                                                                                class="form-control " placeholder="postcode"
                                                                                aria-describedby="address"
                                                                                style="border-radius: 20px" value="{{$user->postcode}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End .card-body -->
                                            </div><!-- End .card-dashboard -->
                                        </div><!-- End .col-lg-6 -->

                                        <div class="col-lg-6">
                                            <div class="card card-dashboard">
                                                <div class="card-body">
                                                    <h3 class="card-title">Shipping Address</h3><!-- End .card-title -->
                                                    <p>{{ucwords($user->scountry )}}<br>
                                                        {{ucwords($user->sstate)}},
                                                        {{ucwords($user->scity)}}<br>
                                                        {{ucwords($user->scountry)}}<br>
                                                        {{ $user->spostcode}}<br>
                                                         </p>
                                                     <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#editSAddress">
                                                        Edit
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editSAddress" tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Shipping Address </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="{{route('shiping.address',$user->id)}}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body px-2">
                                                                        <div class="form-group">
                                                                            <label for="" class="text-capitalize">
                                                                                address</label>
                                                                            <input type="text" name="saddress" id="saddress"
                                                                                class="form-control " placeholder="saddress"
                                                                                aria-describedby="saddress"
                                                                                style="border-radius: 20px" value="{{$user->saddress}}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="text-capitalize">
                                                                                state</label>
                                                                            <input type="text" name="sstate" id="sstate"
                                                                                class="form-control " placeholder="sstate"
                                                                                aria-describedby="address"
                                                                                style="border-radius: 20px" value="{{$user->sstate}}"required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="text-capitalize">
                                                                                country</label>
                                                                            <input type="text" name="scountry" id="scountry"
                                                                                class="form-control " placeholder="scountry"
                                                                                aria-describedby="saddress"
                                                                                style="border-radius: 20px" value="{{$user->scountry}}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="text-capitalize">
                                                                                city</label>
                                                                            <input type="text" name="scity" id="scity"
                                                                                class="form-control " placeholder="scity"
                                                                                aria-describedby="address"
                                                                                style="border-radius: 20px" value="{{$user->scity}}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="text-capitalize">
                                                                                postcode</label>
                                                                            <input type="number" name="spostcode" id="spostcode"
                                                                                class="form-control " placeholder="spostcode"
                                                                                aria-describedby="address"
                                                                                style="border-radius: 20px" value="{{$user->spostcode}}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!-- End .card-body -->
                                            </div><!-- End .card-dashboard -->
                                        </div><!-- End .col-lg-6 -->
                                    </div><!-- End .row -->
                                </div><!-- .End .tab-pane -->

                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->

@endsection
