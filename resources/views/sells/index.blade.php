@extends('layouts.main')
@section('title','Sell')
@section('content')

@include( '../sweet_script')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">@yield('title')</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Manage @yield('title')</h4>
                        @can('sell-create')
                            <a  href="{{ route('sells.create') }}" class="btn btn-primary btn-xs ml-auto">
                            <i class="fa fa-plus"></i> Add new</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="display table table-striped table-hover" style="width: 100%;" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th> Order#</th>
                                    <th> Customer Name</th>
                                    <!-- <th> Invoice Date</th> -->
                                    <th width="10%" >Action</th>
                                </tr>
                            </thead>
                          
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {  

    var t = $('#myTable').DataTable({
          "aaSorting": [],
            "processing": true,
            "serverSide": false,
            "select":true,
            "ajax": "{{ url('sellList') }}",
            "method": "GET",
            "columns": [
                {"data": "srno"},
                {"data": "order_no"},
                {"data": "customer_name"},
                // {"data": "invoice_date"},
                // {"data": "pay_amount"},
                {"data": "action",orderable:false,searchable:false}

            ]
        });
     t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();


    });
</script>
@endsection
