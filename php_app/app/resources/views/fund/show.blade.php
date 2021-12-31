@extends('layouts.app')

@section('template_title')
    {{ $fund->name ?? 'Show Fund' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Fund</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('funds.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $fund->name }}
                        </div>
                        <div class="form-group">
                            <strong>Goal:</strong>
                            {{ $fund->goal }}
                        </div>
                        <div class="form-group">
                            <strong>Total Shares:</strong>
                            {{ $fund->total_shares }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $fund->created }}
                        </div>
                        <div class="form-group">
                            <strong>Updated:</strong>
                            {{ $fund->updated }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
