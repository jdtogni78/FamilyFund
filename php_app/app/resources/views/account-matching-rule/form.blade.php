<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('account_id') }}
            {{ Form::text('account_id', $accountMatchingRule->account_id, ['class' => 'form-control' . ($errors->has('account_id') ? ' is-invalid' : ''), 'placeholder' => 'Account Id']) }}
            {!! $errors->first('account_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('matching_id') }}
            {{ Form::text('matching_id', $accountMatchingRule->matching_id, ['class' => 'form-control' . ($errors->has('matching_id') ? ' is-invalid' : ''), 'placeholder' => 'Matching Id']) }}
            {!! $errors->first('matching_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created') }}
            {{ Form::text('created', $accountMatchingRule->created, ['class' => 'form-control' . ($errors->has('created') ? ' is-invalid' : ''), 'placeholder' => 'Created']) }}
            {!! $errors->first('created', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated') }}
            {{ Form::text('updated', $accountMatchingRule->updated, ['class' => 'form-control' . ($errors->has('updated') ? ' is-invalid' : ''), 'placeholder' => 'Updated']) }}
            {!! $errors->first('updated', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>