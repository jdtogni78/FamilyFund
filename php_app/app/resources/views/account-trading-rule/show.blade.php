@extends('layouts.app')

@section('template_title')
    {{ $accountTradingRule->name ?? 'Show Account Trading Rule' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Account Trading Rule</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('account-trading-rules.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Account Id:</strong>
                            {{ $accountTradingRule->account_id }}
                        </div>
                        <div class="form-group">
                            <strong>Trading Rule Id:</strong>
                            {{ $accountTradingRule->trading_rule_id }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $accountTradingRule->created }}
                        </div>
                        <div class="form-group">
                            <strong>Updated:</strong>
                            {{ $accountTradingRule->updated }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
