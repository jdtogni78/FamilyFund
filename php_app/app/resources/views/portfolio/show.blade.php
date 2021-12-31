@extends('layouts.app')

@section('template_title')
    {{ $portfolio->name ?? 'Show Portfolio' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Portfolio</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('portfolios.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fund Id:</strong>
                            {{ $portfolio->fund_id }}
                        </div>
                        <div class="form-group">
                            <strong>Last Total:</strong>
                            {{ $portfolio->last_total }}
                        </div>
                        <div class="form-group">
                            <strong>Last Total Date:</strong>
                            {{ $portfolio->last_total_date }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $portfolio->created }}
                        </div>
                        <div class="form-group">
                            <strong>Updated:</strong>
                            {{ $portfolio->updated }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
