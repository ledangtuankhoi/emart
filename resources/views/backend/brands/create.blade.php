@section('styles')
    {{-- sumernote --}}
    <link rel="stylesheet" href="{{ asset('backend\assets\summernote\summernote-bs4.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> --}}
@endsection
@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Creat Banner</h4>
                            <p class="card-category">Complete your profile</p>
                            {{-- error --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                        </div>
                        <div class="card-body">
                            <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Title</label>
                                            <input type="text" name="title" value="{{old('title')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                {{-- file laravel manager --}}
                                <div class="row">
                                    <div class="col-md-10 pe-0">
                                        <div class="form-group">
                                            <label>About Me</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-picture-o"></i> Choose
                                                        </a>
                                                    </span>
                                                    <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
                                                    <label class="bmd-label-floating"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 ps-0">
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="custom-select" name="status" aria-label="Default select example">
                                                <option value="active" {{old('status')=='active'?'selected':''}} >Active</option>
                                                <option value="inactive"{{old('status')=='inactive'?'selected':''}}  >Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 

                                <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="card-avatar">
                            <a href="javascript:;">
                                <img class="img" src="{{ asset('backend/assets/img/faces/marc.jpg') }}" />
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-category text-gray">CEO / Co-Founder</h6>
                            <h4 class="card-title">Alec Thompson</h4>
                            <p class="card-description">
                                Don't be scared of the truth because we need to restart the human foundation in truth And I
                                love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                            </p>
                            <a href="javascript:;" class="btn btn-primary btn-round">Follow</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="{{ asset('backend\assets\summernote\summernote-bs4.min.js') }}"></script>

    {{-- summernote editor --}}
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
    {{-- file manager of unishape --}}
    <script>
        $('#lfm').filemanager('image');
    </script>
@endsection
