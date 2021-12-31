@extends('layouts.app')

@section('template_title')
    {{ $transaction->name ?? 'Show Transaction' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Transaction</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('transactions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Source:</strong>
                            {{ $transaction->source }}
                        </div>
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $transaction->type }}
                        </div>
                        <div class="form-group">
                            <strong>Shares:</strong>
                            {{ $transaction->shares }}
                        </div>
                        <div class="form-group">
                            <strong>Account Id:</strong>
                            {{ $transaction->account_id }}
                        </div>
                        <div class="form-group">
                            <strong>Matching Id:</strong>
                            {{ $transaction->matching_id }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $transaction->created }}
                        </div>
                        <div class="form-group">
                            <strong>Updated:</strong>
                            {{ $transaction->updated }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
