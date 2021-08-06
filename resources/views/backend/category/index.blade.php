@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-toggle-master/css/bootstrap-toggle.min.css') }}">
@endsection
@extends('backend.layouts.master')

@section('content')
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
                                        <h4 class="card-title ">Category Table 
                                            <a class="btn btn-outline-success" href="{{route('category.create')}}" role="button">
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
                                    <p>Total anner:{{ App\Models\Category::count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            photo
                                        </th>
                                        <th>
                                            Is parent
                                        </th>
                                        <th>
                                            Parents
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $item)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $item->title }}
                                                </td>
                                                <td class="m-auto">
                                                    <img src="{{ $item->photo }}" alt="" height="60">
                                                </td>
                                                <td>
                                                    @php
                                                        if ($item->is_parent === 1) {
                                                            echo "<p class='border border-info rounded text-center text-info mx-1'>Yes</p>";
                                                        } else{
                                                            echo "<p class='border border-danger  rounded text-center  text-danger mx-1'>No</p>";
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    {{ App\Models\Category::where('parent_id',$item->parent_id)->value('title') }}
                                                </td>
                                                <td>
                                                    <input name="toggle" value="{{ $item->id }}" class="toggle-tow"
                                                        type="checkbox" data-toggle="toggle" data-on="Active"
                                                        data-off="InActive" data-onstyle="success" data-offstyle="danger"
                                                        data-size="small"
                                                        {{ $item->status == 'active' ? 'checked' : ' ' }}>

                                                </td>
                                                <td>
                                                    <a href="{{ route('category.edit', $item->id) }}"
                                                        data-toggle="tooltip" title="Edit"
                                                        class=" float-left btn btn-sm btn-outline-warning">
                                                        <span class="material-icons">edit</span>
                                                    </a>
                                                    <form action="{{ route('category.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="" data-toggle="tooltip" title="delete"
                                                            data-id="{{ $item->id }}"
                                                            class="dltBtn btn btn-sm btn-outline-danger">
                                                            <span class="material-icons">delete</span>
                                                        </a>
                                                    </form>
                                                </td>
                                            </tr>
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
                    URL: "{{route('category.status')}}",
                    type: "POST",
                    data: {
                        _token: '{{csrf_token()}}',
                        mode: mode,
                        id: id,
                    },
                    success: function(response) {
                        if (response.status) {
                            alert(response.msg);
                        } else {
                            // console.log(response);
                            alert('try again');
                        }
                    },
                    error:function(response){
                        console.log(response);
                    }
                })
            });
        </script>
    @endsection
