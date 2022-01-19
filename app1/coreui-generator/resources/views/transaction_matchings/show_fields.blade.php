<!-- Matching Rule Id Field -->
<div class="form-group">
    {!! Form::label('matching_rule_id', 'Matching Rule Id:') !!}
    <p>{{ $transactionMatching->matching_rule_id }}</p>
</div>

<!-- Source Transaction Id Field -->
<div class="form-group">
    {!! Form::label('source_transaction_id', 'Source Transaction Id:') !!}
    <p>{{ $transactionMatching->source_transaction_id }}</p>
</div>

<!-- Target Transaction Id Field -->
<div class="form-group">
    {!! Form::label('target_transaction_id', 'Target Transaction Id:') !!}
    <p>{{ $transactionMatching->target_transaction_id }}</p>
</div>

