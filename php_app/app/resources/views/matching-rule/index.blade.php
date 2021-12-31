@extends('layouts.app')

@section('template_title')
    Matching Rule
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Matching Rule') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('matching-rules.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Dollar Range Start</th>
										<th>Dollar Range End</th>
										<th>Date Start</th>
										<th>Date End</th>
										<th>Match Percent</th>
										<th>Created</th>
										<th>Updated</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matchingRules as $matchingRule)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $matchingRule->name }}</td>
											<td>{{ $matchingRule->dollar_range_start }}</td>
											<td>{{ $matchingRule->dollar_range_end }}</td>
											<td>{{ $matchingRule->date_start }}</td>
											<td>{{ $matchingRule->date_end }}</td>
											<td>{{ $matchingRule->match_percent }}</td>
											<td>{{ $matchingRule->created }}</td>
											<td>{{ $matchingRule->updated }}</td>

                                            <td>
                                                <form action="{{ route('matching-rules.destroy',$matchingRule->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('matching-rules.show',$matchingRule->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('matching-rules.edit',$matchingRule->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $matchingRules->links() !!}
            </div>
        </div>
    </div>
@endsection
