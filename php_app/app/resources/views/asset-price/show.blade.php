@extends('layouts.app')

@section('template_title')
    {{ $assetPrice->name ?? 'Show Asset Price' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Asset Price</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('asset-prices.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Asset Id:</strong>
                            {{ $assetPrice->asset_id }}
                        </div>
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $assetPrice->price }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $assetPrice->created }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
