<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 128,'maxlength' => 128]) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control','maxlength' => 3,'maxlength' => 3]) !!}
</div>

<!-- Source Feed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('source_feed', 'Source Feed:') !!}
    {!! Form::text('source_feed', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
</div>

<!-- Feed Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('feed_id', 'Feed Id:') !!}
    {!! Form::text('feed_id', null, ['class' => 'form-control','maxlength' => 128,'maxlength' => 128]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('assets.index') }}" class="btn btn-secondary">Cancel</a>
</div>
