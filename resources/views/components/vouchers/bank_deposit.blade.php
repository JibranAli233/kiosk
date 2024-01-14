<!--begin::Form-->
@php 
    $method = ((isset($data)) ? 'PATCH': 'POST');
@endphp
{!! Form::open(array('method'=>$method,'id'=>'bnk_dpst_form','enctype'=>'multipart/form-data')) !!}
    {{  Form::hidden('created_by', Auth::user()->id ) }}
    {{  Form::hidden('company_id', Auth::user()->company_id ) }}
    {{  Form::hidden('branch_id', Auth::user()->branch_id ) }}
    {{  Form::hidden('action', "store" ) }}
    {{  Form::hidden('transaction_type_id', 0 , array("class" => "cls_transaction_type")) }}
    {{  Form::hidden('custom_id', (isset($data->custom_id) ? $data->custom_id : 0) , array("class" => "bdv_custom_id")) }}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Bank deposit Voucher</h4>
                    </div>
                </div> -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col_head">
                            {!! Html::decode(Form::label('bank_ids','Bank Account Name')) !!} </br>
                            {!! Form::select("bank_id", ["Please select"]+hp_banks() ,(isset($data->account_id) ? $data->account_id: null), array("class" => "form-control select2 cls_bank_id")) !!}
                        </div>
            
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col_head">
                            {!! Html::decode(Form::label('method','Transaction method')) !!} </br>
                            @foreach(($methods = hp_methods())  as $key => $method)
                                
                                @php
                                    $is_checked   = (((isset($data->method)) && ($data->method == $key )) ? "checked" : "");
                                @endphp
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="bnk-dpst-{{$key}}" value ="{{$key}}"  name="method" {{$is_checked}} class="custom-control-input">
                                    <label class="custom-control-label" for="bnk-dpst-{{$key}}">{{$method}}</label>
                                </div>
                            @endforeach
                        </div> 

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 col_head">
                            {!! Html::decode(Form::label('transaction_date','Transaction date')) !!}</br>
                            {!! Form::date('transaction_date', isset($data->transaction_date) ? hp_custom_date($data->transaction_date): hp_today(), array('id' => 'transaction_date','class' => 'form-control cls_transaction_date' )) !!}
                        </div> 

                        
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 col_head">
                            {!! Html::decode(Form::label('selected_bank_balance','Selected Bank Balance')) !!}</br>
                            <span class="cls_label cls_selected_bank_balance">0</span>
                            {!! Form::hidden('selected_bank_balance',0, array('id' => 'selected_bank_balance','class' => 'form-control','readonly' => '' )) !!}
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 col_head">
                            {!! Html::decode(Form::label('selected_account_balance','Account balance')) !!}</br>
                            <span class="cls_label cls_selected_account_balance"></span>
                            {!! Form::hidden('selected_account_balance', 0, array('id' => 'selected_account_balance','class' => 'form-control','readonly' => '' )) !!}
                        </div>
                    </div>

                
                </div>
          

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table_4" id="tbl_bnk_dpst">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%;">Account</th>
                                            <th style="width: 40%;">Detail</th>
                                            <th style="width: 30%;">Amount</th>
                                            <th style="width: 10%;">
                                            <!-- <th width="25%">Account</th>
                                            <th width="60%">Detail</th>
                                            <th width="15%">Amount</th> -->
                                            <!-- <th width="10%"><a class="text-light btn btn-primary btn-xs add_bnk_dpst btn_add" id="">+</a></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($transactions))
                                            @foreach($transactions as $key => $transaction)
                                              
                                                <tr>
                                                    <td>
                                                        {!! Form::select("account_ids[]", ["Please select"]+hp_accounts() ,$transaction->account_id, array("class" => "form-control select2 cls_bnk_dpst_account_ids")) !!}
                                                    </td>
                                                    <td>
                                                        {{ Form::text("details[]", $transaction->detail, array("placeholder" => "Enter details","class" => "form-control")) }}
                                                    </td>
                                                    <td>
                                                        {{ Form::number("amounts[]", $transaction->ledger->amount, array("placeholder" => "amounts","class" => "form-control cls_bnk_dpst_amnt","min"=>0, "step"=>"any")) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>
                                                    {!! Form::select("account_ids[]", ["Please select"]+hp_accounts() ,[], array("class" => "form-control select2 cls_bnk_dpst_account_ids")) !!}
                                                </td>
                                                <td>
                                                    {{ Form::text("details[]", null, array("placeholder" => "Enter details","class" => "form-control")) }}
                                                </td>
                                                <td>
                                                    {{ Form::number("amounts[]", null, array("placeholder" => "amounts","class" => "form-control cls_bnk_dpst_amnt","min"=>0, "step"=>"any")) }}
                                                </td>
                                                <!-- <td>
                                                    <a class="text-light btn btn-danger btn-xs del_bnk_dpst btn_del">-</a>
                                                </td> -->
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <x-buttons.find_old_transactions/>

                            <button type="submit" class="btn btn-primary btn-xs mr-2" id="btn_bnk_dpst">Save</button>
                            <button type="reset" class="btn btn-danger btn-xs">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
<!--end::Form-->
<script>
    $(document).ready(function () {  

        var account_id      = {{ $transactions[0]->account_id ?? 0 }};

        // console.log("account_id", account_id);
        var transaction_id  = {{ $data->id ?? 0 }}; 
        var submit_url      = "{{ isset($data->id) ? (route('transactions.update',$data->id) ) : route('transactions.store') }}"; // by default -- store
        var submit_type     = "{{ isset($data->id) ? 'PUT' : 'POST' }}";
        var account_bal     =  {{ $data->ledger->amount ?? 0 }};
        var trnx_type_id    = {{ ((isset($data->transaction_type_id)) && ($data->transaction_type_id == 4)) ? $data->transaction_type_id : 0 }};
        var bank_account_id =  {{ $data->account_id ?? 0 }};

        if((bank_account_id != 0) && (trnx_type_id!=0)){
            getAccountCurrentBalance(bank_account_id,'selected_bank_balance');
        }

        if((account_id != 0) && (trnx_type_id!=0)){
            getAccountCurrentBalance(account_id,'selected_account_balance');
        }

        function setInputs(entrd_amnt){
            if (isNaN(entrd_amnt)) {
                entrd_amnt = 0;
            }
            var sltd_acnt_bal = parseFloat($("#selected_account_balance").val());
            var calc_amnt =  (sltd_acnt_bal + account_bal) - entrd_amnt;
            // console.log("calc_amnt: ", calc_amnt);

            $(".cls_selected_account_balance").html(calc_amnt);
            // console.log("focus finished");
        }

        $(document).on('click', '.cls_bnk_dpst_amnt', async function() {
            // Get the current value of cls_bnk_dpst_amnt
            var currentValue = $(this).val();

            // Find the sibling element with class cls_bnk_dpst_account_ids
            var siblingAccount = $(this).closest('tr').find('.cls_bnk_dpst_account_ids');

            // Get the current balance from the sibling element
            var account_id = siblingAccount.val();

            await getAccountCurrentBalance(account_id, 'selected_account_balance');

            // console.log("account_id: ", account_id);
            var entrd_amnt = parseFloat($(this).val());
            setInputs(entrd_amnt)
        });

        // Fetch Account Balance & set inputs
        $(document).on('change', '.cls_bnk_dpst_account_ids', async function() {
            var account_id = $(this).val(); 
            // console.log("change");
            await getAccountCurrentBalance(account_id,'selected_account_balance');
        });

        // Fetch Bank Balance & set inputs
        $(document).on('change', '.cls_bank_id', async function() {
            var account_id = $(this).val(); 
            // console.log("change");
            await getAccountCurrentBalance(account_id,'selected_bank_balance');
        });

        $(document).on('change', '.cls_bnk_dpst_amnt', function() {
            var inputs      = $(".cls_bnk_dpst_amnt");
            var amount      = 0;
            var amnt        = 0;

            var entrd_amnt  = parseFloat($(this).val());
            setInputs(entrd_amnt);

            for (var i = 0; i < inputs.length; i++) {
                amnt = parseFloat($(inputs[i]).val());
                console.log("amnt: ", amnt);
                if (isNaN(amnt)) { // Check if the value is not set or NaN
                    amnt = 0; // Set cih_balance to 0 if it's not set
                }
                amount +=amnt;
            }
            
            amount = amount.toFixed(2); // Fix the decimal places after the sum
            var selected_bank_balance = parseFloat($("#selected_bank_balance").val()); // Convert the balance to a float
            
            if (isNaN(selected_bank_balance)) { // Check if the value is not set or NaN
                selected_bank_balance = 0; // Set selected_bank_balance to 0 if it's not set
            }

            var balance = (selected_bank_balance -account_bal) + parseFloat(amount); // Convert amount to a number and add it to selected_bank_balance

            $(".cls_selected_bank_balance").html(balance);

            // console.log("cih_balance: ", cih_balance);
            // console.log("Input Amount: ", amount);
            // console.log("balance: ", balance);
        });

        $('#bnk_dpst_form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: submit_url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $("#spinner-div").show();
                    $("#btn_bnk_dpst").prop("disabled", true);
                },
                success: (data) => {
                    if(data.msg){
                        // this.reset();
                        toastr.success(data.msg);
                        $("#spinner-div").hide();
                        $("#btn_bnk_dpst").text("Record saved");
                        shouldPrint(data.last_id);
                        // setTimeout(location.reload.bind(location), 2000);
                    }
                },
                error: function(data) {
                    $("#btn_bnk_dpst").prop("disabled", false);
                    handle_error(data);
                }
            });
        });


        $(document).on('click','.add_bnk_dpst', function(){
            toastr.error("Multi vouchers not allowed");

            // $('#tbl_bnk_dpst tbody tr:last').after(
            //                             '<tr>'+
            //                                 '<td>'+
            //                                     '{!! Form::select("account_ids[]", ["Please select"]+hp_accounts() ,[], array("class" => "form-control select2 cls_bnk_dpst_account_ids")) !!}' +
            //                                 '</td>'+
            //                                 '<td>'+
            //                                     '{{ Form::text("details[]", null, array("placeholder" => "Enter details","class" => "form-control")) }}' +
            //                                 '</td>'+
            //                                 '<td>'+
            //                                     '{{ Form::number("amounts[]", null, array("placeholder" => "amounts","class" => "form-control cls_bnk_dpst_amnt","min"=>0, "step"=>"any")) }}' +
            //                                 '</td>'+
            //                                 '<td>'+
            //                                     '<a class="text-light btn btn-danger btn-xs del_bnk_dpst btn_del">-</a>'+
            //                                 '</td>'+
            //                             '</tr>'
            // );
            $('.select2').select2();
        });

        $(document).on('click','.del_bnk_dpst', function(){

            var rowCount = $('#tbl_bnk_dpst tr').length;
            if(rowCount > 2){
                $(this).closest('tr').remove();
                let trnx_id  = $(".class_transaction_id").html();
                $(".class_transaction_id").html(--trnx_id);
            }else{
                toastr.error("All rows can not be deleted");
            }
        });
    });
</script>