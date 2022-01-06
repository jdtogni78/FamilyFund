<!-- Source Field -->
<div class="form-group">
    {!! Form::label('source', 'Source:') !!}
    <p>{{ $transactions->source }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $transactions->type }}</p>
</div>

<!-- Shares Field -->
<div class="form-group">
    {!! Form::label('shares', 'Shares:') !!}
    <p>{{ $transactions->shares }}</p>
</div>

<!-- Account Id Field -->
<div class="form-group">
    {!! Form::label('account_id', 'Account Id:') !!}
    <p>{{ $transactions->account_id }}</p>
</div>

<!-- Matching Id Field -->
<div class="form-group">
    {!! Form::label('matching_id', 'Matching Id:') !!}
    <p>{{ $transactions->matching_id }}</p>
</div>

