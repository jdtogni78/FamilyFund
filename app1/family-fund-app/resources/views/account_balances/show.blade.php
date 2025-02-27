@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('accountBalances.index') }}">Account Balance</a>
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
                                 <a href="{{ route('accountBalances.index') }}" class="btn btn-light">Back</a>
                            </div>
                            <div class="card-body">
                                @include('account_balances.show_fields')
                            </div>
                        </div>
                    </div>
                </div>
                @if($accountBalance->transaction != null)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Transactions</strong>
                                </div>
                                <div class="card-body">
                                    @include('transactions.table', ['transactions' => [$accountBalance->transaction]])
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
          </div>
    </div>
@endsection
