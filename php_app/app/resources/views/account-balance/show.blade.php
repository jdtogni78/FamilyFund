@extends('layouts.app')

@section('template_title')
    {{ $accountBalance->name ?? 'Show Account Balance' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Account Balance</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('account-balances.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $accountBalance->type }}
                        </div>
                        <div class="form-group">
                            <strong>Shares:</strong>
                            {{ $accountBalance->shares }}
                        </div>
                        <div class="form-group">
                            <strong>Account Id:</strong>
                            {{ $accountBalance->account_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tran Id:</strong>
                            {{ $accountBalance->tran_id }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $accountBalance->created }}
                        </div>
                        <div class="form-group">
                            <strong>Updated:</strong>
                            {{ $accountBalance->updated }}
                        </div>
                        <div class="form-group">
                            <strong>Active:</strong>
                            {{ $accountBalance->active }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
