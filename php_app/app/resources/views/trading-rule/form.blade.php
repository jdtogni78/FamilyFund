<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $tradingRule->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('max_sale_increase_pcnt') }}
            {{ Form::text('max_sale_increase_pcnt', $tradingRule->max_sale_increase_pcnt, ['class' => 'form-control' . ($errors->has('max_sale_increase_pcnt') ? ' is-invalid' : ''), 'placeholder' => 'Max Sale Increase Pcnt']) }}
            {!! $errors->first('max_sale_increase_pcnt', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('min_fund_performance_pcnt') }}
            {{ Form::text('min_fund_performance_pcnt', $tradingRule->min_fund_performance_pcnt, ['class' => 'form-control' . ($errors->has('min_fund_performance_pcnt') ? ' is-invalid' : ''), 'placeholder' => 'Min Fund Performance Pcnt']) }}
            {!! $errors->first('min_fund_performance_pcnt', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created') }}
            {{ Form::text('created', $tradingRule->created, ['class' => 'form-control' . ($errors->has('created') ? ' is-invalid' : ''), 'placeholder' => 'Created']) }}
            {!! $errors->first('created', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated') }}
            {{ Form::text('updated', $tradingRule->updated, ['class' => 'form-control' . ($errors->has('updated') ? ' is-invalid' : ''), 'placeholder' => 'Updated']) }}
            {!! $errors->first('updated', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>