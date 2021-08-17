@section('styles')
    {{-- sumernote --}}
    <link rel="stylesheet" href="{{ asset('backend\assets\summernote\summernote-bs4.min.css') }}">
@endsection
@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Creat Category</h4>
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
                            <form action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Code</label>
                                            <input type="text" name="code" value="{{old('code')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Coupon Value</label>
                                            <input type="number" name="value" value="{{old('value')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="type" class="text-capitalize"> type</label>
                                            <select class="custom-select" name="type" aria-label="Default select example">
                                                <option class="text-capitalize">>--Type------<</option>
                                                <option value="fixed" {{old('type')=='fixed'?'selected':''}} class="text-capitalize">fixed</option>
                                                <option value="percent" {{old('type')=='percent'?'selected':''}} class="text-capitalize">percent</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="status"> Status</label>
                                            <select class="custom-select" name="status" aria-label="Default select example">
                                                <option value=""  >>--Status------<</option>
                                                <option value="active" {{old('status')=='active'?'selected':''}} >Active</option>
                                                <option value="inactive" {{old('status')=='inactive'?'selected':''}}>Inactive</option>
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
            $('#summary').summernote('focus');
        });
    </script>
    {{-- file manager of unishape --}}
    <script>
        $('#lfm').filemanager('image');
    </script>
    {{-- is_parent --}}
    <script>
        $('#is_parent').change(function(e){
            e.preventDefault();
            var is_checked = $(this).prop('checked');
            if (is_checked) {
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val(' ');
                // $('#is_parent').val('');
            }else{
                $('#parent_cat_div').removeClass('d-none');
            }
        });
    </script>
@endsection
