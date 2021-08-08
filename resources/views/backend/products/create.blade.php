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
                            <h4 class="card-title">Creat Product</h4>
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
                            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Title</label>
                                            <input type="text" name="title" value="{{ old('title') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                {{-- editor summernote --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Summary</label>
                                            <div class="form-group">
                                                <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so
                                                    thirsty, I'm in that two seat Lambo.</label>
                                                <textarea id="summary" name="summary" class="form-control"
                                                    rows="5">{{old('summary')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- editor summernote --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <div class="form-group">
                                                <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so
                                                    thirsty, I'm in that two seat Lambo.</label>
                                                <textarea id="description" name="description" class="form-control"
                                                    rows="5">{{old('description')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Stock</label>
                                            <input type="number" name="stock" value="{{ old('stock') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Price</label>
                                            <input type="number" name="price" value="{{ old('price') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Discount</label>
                                            <input min="0" max="100" type="number" name="discount" value="{{ old('discount') }}"
                                                class="form-control">
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
                                            <label class="">Brand</label>
                                            <select class="custom-select" name="brand_id"
                                                aria-label="Default select example">
                                                <option value="">---Brand---</option>
                                                @foreach (App\Models\Brand::get() as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select class="custom-select" id="cat_id" name="cat_id"
                                                aria-label="Default select example">
                                                <option value="">---Category ---</option>
                                                @foreach (App\Models\Category::get() as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-none" id="child_cat_id_div">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Category Child</label>
                                            <select class="custom-select"  name="child_cat_id" id="child_cat_id" aria-label="Default select example">

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="">Size</label>
                                            <select class="custom-select" name="size" aria-label="Default select example">
                                                <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>S</option>
                                                <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>M</option>
                                                <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>L</option>
                                                <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>XL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Condition</label>
                                        <div class="form-group">
                                            <select class="custom-select" name="condition"
                                                aria-label="Default select example">
                                                <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>new
                                                </option>
                                                <option value="popular" {{ old('condition') == 'popular' ? 'selected' : '' }}>
                                                    popular</option>
                                                <option value="winter" {{ old('condition') == 'winter' ? 'selected' : '' }}>
                                                    winter</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Vendor</label>
                                            <select class="custom-select" name="vendor_id" aria-label="Default select example">
                                                <option value="">---Vendor ---</option>
                                                @foreach (App\Models\User::get() as $vendor)
                                                    <option value="{{ $vendor->id }}">{{ $vendor->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select class="custom-select" name="status" aria-label="Default select example">
                                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
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
                    url: "/admin/category/"+cat_id+"/child",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        cat_id: cat_id,
                    },
                    success: function(response) {
                        // console.log(response);
                        var html_option = "<option value='' >>---Child Category----<</option>";
                        if(response.status){
                            $('#child_cat_id_div').removeClass('d-none');
                            $.each(response.data, function (id,title) { 
                                 html_option += "<option value='"+id+"' >"+title+"</option>"
                            });
                        }
                        else{
                            $('#child_cat_id_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);
                        
                    }
                })
            }
        })
    </script>

@endsection
