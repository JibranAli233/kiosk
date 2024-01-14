@extends('layouts.main')
@section('title','Item')
@section('content')
@include( '../sweet_script')
    <div class="page-inner">
        <h4 class="page-title">@yield('title') </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">@yield('title')</h4>
                            <a  href="{{ route('items.index') }}" class="btn btn-primary btn-xs ml-auto">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table dt-responsive">
                                        <tr>
                                            <th>Item name</th>
                                            <td>{{isset($data->name) ? $data->name : ""}}</td>
                                        
                                            <th>Manufacturer / Company </th>
                                            <td>{{isset($data->manufacturer->name) ? $data->manufacturer->name : ""}}</td>
                                        
                                            <th>Category</th>
                                            <td>{{isset($data->category->name) ? $data->category->name : ""}}</td>
                                        </tr>

                                        <tr>
                                            
                                            <th>Purchase price</th>
                                            <td>{{isset($data->purchase_price) ? $data->purchase_price : ""}}</td>
                                            
                                            <th>Sell Price</th>
                                            <td>{{isset($data->sell_price) ? $data->sell_price : ""}}</td>
                                          
                                            <th>Status</th>
                                            <td>
                                                @if((isset($data->active)) && ( ($data->active == 1) || ($data->active == "Active") ) )
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <br>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
  

@endsection
