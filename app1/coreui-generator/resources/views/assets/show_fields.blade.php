<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $asset->name }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $asset->type }}</p>
</div>

<!-- Source Feed Field -->
<div class="form-group">
    {!! Form::label('source_feed', 'Source Feed:') !!}
    <p>{{ $asset->source_feed }}</p>
</div>

<!-- Feed Id Field -->
<div class="form-group">
    {!! Form::label('feed_id', 'Feed Id:') !!}
    <p>{{ $asset->feed_id }}</p>
</div>

