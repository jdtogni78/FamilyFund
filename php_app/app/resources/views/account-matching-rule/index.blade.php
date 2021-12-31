@extends('layouts.app')

@section('template_title')
    Account Matching Rule
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Account Matching Rule') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('account-matching-rules.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Matching Id</th>
										<th>Created</th>
										<th>Updated</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accountMatchingRules as $accountMatchingRule)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $accountMatchingRule->account_id }}</td>
											<td>{{ $accountMatchingRule->matching_id }}</td>
											<td>{{ $accountMatchingRule->created }}</td>
											<td>{{ $accountMatchingRule->updated }}</td>

                                            <td>
                                                <form action="{{ route('account-matching-rules.destroy',$accountMatchingRule->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('account-matching-rules.show',$accountMatchingRule->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('account-matching-rules.edit',$accountMatchingRule->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $accountMatchingRules->links() !!}
            </div>
        </div>
    </div>
@endsection
