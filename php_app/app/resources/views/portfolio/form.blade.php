<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('fund_id') }}
            {{ Form::text('fund_id', $portfolio->fund_id, ['class' => 'form-control' . ($errors->has('fund_id') ? ' is-invalid' : ''), 'placeholder' => 'Fund Id']) }}
            {!! $errors->first('fund_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('last_total') }}
            {{ Form::text('last_total', $portfolio->last_total, ['class' => 'form-control' . ($errors->has('last_total') ? ' is-invalid' : ''), 'placeholder' => 'Last Total']) }}
            {!! $errors->first('last_total', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('last_total_date') }}
            {{ Form::text('last_total_date', $portfolio->last_total_date, ['class' => 'form-control' . ($errors->has('last_total_date') ? ' is-invalid' : ''), 'placeholder' => 'Last Total Date']) }}
            {!! $errors->first('last_total_date', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created') }}
            {{ Form::text('created', $portfolio->created, ['class' => 'form-control' . ($errors->has('created') ? ' is-invalid' : ''), 'placeholder' => 'Created']) }}
            {!! $errors->first('created', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated') }}
            {{ Form::text('updated', $portfolio->updated, ['class' => 'form-control' . ($errors->has('updated') ? ' is-invalid' : ''), 'placeholder' => 'Updated']) }}
            {!! $errors->first('updated', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>