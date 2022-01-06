<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 128,'maxlength' => 128]) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control','maxlength' => 3,'maxlength' => 3]) !!}
</div>

<!-- Source Feed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('source_feed', 'Source Feed:') !!}
    {!! Form::text('source_feed', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
</div>

<!-- Feed Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('feed_id', 'Feed Id:') !!}
    {!! Form::text('feed_id', null, ['class' => 'form-control','maxlength' => 128,'maxlength' => 128]) !!}
</div>

<!-- Last Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_price', 'Last Price:') !!}
    {!! Form::number('last_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Price Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_price_date', 'Last Price Date:') !!}
    {!! Form::text('last_price_date', null, ['class' => 'form-control','id'=>'last_price_date']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#last_price_date').datetimepicker({
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


<!-- Deactivated Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deactivated', 'Deactivated:') !!}
    {!! Form::text('deactivated', null, ['class' => 'form-control','id'=>'deactivated']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#deactivated').datetimepicker({
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
    <a href="{{ route('assets.index') }}" class="btn btn-secondary">Cancel</a>
</div>
