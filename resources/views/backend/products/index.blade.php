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
                                        <h4 class="card-title ">Product Table 
                                            <a class="btn btn-outline-success" href="{{route('product.create')}}" role="button">
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
                                                <td>
                                                    {{ $item->title }}
                                                </td>
                                                <td class="m-auto">
                                                    <img src="{{ $item->photo }}" alt="" height="60">
                                                </td>
                                                <td>
                                                    {{ number_format($item->price,2)}}
                                                </td>
                                                <td>
                                                    {{ number_format($item->discount,2)}}
                                                </td>
                                                <td>
                                                    {{ $item->size}}
                                                </td> 
                                                <td>
                                                    @php
                                                        if ($item->condition == 'new') {
                                                            echo "<p class='border border-primary rounded text-center text-primary mx-1'>New</p>";
                                                        } elseif ($item->condition == 'popular') {
                                                            echo "<p class='border border-danger rounded text-center  text-danger mx-1'>Popular</p>";
                                                        }elseif ($item->condition == 'winter') {
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
                                                <td>
                                                    <a href="{{ route('product.edit', $item->id) }}" data-toggle="tooltip"
                                                        title="Edit" class=" float-left btn btn-sm btn-outline-warning">
                                                        <span class="material-icons">edit</span>
                                                    </a>
                                                    <form action="{{ route('product.destroy', $item->id) }}" method="post">
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
                    URL: "{{route('product.status')}}",
                    type: "POST",
                    data: {
                        _token: '{{csrf_token()}}',
                        mode: mode,
                        id: id,
                    },
                    success: function(response) {
                        if (response.status) {
                            alert(response.msg)
                        } else {
                            alert('try again')
                        }
                    }
                })
            });
        </script>
    @endsection
