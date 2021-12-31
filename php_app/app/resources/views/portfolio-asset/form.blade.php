<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('portfolio_id') }}
            {{ Form::text('portfolio_id', $portfolioAsset->portfolio_id, ['class' => 'form-control' . ($errors->has('portfolio_id') ? ' is-invalid' : ''), 'placeholder' => 'Portfolio Id']) }}
            {!! $errors->first('portfolio_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('asset_id') }}
            {{ Form::text('asset_id', $portfolioAsset->asset_id, ['class' => 'form-control' . ($errors->has('asset_id') ? ' is-invalid' : ''), 'placeholder' => 'Asset Id']) }}
            {!! $errors->first('asset_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('shares') }}
            {{ Form::text('shares', $portfolioAsset->shares, ['class' => 'form-control' . ($errors->has('shares') ? ' is-invalid' : ''), 'placeholder' => 'Shares']) }}
            {!! $errors->first('shares', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created') }}
            {{ Form::text('created', $portfolioAsset->created, ['class' => 'form-control' . ($errors->has('created') ? ' is-invalid' : ''), 'placeholder' => 'Created']) }}
            {!! $errors->first('created', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated') }}
            {{ Form::text('updated', $portfolioAsset->updated, ['class' => 'form-control' . ($errors->has('updated') ? ' is-invalid' : ''), 'placeholder' => 'Updated']) }}
            {!! $errors->first('updated', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>