@extends('layouts.app')

@section('template_title')
    {{ $accountHolder->name ?? 'Show Account Holder' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Account Holder</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('account-holders.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>First Name:</strong>
                            {{ $accountHolder->first_name }}
                        </div>
                        <div class="form-group">
                            <strong>Last Name:</strong>
                            {{ $accountHolder->last_name }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $accountHolder->email }}
                        </div>
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $accountHolder->type }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $accountHolder->created }}
                        </div>
                        <div class="form-group">
                            <strong>Updated:</strong>
                            {{ $accountHolder->updated }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
