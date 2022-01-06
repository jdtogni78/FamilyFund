<!-- Portfolio Id Field -->
<div class="form-group">
    {!! Form::label('portfolio_id', 'Portfolio Id:') !!}
    <p>{{ $portfolioAssets->portfolio_id }}</p>
</div>

<!-- Asset Id Field -->
<div class="form-group">
    {!! Form::label('asset_id', 'Asset Id:') !!}
    <p>{{ $portfolioAssets->asset_id }}</p>
</div>

<!-- Shares Field -->
<div class="form-group">
    {!! Form::label('shares', 'Shares:') !!}
    <p>{{ $portfolioAssets->shares }}</p>
</div>

<!-- Start Dt Field -->
<div class="form-group">
    {!! Form::label('start_dt', 'Start Dt:') !!}
    <p>{{ $portfolioAssets->start_dt }}</p>
</div>

<!-- End Dt Field -->
<div class="form-group">
    {!! Form::label('end_dt', 'End Dt:') !!}
    <p>{{ $portfolioAssets->end_dt }}</p>
</div>

