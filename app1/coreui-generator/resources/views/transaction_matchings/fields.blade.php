<!-- Matching Rule Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('matching_rule_id', 'Matching Rule Id:') !!}
    {!! Form::text('matching_rule_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Source Transaction Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('source_transaction_id', 'Source Transaction Id:') !!}
    {!! Form::text('source_transaction_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Target Transaction Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('target_transaction_id', 'Target Transaction Id:') !!}
    {!! Form::text('target_transaction_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('transactionMatchings.index') }}" class="btn btn-secondary">Cancel</a>
</div>
