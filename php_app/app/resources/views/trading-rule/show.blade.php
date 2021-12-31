@extends('layouts.app')

@section('template_title')
    {{ $tradingRule->name ?? 'Show Trading Rule' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Trading Rule</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('trading-rules.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $tradingRule->name }}
                        </div>
                        <div class="form-group">
                            <strong>Max Sale Increase Pcnt:</strong>
                            {{ $tradingRule->max_sale_increase_pcnt }}
                        </div>
                        <div class="form-group">
                            <strong>Min Fund Performance Pcnt:</strong>
                            {{ $tradingRule->min_fund_performance_pcnt }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $tradingRule->created }}
                        </div>
                        <div class="form-group">
                            <strong>Updated:</strong>
                            {{ $tradingRule->updated }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
