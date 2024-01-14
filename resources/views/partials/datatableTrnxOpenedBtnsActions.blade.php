
<div class="btn-group">
    @can($viewGate)

        <a class="btn btn-info btn-xs" href="javascript:void(0);"  onclick="printReceipt({{$row->id}});" >
            <i class="fa fa-print"></i> 
        </a>
        <!-- <a class="btn btn-info btn-xs" href="{{ route($crudRoutePart . '.show', $row->id) }}" >
            <i class="fa fa-eye"></i> 
        </a> -->
    @endcan

    @can($editGate)
        @if(isset($row->transaction_type_id) && (($row->transaction_type_id) !=1 ) )
            <a class="btn btn-info btn-xs" href="{{ route( $crudRoutePart . '.edit', $row->id) }}">
                <i class="fa fa-edit"></i> 
            </a>
        @endif
    @endcan

    @can($deleteGate)
        <form  action="{{ route( $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i> </button>
        </form>
    @endcan
</div>
