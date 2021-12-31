<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $asset->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('type') }}
            {{ Form::text('type', $asset->type, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Type']) }}
            {!! $errors->first('type', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('source_feed') }}
            {{ Form::text('source_feed', $asset->source_feed, ['class' => 'form-control' . ($errors->has('source_feed') ? ' is-invalid' : ''), 'placeholder' => 'Source Feed']) }}
            {!! $errors->first('source_feed', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('feed_id') }}
            {{ Form::text('feed_id', $asset->feed_id, ['class' => 'form-control' . ($errors->has('feed_id') ? ' is-invalid' : ''), 'placeholder' => 'Feed Id']) }}
            {!! $errors->first('feed_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('last_price') }}
            {{ Form::text('last_price', $asset->last_price, ['class' => 'form-control' . ($errors->has('last_price') ? ' is-invalid' : ''), 'placeholder' => 'Last Price']) }}
            {!! $errors->first('last_price', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('last_price_date') }}
            {{ Form::text('last_price_date', $asset->last_price_date, ['class' => 'form-control' . ($errors->has('last_price_date') ? ' is-invalid' : ''), 'placeholder' => 'Last Price Date']) }}
            {!! $errors->first('last_price_date', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('deactivated') }}
            {{ Form::text('deactivated', $asset->deactivated, ['class' => 'form-control' . ($errors->has('deactivated') ? ' is-invalid' : ''), 'placeholder' => 'Deactivated']) }}
            {!! $errors->first('deactivated', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created') }}
            {{ Form::text('created', $asset->created, ['class' => 'form-control' . ($errors->has('created') ? ' is-invalid' : ''), 'placeholder' => 'Created']) }}
            {!! $errors->first('created', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated') }}
            {{ Form::text('updated', $asset->updated, ['class' => 'form-control' . ($errors->has('updated') ? ' is-invalid' : ''), 'placeholder' => 'Updated']) }}
            {!! $errors->first('updated', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>