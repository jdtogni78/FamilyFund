@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('cashDeposits.index') !!}">Cash Deposit</a>
          </li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Edit Cash Deposit</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($cashDeposit, ['route' => ['cashDeposits.update', $cashDeposit->id], 'method' => 'patch']) !!}
                              @include('cash_deposits.fields', ['isEdit' => true])
                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
@endsection