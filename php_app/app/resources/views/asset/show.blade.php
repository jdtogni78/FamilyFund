@extends('layouts.app')

@section('template_title')
    {{ $asset->name ?? 'Show Asset' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Asset</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('assets.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $asset->name }}
                        </div>
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $asset->type }}
                        </div>
                        <div class="form-group">
                            <strong>Source Feed:</strong>
                            {{ $asset->source_feed }}
                        </div>
                        <div class="form-group">
                            <strong>Feed Id:</strong>
                            {{ $asset->feed_id }}
                        </div>
                        <div class="form-group">
                            <strong>Last Price:</strong>
                            {{ $asset->last_price }}
                        </div>
                        <div class="form-group">
                            <strong>Last Price Date:</strong>
                            {{ $asset->last_price_date }}
                        </div>
                        <div class="form-group">
                            <strong>Deactivated:</strong>
                            {{ $asset->deactivated }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $asset->created }}
                        </div>
                        <div class="form-group">
                            <strong>Updated:</strong>
                            {{ $asset->updated }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
