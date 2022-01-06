<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 30,'maxlength' => 30]) !!}
</div>

<!-- Max Sale Increase Pcnt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_sale_increase_pcnt', 'Max Sale Increase Pcnt:') !!}
    {!! Form::number('max_sale_increase_pcnt', null, ['class' => 'form-control']) !!}
</div>

<!-- Min Fund Performance Pcnt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('min_fund_performance_pcnt', 'Min Fund Performance Pcnt:') !!}
    {!! Form::number('min_fund_performance_pcnt', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('tradingRules.index') }}" class="btn btn-secondary">Cancel</a>
</div>
