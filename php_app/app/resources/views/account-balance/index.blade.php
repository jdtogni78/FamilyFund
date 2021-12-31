@extends('layouts.app')

@section('template_title')
    Account Balance
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Account Balance') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('account-balances.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Type</th>
										<th>Shares</th>
										<th>Account Id</th>
										<th>Tran Id</th>
										<th>Created</th>
										<th>Updated</th>
										<th>Active</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accountBalances as $accountBalance)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $accountBalance->type }}</td>
											<td>{{ $accountBalance->shares }}</td>
											<td>{{ $accountBalance->account_id }}</td>
											<td>{{ $accountBalance->tran_id }}</td>
											<td>{{ $accountBalance->created }}</td>
											<td>{{ $accountBalance->updated }}</td>
											<td>{{ $accountBalance->active }}</td>

                                            <td>
                                                <form action="{{ route('account-balances.destroy',$accountBalance->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('account-balances.show',$accountBalance->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('account-balances.edit',$accountBalance->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $accountBalances->links() !!}
            </div>
        </div>
    </div>
@endsection
