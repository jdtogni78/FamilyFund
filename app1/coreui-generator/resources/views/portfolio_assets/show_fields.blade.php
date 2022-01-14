<!-- Portfolio Id Field -->
<div class="form-group">
    {!! Form::label('portfolio_id', 'Portfolio Id:') !!}
    <p>{{ $portfolioAsset->portfolio_id }}</p>
</div>

<!-- Asset Id Field -->
<div class="form-group">
    {!! Form::label('asset_id', 'Asset Id:') !!}
    <p>{{ $portfolioAsset->asset_id }}</p>
</div>

<!-- Shares Field -->
<div class="form-group">
    {!! Form::label('shares', 'Shares:') !!}
    <p>{{ $portfolioAsset->shares }}</p>
</div>

<!-- Start Dt Field -->
<div class="form-group">
    {!! Form::label('start_dt', 'Start Dt:') !!}
    <p>{{ $portfolioAsset->start_dt }}</p>
</div>

<!-- End Dt Field -->
<div class="form-group">
    {!! Form::label('end_dt', 'End Dt:') !!}
    <p>{{ $portfolioAsset->end_dt }}</p>
</div>

