<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $matchingRule->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('dollar_range_start') }}
            {{ Form::text('dollar_range_start', $matchingRule->dollar_range_start, ['class' => 'form-control' . ($errors->has('dollar_range_start') ? ' is-invalid' : ''), 'placeholder' => 'Dollar Range Start']) }}
            {!! $errors->first('dollar_range_start', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('dollar_range_end') }}
            {{ Form::text('dollar_range_end', $matchingRule->dollar_range_end, ['class' => 'form-control' . ($errors->has('dollar_range_end') ? ' is-invalid' : ''), 'placeholder' => 'Dollar Range End']) }}
            {!! $errors->first('dollar_range_end', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('date_start') }}
            {{ Form::text('date_start', $matchingRule->date_start, ['class' => 'form-control' . ($errors->has('date_start') ? ' is-invalid' : ''), 'placeholder' => 'Date Start']) }}
            {!! $errors->first('date_start', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('date_end') }}
            {{ Form::text('date_end', $matchingRule->date_end, ['class' => 'form-control' . ($errors->has('date_end') ? ' is-invalid' : ''), 'placeholder' => 'Date End']) }}
            {!! $errors->first('date_end', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('match_percent') }}
            {{ Form::text('match_percent', $matchingRule->match_percent, ['class' => 'form-control' . ($errors->has('match_percent') ? ' is-invalid' : ''), 'placeholder' => 'Match Percent']) }}
            {!! $errors->first('match_percent', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created') }}
            {{ Form::text('created', $matchingRule->created, ['class' => 'form-control' . ($errors->has('created') ? ' is-invalid' : ''), 'placeholder' => 'Created']) }}
            {!! $errors->first('created', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated') }}
            {{ Form::text('updated', $matchingRule->updated, ['class' => 'form-control' . ($errors->has('updated') ? ' is-invalid' : ''), 'placeholder' => 'Updated']) }}
            {!! $errors->first('updated', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>