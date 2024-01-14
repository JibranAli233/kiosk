@extends('layouts.main')
@section('title','Item')
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
                            <h4 class="card-title">Edit @yield('title')</h4>
                            <a  href="{{ route('items.index') }}" class="btn btn-primary btn-xs ml-auto">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>

                    <!--begin::Form-->
                        {!! Form::model($data, ['method' => 'PATCH','id'=>'form','enctype'=>'multipart/form-data','route' => ['items.update', $data->id]]) !!}
                            {{  Form::hidden('updated_by', Auth::user()->id ) }}
                            {{  Form::hidden('action', "update" ) }}

                            {{  Form::hidden('company_id', Auth::user()->company_id, array('id' => 'company_id') ) }}
                            {{  Form::hidden('branch_id', Auth::user()->branch_id, array('id' => 'branch_id') ) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('name','Item name <span class="text-danger">*</span>')) !!}
                                            {{ Form::text('name', null, array('placeholder' => 'Enter item name','class' => 'form-control','autofocus' => '','required'=>'true'  )) }}
                                            @if ($errors->has('name'))  
                                                {!! "<span class='span_danger'>". $errors->first('name')."</span>"!!} 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                {!! Html::decode(Form::label('manufacturer_id','Manufacturer / Company <span class="text-danger">*</span>')) !!}
                                                <a href="#" class="btn-sm ml-auto" data-toggle="modal" data-target="#manufacturerModal">
                                                    Add +
                                                </a>
                                            </div>
                                            {!! Form::select('manufacturer_id', $manufacturers,$data->manufacturer_id, array('class' => 'form-control')) !!}
                                            @if ($errors->has('manufacturer_id'))  
                                                {!! "<span class='span_danger'>". $errors->first('manufacturer_id')."</span>"!!} 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                {!! Html::decode(Form::label('category_id','Category <span class="text-danger">*</span>')) !!}
                                                <a href="#" class="btn-sm ml-auto" data-toggle="modal" data-target="#categoryModal">
                                                    Add +
                                                </a>
                                            </div>
                                            {!! Form::select('category_id', $categories,$data->category_id, array('class' => 'form-control')) !!}
                                            @if ($errors->has('category_id'))  
                                                {!! "<span class='span_danger'>". $errors->first('category_id')."</span>"!!} 
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('purchase_price','Purchase Price <span class="text-danger">*</span>')) !!}
                                            {!! Form::number('purchase_price', null, array('placeholder' => 'Enter purchase price','class' => 'form-control')) !!}
                                            @if ($errors->has('purchase_price'))  
                                                {!! "<span class='span_danger'>". $errors->first('purchase_price')."</span>"!!} 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('sell_price','Sell Price <span class="text-danger">*</span>')) !!}
                                            {!! Form::number('sell_price', null, array('placeholder' => 'Enter sell price','class' => 'form-control')) !!}
                                            @if ($errors->has('sell_price'))  
                                                {!! "<span class='span_danger'>". $errors->first('sell_price')."</span>"!!} 
                                            @endif
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('active','Active<span class="text-danger">*</span>')) !!}<br>
                                            <span class="switch switch-sm switch-icon switch-success">
                                            <?php $actv = (isset($data->active) && ($data->active == "Active") || ($data->active == 1)) ? 1 : 0; ?>
                                                <label>
                                                    {!! Form::checkbox('active',1,$actv,  array('class' => 'form-control', 'data-toggle'=>'toggle', 'data-onstyle'=>'success', 'data-style' => 'btn-round')) !!}
                                                    <span></span>
                                                </label>
                                            </span>
                                        
                                            @if ($errors->has('active'))  
                                                {!! "<span class='span_danger'>". $errors->first('active')."</span>"!!} 
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    
                                    <div class="col-lg-12 text-right">
                                        <button type="submit" class="btn btn-primary btn-xs mr-2">Save</button>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
    <x-modals.add_manufacturer />
    <x-modals.add_category />
    <x-modals.add_group />
    <x-modals.add_type />


    {!! JsValidator::formRequest('App\Http\Requests\ItemRequest', '#form'); !!}

    <script>
        function handle_error(data){
            $("#spinner-div").hide();
            var txt   = '';
            for (var key in data.responseJSON.errors) {
                txt += data.responseJSON.errors[key];
                txt +='<br>';
            }
            toastr.error(txt);
        }

        function store_record(url, entity_name_id, modal_id, selectbox_id ){
             // Send an AJAX request to the server to save the manufacturer
             $.ajax({
                url: url,
                method: 'POST',
                data: {
                    name:  $('#'+entity_name_id).val(),
                    company_id: $('#company_id').val(),
                    branch_id: $('#branch_id').val(),
                    is_ajax: 1
                    // Include other data as needed
                },
                beforeSend:function(){
                    $("#spinner-div").show();
                },
                success: function(response) {
                    $("#spinner-div").hide();
                    // Close the modal
                    $('#'+modal_id).modal('hide');
                    
                    // Clear the form fields
                    $('#'+entity_name_id).val('');

                    var id      = response.data.id;
                    var name    = response.data.name;
                    var option  = '<option value="' + id + '">' + name + '</option>';
                    var selectBox = $('#' + selectbox_id);
                    selectBox.append(option);
                    selectBox.val(id); // Set the value of the select box to the new option's 
                },
                error:  function(data) {
                    handle_error(data);
                }
            });
        }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection