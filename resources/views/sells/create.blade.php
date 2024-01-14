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
                        <h4 class="card-title">Add @yield('title')</h4>
                        <a  href="{{ route('sells.index') }}" class="btn btn-primary btn-xs ml-auto">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                    <!--begin::Form-->
                    {!! Form::open(array('route' => 'sells.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data')) !!}
                        {{  Form::hidden('created_by', Auth::user()->id ) }}
                        {{  Form::hidden('direction', '1' ) }}
                        {{  Form::hidden('customer_id', Auth::user()->id ) }}

                        {!! Form::hidden('pay_amount', 0, array('placeholder' => 'Enter payment amount', 'id'=>'pay_amount', 'class' => 'form-control', 'onchange'=>'calc_value()')) !!}


<!-- 
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('pay_amount',' Payment Amount')) !!}
                                        {!! Form::number('pay_amount', 0, array('placeholder' => 'Enter payment amount','class' => 'form-control', 'onchange'=>'calc_value()')) !!}
                                        @if ($errors->has('pay_amount'))  
                                            {!! "<span class='span_danger'>". $errors->first('pay_amount')."</span>"!!} 
                                        @endif
                                    </div>
                                </div> -->

                        

                        <div class="card-body">

                            <h4 class="card-title"> Select Item</h4>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table id="" class="table">
                                        <tbody>
                                            <tr>
                                                <td width="80%" style="text-align:left"> 
                                                    {!! Form::select("item", $items,null, array("class"=> "form-control cls_item","id"=>"item")) !!}
                                                </td>
                                                <td width="15%" style="text-align:left"> 
                                                    {!! Form::number('static_qty', 1, array('class' => 'form-control',"id"=>"static_qty")) !!}
                                                </td>
                                                <td width="5%"><input class="btn btn-success btn-sm" type="button" onclick="add_item_row();" value="+"></td>
                                            </tr>
                                        <tbody>
                                    </table>
                                </div>
                            </div>


                            <h4 class="card-title">Item Details</h4>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table id="itemTable" class="table">
                                            <thead>
                                                <tr>
                                                    <th width="70%">Items </th>
                                                    <th width="10%">Sell Price  </th>
                                                    <th width="15%">Qty</th>
                                                    <th width="5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody><tbody>
                                        </table>
                                    </div>
                                    <div id="calc"></div>
                                    <div id="summary"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <button type="submit" class="btn btn-primary btn-sm mr-2">Save</button>
                                    <button type="reset" class="btn btn-danger btn-sm">Cancel</button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
</div>
  
    <!-- item table -->
    <script type="text/javascript">
        function add_item_row(){
            var check       = 0;
            var $item       = $(".cls_item").val();
            var $static_qty = document.getElementById('static_qty').value; 
            var itm_id      = $("input[name='item_id\\[\\]']")
                                .map(function(){
                                    return $(this).val();
                                }).get();
                            
            if((itm_id.length>0)){    
                // console.log(itm_id.length);
                // console.log("if");           
                itm_id.forEach(function(id) {
                    // console.log("id: " +$item); 
                    // console.log("id: " +id);    
                    if($item != id){
                        check = 1;
                       
                    }else{
                        check = 0;
                    }
                });
            }else{
                check = 1;
                // console.log("else");           
            }
            if(check == 1){
                // console.log(item);
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: "{{ url('fetch_item_unit_detail') }}",
                    method: 'POST',
                    data: {item:$item, _token:token},
                    success: function(data) {
                        console.log(data);
                        // var unit_id = data.unit.id;
                        // var piece = 0;
                        // // console.log(data.data.tot_piece);
                        // if ( unit_id ==1 || unit_id ==2){
                        //     // console.log('cartoon/ bora');
                        //     piece = data.data.tot_piece;
                            
                        //     // console.log("piece: " + data.data.tot_piece);
                        // }else if( unit_id == 3 ){
                        //     piece = 12;
                        //     // console.log('dozen');
                        // }else{
                        //     piece = 1;
                        //     // console.log('piece');
                        // }
                        // price = Math.round(piece * data.data.unit_sell_price);
                        price = Math.round(data.data.sell_price);
                        
                        var $name = data.data.name;

                        $rowno=$("#itemTable tr").length;
                        // $rowno=$rowno+1;
                        $("#itemTable tr:last").after("<tr id='row_itemTable"+$rowno+"'>"+
                                "<td> " +
                                    '<input type="hidden" id="item_id['+$rowno+']" name="item_id[]" value ="'+data.data.id+'" class="form-control" readonly>'+
                                    '<input type="text" id="item_name['+$rowno+']" name="item_name[]" value ="'+data.data.name+'" class="form-control" readonly>'+
                                "</td>"+
                                "<td> " +
                                    '<input type="number" id="sell_price[]" name="sell_price[]" value ="'+price+'" class="form-control" readonly>'+
                                "</td>"+
                                "<td> " +
                                    '<input type="number" id="sell_qty[]" name="sell_qty[]" value ="'+$static_qty+'" class="form-control" onchange="calc_value()" >'+
                                "</td>"+
                                "<td  width='40px'>"+
                                    "<input class='btn btn-danger btn-sm' type='button' value='-' onclick=delete_item_row('row_itemTable"+$rowno+"')>"+
                                "</td>"+
                        "</tr>");
                        calc();
                        if($rowno==1){
                            $("#calc").html(
                                '<table id="calcTable" class="table">'+
                                    '<tbody>'+
                                        '<tr>'+
                                            '<td colspan="4" style="text-align:right"> </td>'+
                                            '<td width="5%"><input class="btn btn-success btn-sm" type="button" onclick="calc();" value="Calculate"></td>'+
                                        '</tr>'+
                                    '<tbody>'+
                                '</table>'
                            );
                        }
                    }
                });
                calc_value();
            }else{
                alert("This item is already added.");
            }
        }
        function delete_item_row(rowno){
            $('#'+rowno).remove();
            if(document.getElementById('summaryTable') ){
                calc();
            }
           
            $rowno=$("#itemTable tr").length;
            // console.log($rowno);
            if($rowno==1){
                $('#calcTable').remove(); 
                $('#summaryTable').remove(); 
            }
        }
        function calc_value(){
            if(document.getElementById('summaryTable') ){
                calc();
            }

        }
        function calc(){
            // if(document.getElementById('summaryTable') ){
                var sell_qty        = 0;
                var item_qty        = 0;
                var net_amount      = 0;
                var tot_sell_price  = 0;


                sell_qty                = $("input[name='sell_qty\\[\\]']")
                                            .map(function(){
                                                return $(this).val();
                                            }).get();

                var sell_price          = $("input[name='sell_price\\[\\]']")
                                            .map(function(){
                                                return $(this).val();
                                            }).get();
                
                for (x in sell_price) {
                        var qty = parseInt(sell_qty[x]);
                        var price = parseInt(sell_price[x]);

                    item_qty             = qty * price;
                    tot_sell_price      += item_qty;
                    }
                var pay_amount          = document.getElementById('pay_amount').value; 
                $("#summary").html(
                        '<table id="summaryTable" class="table" style="margin-left: 70%; max-width: 30%">'+
                            '<tbody>'+
                                '<tr>'+
                                    '<th style="width: 15%">Total Amount</th>'+
                                    '<th style="width: 15%">'+tot_sell_price+'</th>'+
                                    '<input type="hidden" name = "total_amount" value="'+tot_sell_price+'">'+
                                '<tr>'+
                            '<tbody>'+
                        '</table>'
                    );
            }

            // '<tr>'+
            //     '<th style="width: 15%"> Payment </th>'+
            //     '<th style="width: 15%">'+pay_amount+'</th>'+
            //     '<input type="hidden" name = "pay_amount" value="'+pay_amount+'">'+
            // '<tr>'+

       
    </script>

@endsection
