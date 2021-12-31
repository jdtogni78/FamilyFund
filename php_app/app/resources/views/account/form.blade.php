<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('code') }}
            {{ Form::text('code', $account->code, ['class' => 'form-control' . ($errors->has('code') ? ' is-invalid' : ''), 'placeholder' => 'Code']) }}
            {!! $errors->first('code', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nickname') }}
            {{ Form::text('nickname', $account->nickname, ['class' => 'form-control' . ($errors->has('nickname') ? ' is-invalid' : ''), 'placeholder' => 'Nickname']) }}
            {!! $errors->first('nickname', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email_cc') }}
            {{ Form::text('email_cc', $account->email_cc, ['class' => 'form-control' . ($errors->has('email_cc') ? ' is-invalid' : ''), 'placeholder' => 'Email Cc']) }}
            {!! $errors->first('email_cc', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $account->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fund_id') }}
            {{ Form::text('fund_id', $account->fund_id, ['class' => 'form-control' . ($errors->has('fund_id') ? ' is-invalid' : ''), 'placeholder' => 'Fund Id']) }}
            {!! $errors->first('fund_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created') }}
            {{ Form::text('created', $account->created, ['class' => 'form-control' . ($errors->has('created') ? ' is-invalid' : ''), 'placeholder' => 'Created']) }}
            {!! $errors->first('created', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated') }}
            {{ Form::text('updated', $account->updated, ['class' => 'form-control' . ($errors->has('updated') ? ' is-invalid' : ''), 'placeholder' => 'Updated']) }}
            {!! $errors->first('updated', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>