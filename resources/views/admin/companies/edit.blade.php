@extends('admin.dashboard')

@section('content')

    <div class="col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="color: red;">Edit -- {{$company->name}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <br>
            <form class="form-horizontal " action="{{route('companies.update',$company->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden"  name="_method" value="PUT">
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label" dir="rtl">Name</label>
                    <div class="col-md-6 col-xs-12">
                        <input type="text" name="name" value="{{$company->name}}"  class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"   placeholder="Enter Company name"/>
                        @if ($errors->has('name'))
                            <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label" dir="rtl">Email</label>
                    <div class="col-md-6 col-xs-12">
                        <input type="email" name="email" value="{{$company->email}}"  class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"   placeholder="Enter Company email"/>
                        @if ($errors->has('email'))
                            <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label" dir="rtl">Website</label>
                    <div class="col-md-6 col-xs-12">
                        <input type="text" name="website" value="{{$company->website}}"  class="form-control {{ $errors->has('website') ? ' is-invalid' : '' }}"   placeholder="Enter Company website"/>
                        @if ($errors->has('website'))
                            <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label" dir="rtl">Logo</label>
                    <div class="col-md-6 col-xs-12">
                        <img src="{{asset("public/storage/$company->logo")}}" >
                        <input type="hidden" value="{{$company->logo}}" name="old_logo">
                        <input type="file" name="logo"  class="form-control {{ $errors->has('logo') ? ' is-invalid' : '' }}"   placeholder="Enter Company logo"/>
                        @if ($errors->has('logo'))
                            <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group" style="text-align: center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
        <!-- /.box -->


        <!-- /.box -->

    </div>

@endsection