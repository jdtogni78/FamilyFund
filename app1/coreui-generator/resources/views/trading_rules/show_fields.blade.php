<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $tradingRules->name }}</p>
</div>

<!-- Max Sale Increase Pcnt Field -->
<div class="form-group">
    {!! Form::label('max_sale_increase_pcnt', 'Max Sale Increase Pcnt:') !!}
    <p>{{ $tradingRules->max_sale_increase_pcnt }}</p>
</div>

<!-- Min Fund Performance Pcnt Field -->
<div class="form-group">
    {!! Form::label('min_fund_performance_pcnt', 'Min Fund Performance Pcnt:') !!}
    <p>{{ $tradingRules->min_fund_performance_pcnt }}</p>
</div>

