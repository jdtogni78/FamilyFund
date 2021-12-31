@extends('layouts.app')

@section('template_title')
    {{ $matchingRule->name ?? 'Show Matching Rule' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Matching Rule</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('matching-rules.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $matchingRule->name }}
                        </div>
                        <div class="form-group">
                            <strong>Dollar Range Start:</strong>
                            {{ $matchingRule->dollar_range_start }}
                        </div>
                        <div class="form-group">
                            <strong>Dollar Range End:</strong>
                            {{ $matchingRule->dollar_range_end }}
                        </div>
                        <div class="form-group">
                            <strong>Date Start:</strong>
                            {{ $matchingRule->date_start }}
                        </div>
                        <div class="form-group">
                            <strong>Date End:</strong>
                            {{ $matchingRule->date_end }}
                        </div>
                        <div class="form-group">
                            <strong>Match Percent:</strong>
                            {{ $matchingRule->match_percent }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $matchingRule->created }}
                        </div>
                        <div class="form-group">
                            <strong>Updated:</strong>
                            {{ $matchingRule->updated }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
