<!-- Schedule Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('schedule_id', 'Schedule Id:') !!}
    {!! Form::number('schedule_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Entity Descr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entity_descr', 'Entity Descr:') !!}
    {!! Form::text('entity_descr', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Entity Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entity_id', 'Entity Id:') !!}
    {!! Form::number('entity_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Dt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_dt', 'Start Dt:') !!}
    {!! Form::text('start_dt', null, ['class' => 'form-control','id'=>'start_dt']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#start_dt').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           })
       </script>
@endpush


<!-- End Dt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_dt', 'End Dt:') !!}
    {!! Form::text('end_dt', null, ['class' => 'form-control','id'=>'end_dt']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#end_dt').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           })
       </script>
@endpush


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('scheduledJobs.index') }}" class="btn btn-secondary">Cancel</a>
</div>
