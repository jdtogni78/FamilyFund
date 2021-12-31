@extends('layouts.app')

@section('template_title')
    Trading Rule
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Trading Rule') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('trading-rules.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Name</th>
										<th>Max Sale Increase Pcnt</th>
										<th>Min Fund Performance Pcnt</th>
										<th>Created</th>
										<th>Updated</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tradingRules as $tradingRule)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $tradingRule->name }}</td>
											<td>{{ $tradingRule->max_sale_increase_pcnt }}</td>
											<td>{{ $tradingRule->min_fund_performance_pcnt }}</td>
											<td>{{ $tradingRule->created }}</td>
											<td>{{ $tradingRule->updated }}</td>

                                            <td>
                                                <form action="{{ route('trading-rules.destroy',$tradingRule->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('trading-rules.show',$tradingRule->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('trading-rules.edit',$tradingRule->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $tradingRules->links() !!}
            </div>
        </div>
    </div>
@endsection
