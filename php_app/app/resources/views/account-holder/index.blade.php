@extends('layouts.app')

@section('template_title')
    Account Holder
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Account Holder') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('account-holders.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>First Name</th>
										<th>Last Name</th>
										<th>Email</th>
										<th>Type</th>
										<th>Created</th>
										<th>Updated</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accountHolders as $accountHolder)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $accountHolder->first_name }}</td>
											<td>{{ $accountHolder->last_name }}</td>
											<td>{{ $accountHolder->email }}</td>
											<td>{{ $accountHolder->type }}</td>
											<td>{{ $accountHolder->created }}</td>
											<td>{{ $accountHolder->updated }}</td>

                                            <td>
                                                <form action="{{ route('account-holders.destroy',$accountHolder->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('account-holders.show',$accountHolder->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('account-holders.edit',$accountHolder->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $accountHolders->links() !!}
            </div>
        </div>
    </div>
@endsection
