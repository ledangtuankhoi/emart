@section('styles')
  <link rel="stylesheet" href="{{asset('vendor/bootstrap-toggle-master/css/bootstrap-toggle.min.css')}}">
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
                            <h4 class="card-title ">Simple Table</h4>
                            <p class="card-category"> Here is a subtitle for this table</p>
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
                                            Description
                                        </th>
                                        <th>
                                          Photo
                                        </th>
                                        <th>
                                            Condision
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Dakota Rice
                                            </td>
                                            <td>
                                                Niger
                                            </td>
                                            <td>
                                     ư           Oud-Turnhout
                                            </td>
                                            <td class="text-primary">
                                                $36,738
                                            </td>
                                            <td class="text-primary">
                                                $36,738
                                            </td>
                                        </tr>
                                        @foreach ($banners as $item)
                                        <tr>
                                          <td>
                                              {{-- {{$loop->iteratio}} --}}
                                          </td>
                                          <td>
                                            {{$item->title}}
                                          </td>
                                          <td>
                                            {{$item->description}}
                                          </td>
                                          <td class="m-auto">
                                            <img src="{{$item->photo}}" alt="" height="60" >
                                          </td>
                                          <td>
                                            @php
                                                if ($item->condition == 'promo') {
                                                  echo "<p class='border border-info rounded text-center text-info mx-1'>promo</p>";
                                                }elseif ($item->condition == 'banner') {
                                                  echo "<p class='border border-primary rounded text-center  text-primary mx-1'>banner</p>";
                                                }
                                            @endphp
                                            {{-- {{$item->condition}} --}}
                                          </td>
                                          <td>
                                            <input class="toggle-two" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" data-onstyle="success" data-offstyle="danger" data-size="small" {{$item->status == 'active'? 'checked' : ' '}}>
                                            {{-- @php
                                                if ($item->status == 'active') {
                                                  echo '<input class="toggle-two" type="checkbox" checked data-toggle="toggle" data-on="Ready" data-off="Not Ready" data-onstyle="success" data-offstyle="danger" data-size="small">';
                                                  // echo "<p class='text-success'>Active</p>";
                                                }elseif ($item->status == 'inactive') {
                                                  echo '<input type="checkbox"  data-toggle="toggle" data-on="Ready" data-off="Not Ready" data-onstyle="success" data-offstyle="danger" data-size="small">';
                                                }
                                            @endphp --}}
                                          </td>
                                          <td >
                                            <a href="" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-outline-warning">
                                              <span class="material-icons">edit</span>
                                            </a>
                                            <a href="" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-outline-danger">
                                            <span class="material-icons">delete</span>
                                            </a>  
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
        <script src="{{asset('vendor/bootstrap-toggle-master/js/bootstrap-toggle.min.js')}}"></script>

@endsection