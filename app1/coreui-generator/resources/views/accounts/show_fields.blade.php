<!-- Code Field -->
<div class="form-group">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $accounts->code }}</p>
</div>

<!-- Nickname Field -->
<div class="form-group">
    {!! Form::label('nickname', 'Nickname:') !!}
    <p>{{ $accounts->nickname }}</p>
</div>

<!-- Email Cc Field -->
<div class="form-group">
    {!! Form::label('email_cc', 'Email Cc:') !!}
    <p>{{ $accounts->email_cc }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $accounts->user_id }}</p>
</div>

