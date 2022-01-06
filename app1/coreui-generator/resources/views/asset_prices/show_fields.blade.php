<!-- Asset Id Field -->
<div class="form-group">
    {!! Form::label('asset_id', 'Asset Id:') !!}
    <p>{{ $assetPrices->asset_id }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $assetPrices->price }}</p>
</div>

<!-- Start Dt Field -->
<div class="form-group">
    {!! Form::label('start_dt', 'Start Dt:') !!}
    <p>{{ $assetPrices->start_dt }}</p>
</div>

<!-- End Dt Field -->
<div class="form-group">
    {!! Form::label('end_dt', 'End Dt:') !!}
    <p>{{ $assetPrices->end_dt }}</p>
</div>

