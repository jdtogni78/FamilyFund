@extends('layouts.app')

@section('template_title')
    Account Trading Rule
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Account Trading Rule') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('account-trading-rules.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Account Id</th>
										<th>Trading Rule Id</th>
										<th>Created</th>
										<th>Updated</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accountTradingRules as $accountTradingRule)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $accountTradingRule->account_id }}</td>
											<td>{{ $accountTradingRule->trading_rule_id }}</td>
											<td>{{ $accountTradingRule->created }}</td>
											<td>{{ $accountTradingRule->updated }}</td>

                                            <td>
                                                <form action="{{ route('account-trading-rules.destroy',$accountTradingRule->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('account-trading-rules.show',$accountTradingRule->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('account-trading-rules.edit',$accountTradingRule->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $accountTradingRules->links() !!}
            </div>
        </div>
    </div>
@endsection
