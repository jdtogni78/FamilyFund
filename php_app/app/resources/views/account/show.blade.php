@extends('layouts.app')

@section('template_title')
    {{ $account->name ?? 'Show Account' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Account</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('accounts.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Code:</strong>
                            {{ $account->code }}
                        </div>
                        <div class="form-group">
                            <strong>Nickname:</strong>
                            {{ $account->nickname }}
                        </div>
                        <div class="form-group">
                            <strong>Email Cc:</strong>
                            {{ $account->email_cc }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $account->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Fund Id:</strong>
                            {{ $account->fund_id }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $account->created }}
                        </div>
                        <div class="form-group">
                            <strong>Updated:</strong>
                            {{ $account->updated }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
