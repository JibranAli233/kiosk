    <button type="button" class="btn btn-primary btn-xs " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu">
        <div class="arrow"></div>
        @can($viewGate)
            @if(($action ?? '') == 'branch_update')
                <a  title="" class="dropdown-item" data-original-title="View" href="javascript:void(0);"  onclick="ViewBranch({{$row->id}});" data-toggle="modal" data-target="#BranchView">
                    <i class="fa fa-eye"></i> View
                </a>
            @else
            <a data-toggle="tooltip" title="" class="dropdown-item" data-original-title="View"  href="{{ route($crudRoutePart . '.show', $row->id) }}" >
                <i class="fa fa-eye"></i> View
            </a>
            @endif
        @endcan

        @can($editGate)
            @if(($action ?? '') == 'branch_update')
                <a  title="" class="dropdown-item" data-original-title="Edit Task" href="javascript:void(0);"  onclick="GetBranch({{$row->id}});"  data-toggle="modal" data-target="#BranchUpdate">
                    <i class="fa fa-edit"></i> Edit
                </a>
            @else
                <a data-toggle="tooltip" title="" class="dropdown-item" data-original-title="Edit" href="{{ route( $crudRoutePart . '.edit', $row->id) }}"  onclick="">
                    <i class="fa fa-edit"></i> Edit
                </a>
            @endif
        @endcan

        @can($deleteGate)
            <button
                data-toggle="tooltip" 
                title="" 
                class="dropdown-item delete_all" 
                data-original-title="Delete Task"

                {{-- class="btn btn-danger btn-xs delete_all" --}}
                data-url="{{url('del_account')}}" data-id="{{$row->id}}">
                    <i class="fas fa-trash-alt"></i> Delete
            </button>
        @endcan
    </div>
