@extends('layouts.main')
@section('title','Company')
@section('content')
@include( '../sweet_script')
    <div class="page-inner">
        <div class="page-header">
           <!-- <h4 class="page-title">@yield('title')</h4> -->
        </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">@yield('title') Setup</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-2">
                            <div class="nav flex-column nav-pills nav-secondary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                                <a class="nav-link" id="v-pills-branch-tab" data-toggle="pill" href="#v-pills-branch" role="tab" aria-controls="v-pills-branch" aria-selected="false">Branches</a>
                                <a class="nav-link" id="v-pills-stores-tab" data-toggle="pill" href="#v-pills-stores" role="tab" aria-controls="v-pills-store" aria-selected="false">Stores</a>
                                <a class="nav-link" id="v-pills-details-tab" data-toggle="pill" href="#v-pills-details" role="tab" aria-controls="v-pills-details" aria-selected="false">Details</a>
                            </div>
                        </div>
                        <div class="col-7 col-md-10">
                            <div class="tab-content" id="v-pills-tabContent">
                                <!-- home  -->
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center">
                                                <h4 class="card-title">Your @yield('title')</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- begin::Form -->
                                    {!! Form::model($data, ['method' => 'PATCH','id'=>'CompaniesForm','enctype'=>'multipart/form-data','route' => ['companies.update',  $data->id]]) !!}
                                    {{  Form::hidden('created_by', Auth::user()->id ) }}
                                    <!-- operation company -->
                                    {{  Form::hidden('type', "op_company" ) }}  
                                    {{  Form::hidden('company_id', Auth::user()->company_id, array('class' => 'company_id')) }}
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                {!! Html::decode(Form::label('name','Company name <span class="text-danger">*</span>')) !!}
                                                {{ Form::text('name', null, array('placeholder' => 'Enter full company name','class' => 'form-control', 'required'=>'true', 'readonly'=>'true'  )) }}
                                                @if ($errors->has('name'))
                                                    {!! "<span class='span_danger'>". $errors->first('name')."</span>"!!}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                {!! Html::decode(Form::label('owner_name','Owner name  <span class="text-danger">*</span>')) !!}
                                                {{ Form::text('owner_name', null, array('placeholder' => 'Enter owner name','class' => 'form-control', 'required'=>'true')) }}
                                                @if ($errors->has('owner_name'))
                                                    {!! "<span class='span_danger'>". $errors->first('owner_name')."</span>"!!}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                {!! Html::decode(Form::label('code','Company code  <span class="text-danger">*</span>')) !!}
                                                {{ Form::text('code', null, array('placeholder' => 'Enter company code','class' => 'form-control', 'required'=>'true' )) }}
                                                @if ($errors->has('code'))
                                                    {!! "<span class='span_danger'>". $errors->first('code')."</span>"!!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                {!! Html::decode(Form::label('mobile_no','Mobile#')) !!}
                                                {!! Form::text('mobile_no', null, array('placeholder' => 'Enter mobile#','class' => 'form-control')) !!}
                                                @if ($errors->has('mobile_no'))
                                                    {!! "<span class='span_danger'>". $errors->first('mobile_no')."</span>"!!}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                {!! Html::decode(Form::label('phone_no','Phone No')) !!}
                                                {!! Form::number('phone_no', null, array('placeholder' => 'Enter Phone No','class' => 'form-control')) !!}
                                                @if ($errors->has('phone_no'))
                                                    {!! "<span class='span_danger'>". $errors->first('phone_no')."</span>"!!}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                {!! Html::decode(Form::label('address','Address ')) !!}
                                                {!! Form::textarea('address', null, array('placeholder' => 'Address','rows'=>1, 'class' => 'form-control')) !!}
                                                @if ($errors->has('address'))
                                                    {!! "<span class='span_danger'>". $errors->first('address')."</span>"!!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 text-right">
                                            <button type="submit" class="btn btn-primary btn-xs mr-2 upate_company">Save</button>
                                            <button type="reset" class="btn btn-danger btn-xs">Cancel</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                    <!--end::Form-->
                                </div>

                                <!-- branches -->
                                <div class="tab-pane fade" id="v-pills-branch" role="tabpanel" aria-labelledby="v-pills-branch-tab">
                                    <!--start::Branch add Form-->
                                    @can('branch-create')
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex align-items-center">
                                                    <h4 class="card-title">Manage Branches</h4>
                                                    <a  href="#" class="btn btn-primary btn-xs ml-auto" data-toggle="modal" data-target="#BranchAdd">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                            <!-- Modal -->
                                        <div class="modal fade" id="BranchAdd" tabindex="-1" role="dialog" aria-labelledby="BranchUpdateTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Add new branch</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {!! Form::open(array('route' => 'branches.store','method'=>'POST','id'=>'form_branch','class'=>'formBranch','enctype'=>'multipart/form-data')) !!}
                                                        <div class="modal-body">
                                                            <!--begin::Form-->
                                                            {{  Form::hidden('created_by', Auth::user()->id ) }}
                                                            {{  Form::hidden('action', "store" ) }}
                                                            {{  Form::hidden('company_id', Auth::user()->company_id ) }}

                                                            <div class=" row">
                                                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        {!! Html::decode(Form::label('name','Branch Name <span class="text-danger">*</span>')) !!}
                                                                        {{ Form::text('name', null, array('placeholder' => 'Enter full branch name','class' => 'form-control','autofocus' => ''  )) }}
                                                                        @if ($errors->has('name'))
                                                                            {!! "<span class='span_danger'>". $errors->first('name')."</span>"!!}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        {!! Html::decode(Form::label('mobile_no','Mobile#')) !!}
                                                                        {!! Form::text('mobile_no', null, array('placeholder' => 'Enter Mobile No','class' => 'form-control')) !!}
                                                                        @if ($errors->has('mobile_no'))
                                                                            {!! "<span class='span_danger'>". $errors->first('mobile_no')."</span>"!!}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        {!! Html::decode(Form::label('phone_no','Phone No')) !!}
                                                                        {!! Form::text('phone_no', null, array('placeholder' => 'Enter Phone no','class' => 'form-control')) !!}
                                                                        @if ($errors->has('phone_no'))
                                                                            {!! "<span class='span_danger'>". $errors->first('phone_no')."</span>"!!}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        {!! Html::decode(Form::label('address','Address')) !!}
                                                                        {!! Form::textarea('address', null, array('id'=>'address','placeholder' => 'Address','rows'=>1, 'class' => 'form-control')) !!}
                                                                        @if ($errors->has('address'))
                                                                            {!! "<span class='span_danger'>". $errors->first('address')."</span>"!!}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-xs" class="close_form_branch" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary btn-xs mr-2">Save</button>
                                                        </div>
                                                    {!! Form::close() !!}
                                                    <!--end::Form-->
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                    <!--end::Branch add Form-->

                                    <!--start::Branch Edit Form-->
                                    @can('branch-edit')
                                        <!-- Modal update -->
                                        <div class="modal fade" id="BranchUpdate" tabindex="-1" role="dialog" aria-labelledby="BranchUpdateTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Update branch</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {!! Form::open(array('route' => ['branches.update',  1], 'method'=>'PUT','id'=>'form_branch_update','enctype'=>'multipart/form-data')) !!}
                                                        <div class="modal-body">
                                                            <!--begin::Form-->
                                                            {{  Form::hidden('id', '', array('id' => 'id_ubranch')) }}
                                                            {{  Form::hidden('created_by', Auth::user()->id ) }}
                                                            {{  Form::hidden('company_id', Auth::user()->company_id, array('class' => 'company_id')) }}

                                                            <div class=" row">
                                                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        {!! Html::decode(Form::label('name','Branch Name <span class="text-danger">*</span>')) !!}
                                                                        {{ Form::text('name', null, array('placeholder' => 'Enter full branch name','class' => 'form-control','autofocus' => '', 'id' => 'name_ubranch')) }}
                                                                        @if ($errors->has('name'))
                                                                            {!! "<span class='span_danger'>". $errors->first('name')."</span>"!!}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        {!! Html::decode(Form::label('mobile_no','Mobile#')) !!}
                                                                        {!! Form::text('mobile_no', null, array('placeholder' => 'Enter Mobile No','class' => 'form-control', 'id' => 'mobile_no_ubranch')) !!}
                                                                        @if ($errors->has('mobile_no'))
                                                                            {!! "<span class='span_danger'>". $errors->first('mobile_no')."</span>"!!}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        {!! Html::decode(Form::label('phone_no','Phone No')) !!}
                                                                        {!! Form::text('phone_no', null, array('placeholder' => 'Enter Phone no','class' => 'form-control', 'id' => 'phone_no_ubranch')) !!}
                                                                        @if ($errors->has('phone_no'))
                                                                            {!! "<span class='span_danger'>". $errors->first('phone_no')."</span>"!!}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        {!! Html::decode(Form::label('address','Address ')) !!}
                                                                        {!! Form::textarea('address', null, array('placeholder' => 'Address','rows'=>1, 'class' => 'form-control', 'id' => 'address_ubranch')) !!}
                                                                        @if ($errors->has('address'))
                                                                            {!! "<span class='span_danger'>". $errors->first('address')."</span>"!!}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary btn-xs">Update changes</button>
                                                        </div>
                                                    {!! Form::close() !!}
                                                    <!--end::Form-->
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                    <!--end::Branch Edit Form-->

                                    <!--start::Branch View Form-->
                                    @can('branch-list')
                                        <!-- Modal update -->
                                        <div class="modal fade" id="BranchView" tabindex="-1" role="dialog" aria-labelledby="BranchViewTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">View branch</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {!! Form::open(array('method'=>'POST','id'=>'form_branch_view','enctype'=>'multipart/form-data')) !!}
                                                        <div class="modal-body">
                                                            <!--begin::Form-->
                                                            {{  Form::hidden('id', '', array('id' => 'id_vbranch')) }}
                                                            <div class=" row">
                                                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        {!! Html::decode(Form::label('name','Branch Name <span class="text-danger">*</span>')) !!}
                                                                        {{ Form::text('name', null, array('placeholder' => 'Enter full branch name','class' => 'form-control','autofocus' => '', 'id' => 'name_vbranch', 'readonly'=>'true')) }}
                                                                        @if ($errors->has('name'))
                                                                            {!! "<span class='span_danger'>". $errors->first('name')."</span>"!!}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        {!! Html::decode(Form::label('mobile_no','Mobile#')) !!}
                                                                        {!! Form::text('mobile_no', null, array('placeholder' => 'Enter Mobile No','class' => 'form-control', 'id' => 'mobile_no_vbranch', 'readonly'=>'true')) !!}
                                                                        @if ($errors->has('mobile_no'))
                                                                            {!! "<span class='span_danger'>". $errors->first('mobile_no')."</span>"!!}
                                                                        @endif
                                                                    </div>
                                                            </div>
                                                            </div><div class="row">
                                                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        {!! Html::decode(Form::label('phone_no','Phone No')) !!}
                                                                        {!! Form::text('phone_no', null, array('placeholder' => 'Enter Phone no','class' => 'form-control', 'id' => 'phone_no_vbranch', 'readonly'=>'true')) !!}
                                                                        @if ($errors->has('phone_no'))
                                                                            {!! "<span class='span_danger'>". $errors->first('phone_no')."</span>"!!}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        {!! Html::decode(Form::label('address','Address ')) !!}
                                                                        {!! Form::textarea('address', null, array('placeholder' => 'Address','rows'=>1, 'class' => 'form-control', 'id' => 'address_vbranch', 'readonly'=>'true')) !!}
                                                                        @if ($errors->has('address'))
                                                                            {!! "<span class='span_danger'>". $errors->first('address')."</span>"!!}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                                                        </div>
                                                    {!! Form::close() !!}
                                                    <!--end::Form-->
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                    <!--end::Branch View Form-->

                                    <table class="table table-borderless table-striped table-hover ajaxTable datatable datatable-Branch" style="width:98% !important;">
                                        <thead>
                                        <tr>
                                            <th> Branch Name</th>
                                            <th> Mobile #</th>
                                            <th> Phone #</th>
                                            <th> Address </th>
                                            <th style="width: 5%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Stores -->
                                <div class="tab-pane fade" id="v-pills-stores" role="tabpanel" aria-labelledby="v-pills-stores-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center">
                                                <h4 class="card-title">Stores </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- begin::Form -->
                                    {!! Form::model($data, ['method' => 'PATCH','id'=>'BranchesForm','enctype'=>'multipart/form-data','route' => ['stores.update',  $data->id]]) !!}
                                        {{  Form::hidden('created_by', Auth::user()->id ) }}
                                        <!-- operation company detail -->
                                        {{  Form::hidden('type', "op_company_detail" ) }}
                                        {{  Form::hidden('company_id', Auth::user()->company_id, array('class' => 'company_id')) }}
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    {!! Html::decode(Form::label('branch_id[]','Branch<span class="text-danger">*</span>')) !!}
                                                    {{ Form::select('branch_id[]', [0 => '-- Select branch --'] + $branches,null, array('class' => 'form-control', 'required'=>'true'  )) }}
                                                    @if ($errors->has('branch_id[]'))
                                                        {!! "<span class='span_danger'>". $errors->first('branch_id[]')."</span>"!!}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    {!! Html::decode(Form::label('name[]','Store <span class="text-danger">*</span>')) !!}
                                                    {{ Form::text('name[]', null, array('placeholder' => 'Enter store name', 'class' => 'form-control', 'required'=>'true'  )) }}
                                                    @if ($errors->has('name[]'))
                                                        {!! "<span class='span_danger'>". $errors->first('name[]')."</span>"!!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <button type="submit" class="btn btn-primary btn-xs mr-2 upate_company">Save</button>
                                                <button type="reset" class="btn btn-danger btn-xs">Cancel</button>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                    <!--end::Form-->
                                </div>

                                <!-- company details  - start, end date  -->
                                <div class="tab-pane fade" id="v-pills-details" role="tabpanel" aria-labelledby="v-pills-details-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center">
                                                <h4 class="card-title">Company Details </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- begin::Form -->
                                    {!! Form::model($data, ['method' => 'PATCH','id'=>'CompaniesForm','enctype'=>'multipart/form-data','route' => ['companies.update',  $data->id]]) !!}
                                        {{  Form::hidden('created_by', Auth::user()->id ) }}
                                        <!-- operation company detail -->
                                        {{  Form::hidden('type', "op_company_detail" ) }}
                                        {{  Form::hidden('company_id', Auth::user()->company_id, array('class' => 'company_id')) }}
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    {!! Html::decode(Form::label('year_start_date','Year start date <span class="text-danger">*</span>')) !!}
                                                    {{ Form::date('year_start_date', (isset($data->companyDetail->year_start_date) ? $data->companyDetail->year_start_date : null ), array('placeholder' => 'Enter year start date','class' => 'form-control', 'required'=>'true'  )) }}
                                                    @if ($errors->has('year_start_date'))
                                                        {!! "<span class='span_danger'>". $errors->first('year_start_date')."</span>"!!}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    {!! Html::decode(Form::label('year_end_date','Year start date <span class="text-danger">*</span>')) !!}
                                                    {{ Form::date('year_end_date', (isset($data->companyDetail->year_end_date) ? $data->companyDetail->year_end_date : null ), array('placeholder' => 'Enter year start date','class' => 'form-control', 'required'=>'true'  )) }}
                                                    @if ($errors->has('year_end_date'))
                                                        {!! "<span class='span_danger'>". $errors->first('year_end_date')."</span>"!!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <button type="submit" class="btn btn-primary btn-xs mr-2 upate_company">Save</button>
                                                <button type="reset" class="btn btn-danger btn-xs">Cancel</button>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                    <!--end::Form-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! JsValidator::formRequest('App\Http\Requests\BranchRequest', '#form_branch'); !!}

    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('company-delete')
                deleteButton = DeleteButtonCall("{{ route('branches.massDestroy') }}")
            dtButtons.push(deleteButton)
            @endcan
            let data = [
                // { data: 'placeholder', name: 'placeholder' },
                { data: 'name', name: 'name' },
                { data: 'mobile_no', name: 'mobile_no' },
                { data: 'phone_no', name: 'phone_no' },
                { data: 'address', name: 'address' },
                { data: 'actions', name: '{{ trans('global.actions') }}', bSortable: false }
            ]
            DataTableCall('.datatable-Branch', "{{ route('branches.index') }}", dtButtons, data)
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#form_branch').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('branches.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#spinner-div').show();
                },
                success: (data) => {
                    if(data.success){
                        this.reset();
                        toastr.success(data.success);
                        $('#spinner-div').hide();
                        $('#BranchAdd').modal('hide');
                        $('.datatable-Branch').DataTable().ajax.reload()
                    }
                },
                error: function(data) {
                    var txt         = '';
                    console.log(data.responseJSON.errors[0])
                    for (var key in data.responseJSON.errors) {
                        txt += data.responseJSON.errors[key];
                        txt +='<br>';
                    }
                    $('#spinner-div').hide();
                    toastr.error(txt);
                }
            });
        });


        $('#form_branch_update').submit(function(e) {

            let url = `{{route('branches.update', ':id')}}`

            let replace_id = $('#id_ubranch').val()

            if(url.includes(':id') && replace_id > 0); // true
            url = url.replace(':id', replace_id);

            e.preventDefault();
            var formData = new FormData(this);
            console.log(formData)
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#spinner-div').show();
                },
                success: (data) => {
                    if(data.success){
                        this.reset();
                        toastr.success(data.success);
                        $('#spinner-div').hide();
                        $('#BranchUpdate').modal('hide');
                        $('.datatable-Branch').DataTable().ajax.reload()
                    }
                },
                error: function(data) {
                    var txt         = '';
                    console.log(data.responseJSON.errors[0])
                    for (var key in data.responseJSON.errors) {
                        txt += data.responseJSON.errors[key];
                        txt +='<br>';
                    }
                    $('#spinner-div').hide();
                    toastr.error(txt);
                }
            });
        });

        const FormFillUp = function (data) {
            let response =  data.data;
            $('#id_ubranch').val(response.id)
            $('#name_ubranch').val(response.name)
            $('#mobile_no_ubranch').val(response.mobile_no)
            $('#phone_no_ubranch').val(response.phone_no)
            $('#address_ubranch').val(response.address)
        }

        function GetBranch(id){
            data = {id: id}
            AjaxCall(`{{route('branches.edit', ':id')}}`, "GET", FormFillUp, data, id);
        }

        const ViewFormFillUp = function (data) {
            let response =  data.data;
            $('#id_vbranch').val(response.id)
            $('#name_vbranch').val(response.name)
            $('#mobile_no_vbranch').val(response.mobile_no)
            $('#phone_no_vbranch').val(response.phone_no)
            $('#address_vbranch').val(response.address)
        }

        function ViewBranch(id){
            data = {id: id}
            AjaxCall(`{{route('branches.edit', ':id')}}`, "GET", ViewFormFillUp, data, id);
        }

    </script>
@endsection

