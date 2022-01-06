<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $assets->name }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $assets->type }}</p>
</div>

<!-- Source Feed Field -->
<div class="form-group">
    {!! Form::label('source_feed', 'Source Feed:') !!}
    <p>{{ $assets->source_feed }}</p>
</div>

<!-- Feed Id Field -->
<div class="form-group">
    {!! Form::label('feed_id', 'Feed Id:') !!}
    <p>{{ $assets->feed_id }}</p>
</div>

<!-- Last Price Field -->
<div class="form-group">
    {!! Form::label('last_price', 'Last Price:') !!}
    <p>{{ $assets->last_price }}</p>
</div>

<!-- Last Price Date Field -->
<div class="form-group">
    {!! Form::label('last_price_date', 'Last Price Date:') !!}
    <p>{{ $assets->last_price_date }}</p>
</div>

<!-- Deactivated Field -->
<div class="form-group">
    {!! Form::label('deactivated', 'Deactivated:') !!}
    <p>{{ $assets->deactivated }}</p>
</div>

