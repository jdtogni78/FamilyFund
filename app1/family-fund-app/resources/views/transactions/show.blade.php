@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('transactions.index') }}">Transaction</a>
        </li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Details</strong>
                            <a href="{{ route('transactions.index') }}" class="btn btn-light">Back</a>
                        </div>
                        <div class="card-body">
                            @include('transactions.show_fields')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($transaction->scheduledJobs()->count() > 0)
            @php($scheduledJobs = $transaction->scheduledJobs())
            @include('scheduled_jobs.table')
        @endif
    </div>
@endsection
