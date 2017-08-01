@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <img src='{{ $user->avatar }}'
                     style="width: 150px;height: 150px;float:left;border-radius: 50%;margin-right: 25px">
                <h2>{{ $user->name }} 的设置</h2>
                <form enctype="multipart/form-data" action="{{url('/profile')}}" method="post">
                    {{ csrf_field() }}
                    <label>上传图片</label>
                    <input type="file" name="avatar">
                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
