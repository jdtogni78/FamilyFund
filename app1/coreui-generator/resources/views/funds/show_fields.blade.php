<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $funds->name }}</p>
</div>

<!-- Goal Field -->
<div class="form-group">
    {!! Form::label('goal', 'Goal:') !!}
    <p>{{ $funds->goal }}</p>
</div>

<!-- Total Shares Field -->
<div class="form-group">
    {!! Form::label('total_shares', 'Total Shares:') !!}
    <p>{{ $funds->total_shares }}</p>
</div>

