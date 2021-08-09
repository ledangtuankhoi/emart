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
                                        <h4 class="card-title ">User Table
                                            <a class="btn btn-outline-success" href="{{ route('user.create') }}"
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
                                    <p>Total anner:{{ App\Models\User::count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            
                                        </th>
                                        <th>
                                            Photo
                                        </th>
                                        <th>
                                            Full Name
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Phone
                                        </th>
                                        <th>
                                            Address
                                        </th>
                                        <th>
                                            Role
                                        </th> 
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="m-auto">
                                                    <img srproduct style="border-radius: 50%" src="{{ $item->photo }}" alt="" height="60">
                                                </td>
                                                <td  >
                                                    {{ $item->full_name }}
                                                </td>
                                                <td  >
                                                    {{ $item->email }}
                                                </td>
                                                <td  >
                                                    {{ $item->phone }}
                                                </td>
                                                <td  >
                                                    {{ $item->address }}
                                                </td> 
                                                <td>
                                                    @php
                                                        if ($item->role == 'admin') {
                                                            echo "<p class='border border-primary rounded text-center text-primary mx-1'>Admin</p>";
                                                        } elseif ($item->role == 'vendor') {
                                                            echo "<p class='border border-danger rounded text-center  text-danger mx-1'>Vendor</p>";
                                                        } elseif ($item->role == 'customer') {
                                                            echo "<p class='border border-secondary rounded text-center  text-secondary mx-1'>Customer</p>";
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
                                                            data-target="#userID{{ $item->id }}"
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
                                            <div class="modal fade" id="userID{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            @php
                                                                $user = App\Models\User::where('id',$item->id)->first();
                                                            @endphp
                                                            <div class="d-flex flex-row">
                                                                <div class="p-2">
                                                                    <img style="border-radius: 50%" src="{{$user->photo}}" alt="">
                                                                </div>
                                                                <div class="p-2">
                                                                    <h5 class="modal-title" id="exampleModalLabel">{{$user->full_name}}</h5>
                                                                    <p class="modal-title" id="exampleModalLabel">{{$user->username}}</p>
                                                                </div>
                                                              </div>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body"> 
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <strong><b class="text-capitalize">username</b>:</strong>
                                                                    <p class=" " >{{$user->username}}</p>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <strong><b class="text-capitalize">email</b>:</strong>
                                                                    <p class=" " >{{$user->email}}</p>
                                                                </div>
                                                            </div> 
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <strong><b class="text-capitalize">role</b>:</strong> @php
                                                                    if ($item->role == 'admin') {
                                                                        echo "<p class='border border-primary rounded text-center text-primary mx-1'>Admin</p>";
                                                                    } elseif ($item->role == 'vendor') {
                                                                        echo "<p class='border border-danger rounded text-center  text-danger mx-1'>Vendor</p>";
                                                                    } elseif ($item->role == 'customer') {
                                                                        echo "<p class='border border-secondary rounded text-center  text-secondary mx-1'>Customer</p>";
                                                                    }
                                                                @endphp
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <strong><b class="text-capitalize">phone</b>:</strong>
                                                                    <p class=" " >{{$user->phone}}</p>
                                                                </div>
                                                            </div> 
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <strong><b class="text-capitalize">status</b>:</strong>  
                                                                    @php
                                                                        if ($item->status == 'active') {
                                                                        echo "<p class='border border-primary rounded text-center text-primary mx-1'>Active</p>";
                                                                    } elseif ($item->status == 'inactive') {
                                                                        echo "<p class='border border-danger rounded text-center  text-danger mx-1'>Inacive</p>";
                                                                    }  
                                                                    @endphp
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <strong><b class="text-capitalize">address</b>:</strong>
                                                                    <p class=" " >{{$user->address}}</p>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary text-capitalize"
                                                                data-dismiss="modal">export</button> 
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
