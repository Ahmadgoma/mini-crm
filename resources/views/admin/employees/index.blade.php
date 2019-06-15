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
                <a href="{{route('employees.create')}}">
                    <div class="box-header with-border">
                        <button class="btn-flat" style="text-align: center; color: green">Insert New Employee --
                        </button>
                    </div>
                </a>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered" style="text-align: center">
                        <thead>
                        <th style="width: 10px">#</th>
                        <th style="text-align: center">First name</th>
                        <th style="text-align: center">Last name</th>
                        <th style="text-align: center">Email</th>
                        <th style="text-align: center">Phone</th>
                        <th style="text-align: center">Created_at</th>
                        <th style="text-align: center">Operations</th>
                        </thead>
                        <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>{{$employee->id}}</td>
                                <td>{{$employee->first_name}}</td>
                                <td>{{$employee->last_name}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->phone}}</td>
                                <td>{{$employee->created_at}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Control
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li role="presentation" class="dropdown-header">------</li>

                                            <li><a href="{{route('employees.edit',$employee->id)}}">EDIT</a></li>
                                            <li><a onclick="event.preventDefault();
                                                   document.getElementById('delete-form').submit();"> Delete</a>
                                                <form id="delete-form"
                                                      action="{{ route('employees.destroy',$employee->id) }}" method="employee"
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
                                <td colspan="6">Employees Data Not Founded</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    {{$employees->links()}}
                </div>

            </div>

        </div>

    </div>

@endsection