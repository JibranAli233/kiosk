@extends('layouts.main')
@section('title','Types')
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
                            @can('type-create')
                                <a  href="{{ route('types.create') }}" class="btn btn-primary btn-xs ml-auto">
                                <i class="fa fa-plus"></i> New</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover" style="width: 100%;" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Parent type</th>
                                        <th width="8%">Active</th>
                                        <th width="5%">Action</th>
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
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('type-delete')
                deleteButton = DeleteButtonCall("{{ route('types.massDestroy') }}")
            dtButtons.push(deleteButton)
            @endcan
            let data = [
                { data: 'name', name: 'name' },
                { data: 'parent_id', name: 'parent_id' },
                { data: 'active', name: 'active' },
                { data: 'actions', name: '{{ trans('global.actions') }}',orderable:false,searchable:false }
            ]
            DataTableCall('#myTable', "{{ route('types.index') }}", dtButtons, data)
        });
    </script>
@endsection
