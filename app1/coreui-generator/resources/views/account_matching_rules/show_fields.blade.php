<!-- Account Id Field -->
<div class="form-group">
    {!! Form::label('account_id', 'Account Id:') !!}
    <p>{{ $accountMatchingRules->account_id }}</p>
</div>

<!-- Matching Id Field -->
<div class="form-group">
    {!! Form::label('matching_id', 'Matching Id:') !!}
    <p>{{ $accountMatchingRules->matching_id }}</p>
</div>

<!-- Created Field -->
<div class="form-group">
    {!! Form::label('created', 'Created:') !!}
    <p>{{ $accountMatchingRules->created }}</p>
</div>

<!-- Updated Field -->
<div class="form-group">
    {!! Form::label('updated', 'Updated:') !!}
    <p>{{ $accountMatchingRules->updated }}</p>
</div>

