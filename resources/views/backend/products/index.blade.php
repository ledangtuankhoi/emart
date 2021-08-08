@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-toggle-master/css/bootstrap-toggle.min.css') }}">
@endsection
@extends('backend.layouts.master')

@section('content')
    <style>
        .material-icons {
            font-size: 12px !important;
        }

    </style>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('backend.notification')
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div>
                                        <h4 class="card-title ">Product Table
                                            <a class="btn btn-outline-success" href="{{ route('product.create') }}"
                                                role="button">
                                                <span class="material-icons mx-1">
                                                    add_circle_outline
                                                </span>
                                                Crete
                                            </a>
                                        </h4>
                                        <p class="card-category"> Here is a subtitle for this table</p>
                                    </div>
                                </div>


                                <div>
                                    <p>Total anner:{{ App\Models\Product::count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            S.N
                                        </th>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            Photo
                                        </th>
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            Discout
                                        </th>
                                        <th>
                                            Size
                                        </th>
                                        <th>
                                            Condition
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $item)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td  >
                                                    {{ $item->title }}
                                                </td>
                                                <td class="m-auto">
                                                    <img srproduct src="{{ $item->photo }}" alt="" height="60">
                                                </td>
                                                <td>
                                                    {{ number_format($item->price, 2) }}
                                                </td>
                                                <td>
                                                    {{ number_format($item->discount, 2) }}
                                                </td>
                                                <td>
                                                    {{ $item->size }}
                                                </td>
                                                <td>
                                                    @php
                                                        if ($item->condition == 'new') {
                                                            echo "<p class='border border-primary rounded text-center text-primary mx-1'>New</p>";
                                                        } elseif ($item->condition == 'popular') {
                                                            echo "<p class='border border-danger rounded text-center  text-danger mx-1'>Popular</p>";
                                                        } elseif ($item->condition == 'winter') {
                                                            echo "<p class='border border-secondary rounded text-center  text-secondary mx-1'>Winter</p>";
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    <input name="toggle" value="{{ $item->id }}" class="toggle-tow"
                                                        type="checkbox" data-toggle="toggle" data-on="Active"
                                                        data-off="InActive" data-onstyle="success" data-offstyle="danger"
                                                        data-size="small"
                                                        {{ $item->status == 'active' ? 'checked' : ' ' }}>

                                                </td>
                                                <td class="m-0 p-0">
                                                    <div class="d-flex justify-content-center">


                                                        <a href="javascript:void(0);" title="View" data-toggle="modal"
                                                            data-target="#productID{{ $item->id }}"
                                                            class=" float-left btn btn-sm btn-outline-primary">
                                                            <span class="  material-icons">visibility</span>
                                                        </a>
                                                        <a href="{{ route('product.edit', $item->id) }}"
                                                            data-toggle="tooltip" title="Edit"
                                                            class=" float-left btn btn-sm btn-outline-warning">
                                                            <span class="material-icons">edit</span>
                                                        </a>

                                                    </div>
                                                    <div class="d-flex justify-content-center">

                                                        <form action="{{ route('product.destroy', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="" data-toggle="tooltip" title="delete"
                                                                data-id="{{ $item->id }}"
                                                                class="dltBtn btn btn-sm btn-outline-danger">
                                                                <span class="material-icons">delete</span>
                                                            </a>
                                                        </form>

                                                    </div>

                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="productID{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            @php
                                                                $product = App\Models\Product::where('id',$item->id)->first();
                                                            @endphp
                                                            <h5 class="modal-title" id="exampleModalLabel">{{$product->title}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <strong><b> Summary: </b></strong>
                                                            <p>{!! html_entity_decode($product->summary)!!}</p>
                                                            <strong><b> Description: </b></strong>
                                                            <p>{!! html_entity_decode($product->description)!!}</p>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong><b>Price</b>:</strong>
                                                                    <p>${{number_format($item->price,2)}}</p>
                                                                </div>
                                                                <div class="col-md-6">

                                                                    <strong><b>Discount</b>:</strong>
                                                                    <p>{{number_format($item->discount,2)}}%</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong><b>Category</b>:</strong>
                                                                    <p>{{App\Models\Category::where('id',$product->cat_id)->value('title')}}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong><b>Child Category</b>:</strong>
                                                                    <p>{{App\Models\Category::where('id',$product->child_cat_id)->value('title')}}</p>

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong><b>Brand</b>:</strong>
                                                                    <p>{{App\Models\Brand::where('id',$product->brand_id)->value('title')}}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong><b>size</b>:</strong>
                                                                    <p class="btn btn-outline-primary btn-sm"> {{$product->size}}</p>

                                                                </div>
                                                            </div> 
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong><b>Condition</b>:</strong>
                                                                    <p class="btn btn-outline-info btn-sm" >{{$product->condition}}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong><b>Status</b>:</strong>
                                                                    <p class="btn btn-outline-secondary btn-sm"> {{$product->status}}</p>

                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @section('scripts')
        <script src="{{ asset('vendor/bootstrap-toggle-master/js/bootstrap-toggle.min.js') }}"></script>
        {{-- cdn show alert --}}
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        {{-- view product ajax --}}
        {{-- <script>
            $('.view').click(function(e) {
                var pro_id = $(this).attr('data').val();
                console.log(pro_id);
                e.preventDefault();
            })
        </script> --}}



        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                e.preventDefault();
                console.log('asd');
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                            });
                            form.submit();
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });
            });
        </script>

        <script>
            $('input[name=toggle]').change(function() {
                var mode = $(this).prop('checked');
                var id = $(this).val();
                // alert(mode);
                $.ajax({
                    URL: "{{ route('product.status') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        mode: mode,
                        id: id,
                    },
                    success: function(response) {
                        if (response.status) {
                            alert(response.msg)
                        } else {
                            alert('try again')
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                })
            });
        </script>
    @endsection
