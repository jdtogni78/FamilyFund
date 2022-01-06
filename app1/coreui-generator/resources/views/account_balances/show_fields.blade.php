<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $accountBalances->type }}</p>
</div>

<!-- Shares Field -->
<div class="form-group">
    {!! Form::label('shares', 'Shares:') !!}
    <p>{{ $accountBalances->shares }}</p>
</div>

<!-- Account Id Field -->
<div class="form-group">
    {!! Form::label('account_id', 'Account Id:') !!}
    <p>{{ $accountBalances->account_id }}</p>
</div>

<!-- Tran Id Field -->
<div class="form-group">
    {!! Form::label('tran_id', 'Tran Id:') !!}
    <p>{{ $accountBalances->tran_id }}</p>
</div>

<!-- Start Dt Field -->
<div class="form-group">
    {!! Form::label('start_dt', 'Start Dt:') !!}
    <p>{{ $accountBalances->start_dt }}</p>
</div>

<!-- End Dt Field -->
<div class="form-group">
    {!! Form::label('end_dt', 'End Dt:') !!}
    <p>{{ $accountBalances->end_dt }}</p>
</div>

