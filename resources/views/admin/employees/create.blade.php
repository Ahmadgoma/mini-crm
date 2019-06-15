@extends('admin.dashboard')

@section('content')

    <div class="col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="color: red;"> Add New employee</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <br>
            <form class="form-horizontal " action="{{route('employees.store')}}" method="post" >
                {{csrf_field()}}

                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label" dir="rtl">First Name</label>
                    <div class="col-md-6 col-xs-12">
                        <input type="text" name="first_name" value="{{old('first_name')}}"  class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}"   placeholder="Enter employee first name"/>
                        @if ($errors->has('first_name'))
                            <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label" dir="rtl">Last Name</label>
                    <div class="col-md-6 col-xs-12">
                        <input type="text" name="last_name" value="{{old('last_name')}}"  class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}"   placeholder="Enter employee last name"/>
                        @if ($errors->has('last_name'))
                            <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label" dir="rtl">Email</label>
                    <div class="col-md-6 col-xs-12">
                        <input type="email" name="email" value="{{old('email')}}"  class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"   placeholder="Enter employee email"/>
                        @if ($errors->has('email'))
                            <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label" dir="rtl">Phone</label>
                    <div class="col-md-6 col-xs-12">
                        <input type="text" name="phone" value="{{old('phone')}}"  class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"   placeholder="Enter employee phone"/>
                        @if ($errors->has('phone'))
                            <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label" dir="rtl">company</label>
                    <div class="col-md-6 col-xs-12">
                        <select name="company_id" required class="form-control {{ $errors->has('company_id') ? ' is-invalid' : '' }}"  >
                            <option >choose company</option>
                            @forelse($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                                @empty
                            @endforelse
                        </select>
                        @if ($errors->has('company_id'))
                            <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('company_id') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group" style="text-align: center">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>

        </div>
        <!-- /.box -->


        <!-- /.box -->

    </div>

@endsection