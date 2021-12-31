@extends('layouts.app')

@section('template_title')
    {{ $accountMatchingRule->name ?? 'Show Account Matching Rule' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Account Matching Rule</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('account-matching-rules.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Account Id:</strong>
                            {{ $accountMatchingRule->account_id }}
                        </div>
                        <div class="form-group">
                            <strong>Matching Id:</strong>
                            {{ $accountMatchingRule->matching_id }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $accountMatchingRule->created }}
                        </div>
                        <div class="form-group">
                            <strong>Updated:</strong>
                            {{ $accountMatchingRule->updated }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
