<div class="modal fade" id="typeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Html::decode(Form::label('name','Name <span class="text-danger">*</span>')) !!}
                {{ Form::text('name', null, array('id'=>'typeNameInput','placeholder' => 'Enter name','class' => 'form-control','autofocus' => ''  )) }}
                @if ($errors->has('name'))  
                    {!! "<span class='span_danger'>". $errors->first('name')."</span>"!!} 
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-xs" id="saveTypeBtn">Save</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#saveTypeBtn').on('click', function() {
            // url, entity_name_id(what to add), modal_id, selectbox_id(where to append)
            store_record('{{ route('types.store') }}', 'typeNameInput', 'typeModal', 'type_id') 
        });
    });
</script>