<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control','maxlength' => 15]) !!}
</div>

<!-- Nickname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nickname', 'Nickname:') !!}
    {!! Form::text('nickname', null, ['class' => 'form-control','maxlength' => 15]) !!}
</div>

<!-- Email Cc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_cc', 'Email Cc:') !!}
    {!! Form::text('email_cc', null, ['class' => 'form-control','maxlength' => 1024]) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', $api['userMap'], null, ['class' => 'form-control']) !!}
</div>

<!-- Fund Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fund_id', 'Fund Id:') !!}
    {!! Form::select('fund_id', $api['fundMap'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Cancel</a>
</div>
