<!-- Fund Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fund_id', 'Fund Id:') !!}
    {!! Form::number('fund_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_total', 'Last Total:') !!}
    {!! Form::number('last_total', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Total Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_total_date', 'Last Total Date:') !!}
    {!! Form::text('last_total_date', null, ['class' => 'form-control','id'=>'last_total_date']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#last_total_date').datetimepicker({
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
    <a href="{{ route('portfolios.index') }}" class="btn btn-secondary">Cancel</a>
</div>
