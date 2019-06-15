@extends('admin.dashboard')

@section('content')
    <div class="row">
        @if(session()->get('success'))
            <div class="alert alert-success alert-dismissible" style="text-align: center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->get('error'))
            <div class="alert alert-danger alert-dismissible" style="text-align: center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('error') }}
            </div>
        @endif
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="box">
                <a href="{{route('companies.create')}}">
                    <div class="box-header with-border">
                        <button class="btn-flat" style="text-align: center; color: green">Insert New Company --
                        </button>
                    </div>
                </a>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered" style="text-align: center">
                        <thead>
                        <th style="width: 10px">#</th>
                        <th style="text-align: center">Name</th>
                        <th style="text-align: center">Email</th>
                        <th style="text-align: center">Website</th>
                        <th style="text-align: center">Created_at</th>
                        <th style="text-align: center">Operations</th>
                        </thead>
                        <tbody>
                        @forelse($companies as $company)
                            <tr>
                                <td>{{$company->id}}</td>
                                <td>{{$company->name}}</td>
                                <td>{{$company->email}}</td>
                                <td>{{$company->website}}</td>
                                <td>{{$company->created_at}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Control
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li role="presentation" class="dropdown-header">------</li>

                                            <li><a href="{{route('companies.edit',$company->id)}}">EDIT</a></li>
                                            <li><a onclick="event.preventDefault();
                                                   document.getElementById('delete-form').submit();"> Delete</a>
                                                <form id="delete-form"
                                                      action="{{ route('companies.destroy',$company->id) }}" method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                    <input name="_method" value="delete">
                                                </form>

                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="6">Companies Data Not Founded</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    {{$companies->links()}}
                </div>

            </div>

        </div>

    </div>

@endsection