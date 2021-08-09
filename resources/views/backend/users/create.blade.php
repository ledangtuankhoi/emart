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
                            <h4 class="card-title">Creat User</h4>
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
                            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Full Name</label>
                                            <input type="text" name="full_name" value="{{ old('full_name') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">User Name</label>
                                            <input type="text" name="username" value="{{ old('username') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating text-capitalize">password</label>
                                            <input type="password" name="password" value=""
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Phone</label>
                                            <input type="phone" name="phone" value="{{ old('phone') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating text-capitalize">Address</label>
                                            <input type="text" name="address" value="{{ old('address') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                {{-- file laravel manager --}}
                                <div class="row">
                                    <div class="col-md-10 pe-0">
                                        <div class="form-group">
                                            <label>photo</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-picture-o"></i> Choose
                                                        </a>
                                                    </span>
                                                    <input id="thumbnail" class="form-control" type="text" name="photo"
                                                        value="{{ old('photo') }}">
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
                                            <label class="text-capitalize">role</label>
                                            <select class="custom-select" name="role" aria-label="Default select example">
                                                <option value="" class="text-capitalize">---Role---</option>
                                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}
                                                    class="text-capitalize">admin</option>
                                                <option value="vendor" {{ old('role') == 'vendor' ? 'selected' : '' }}
                                                    class="text-capitalize">vendor</option>
                                                <option value="customer"
                                                    {{ old('role') == 'customer' ? 'selected' : '' }}
                                                    class="text-capitalize">customer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select class="custom-select" name="status" aria-label="Default select example">
                                                <option value=" ">---Status----
                                                </option>
                                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="inactive"
                                                    {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                    Inactive</option>
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

    <script>
        $(document).ready(function() {
            $('#summary').summernote();
        });
    </script>

    {{-- file manager of unishape --}}
    <script>
        $('#lfm').filemanager('image');
    </script>

    <script>
        $('#cat_id').change(function() {
            var cat_id = $(this).val();
            // alert(cat_id);
            if (cat_id != null) {
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        cat_id: cat_id,
                    },
                    success: function(response) {
                        // console.log(response);
                        var html_option = "<option value='' >>---Child Category----<</option>";
                        if (response.status) {
                            $('#child_cat_id_div').removeClass('d-none');
                            $.each(response.data, function(id, title) {
                                html_option += "<option value='" + id + "' >" + title +
                                    "</option>"
                            });
                        } else {
                            $('#child_cat_id_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);

                    }
                })
            }
        })
    </script>

@endsection
