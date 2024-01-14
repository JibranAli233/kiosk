@extends('layouts.main')
@section('title','Sells')
@section('content')
@include( '../sweet_script')
<style>
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    
</style>

<div class="page-inner" id="main">
    <div class="page-header">
        <h4 class="page-title" style="color:black !important;">@yield('title')</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-print-none">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title" style="color:black !important;">Show @yield('title')</h4>
                        <div class="btn-group btn-group ml-auto ">
                            <a  href="{{ route('sells.index') }}" class="btn btn-primary btn-sm ">
                            <i class="fas fa-arrow-left"></i></a>
                            <button    class="btn btn-info btn-sm "  onclick="printDiv('main')">
                            <i class="fa fa-print"></i></button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table dt-responsive">
                                    <tr>
                                        <th style="color:black !important;">Customer Name</th>
                                        <td style="color:black !important;">{{ isset($data->customer_name) ? $data->customer_name : ''}}</td>
                                        <th style="color:black !important;">Bill No</th>
                                        <td style="color:black !important;">{{ isset($data->id) ? $data->id : ''}}</td>
                                        
                                    </tr>
                                    
                                    <tr class="d-print-none">
                                        <th style="color:black !important;">Total Amount </th>
                                        <td style="color:black !important;">{{ isset($data->total_amount) ? $data->total_amount : ''}}</td>
                                        <th style="color:black !important;">Payment </th>
                                        <td style="color:black !important;">{{ isset($data->credit) ? $data->credit : ''}}</td>
                                        
                                    </tr>


                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title" style="color:black !important;">Item Details</h4>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table dt-responsive">
                                    <thead>
                                        <tr>
                                            <th width = "5%"  style="color:black !important;">Sr#</th>
                                            <th width = "35%" style="color:black !important;">Item Name</th>
                                            <th width = "15%" style="color:black !important;">Qty  </th>
                                            <th width = "15%" style="color:black !important;">Sell Price</th>
                                            <th width = "15%" style="color:black !important;">Sell Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $tot_amount = 0;?>
                                        @foreach($selected_items as $key =>$value)
                                        <?php 
                                            $sell_qty   = isset($value->sell_qty) ? $value->sell_qty : 0;
                                            $sell_price = isset($value->sell_price) ? $value->sell_price : 0;
                                            $tot_amount += ( $value->sell_qty *$value->sell_price);?>
                                            <tr>
                                                <td style="color:black !important;">{{ $key+1 }}</td>
                                                <th style="color:black !important;">{{ isset($value->item_name) ? $value->item_name : '' }}</th>
                                                <td style="color:black !important;">{{ isset($value->sell_qty) ? $value->sell_qty : '' }}</td>
                                                <td style="color:black !important;">{{ isset($value->sell_price) ? $value->sell_price : '' }}</td>
                                                <td style="color:black !important;">{{ $sell_qty * $sell_price }}</td>
                                            </tr>
                                        @endforeach
                                    <tbody>

                                </table>
                                <br>
                                <table id="summaryTable" class="table" style="margin-left: 70%; max-width: 30%">
                                   <tbody>
                                       <tr>
                                           <th style="width: 15%;color:black !important;">Total Amount</th>
                                           <th style="width: 15%;color:black !important;">{{ $tot_amount }}</th>
                                       <tr>
                                       <tr>
                                           <th style="width: 15%;color:black !important;">Total Payment </th>
                                           <th style="width: 15%;color:black !important;">{{ $data->credit }}</th>
                                       <tr>

                                       <tr>
                                           <th style="width: 20%;color:black !important;"> Net-Amount </th>
                                           <th style="width: 20%;color:black !important;">{{ ($data->credit  - $tot_amount) }} </th>
                                       <tr>
                                   <tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function printDiv(divName){
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>


@endsection
