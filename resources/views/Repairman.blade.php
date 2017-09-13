@extends('layouts.app');

@section('content')

    <div class="panel panel-default" style="width: 80%; margin: 0 auto">
        <!-- Default panel contents -->
        <div class="panel-heading">维修申请列表</div>
        <!-- Table -->
        <table class="table">
            <tr>
                <th>id</th>
                <th>时间</th>
                <th>地点</th>
                <th>问题</th>
                <th>stasus</th>
                <th>option</th>
            </tr>
            @php($i = 0)
            @foreach($repairData as $data)
                @php($i++)
                @php($detail = 'detail'.$i)
                @php($detail_ = '#detail'.$i)
                <tr>
                    <td>{{$data->re_id}}</td>
                    <td>{{$data->re_date}}</td>
                    <td>{{$data->re_xq}}</td>
                    <td>{{$data->re_remarks}}</td>
                    <td> {{$data->re_state}}</td>
                    <td><a href=" {{  url( '/repairman/update',['id'=>$data->re_id])}}">
                            <button type="button" class="btn btn-success">已处理</button>
                        </a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-lg" style="font-size: 12px;"
                                data-toggle="modal" data-target={{$detail_}}>
                            详情
                        </button>

                        <div class="modal fade" id={{$detail}}>
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">报修单详情</h4>
                                    </div>
                                    <div class="panel panel-success">
                                        <div class="list-group-item active">
                                            <h4 class="list-group-item-heading">报修人信息</h4>
                                            <p class="list-group-item-text">
                                                name-tel: {{$data->re_name.'-'.$data->re_phone}}</p>
                                        </div>
                                    </div>
                                    <div class="panel panel-success">
                                        <div class="list-group-item active">
                                            <h4 class="list-group-item-heading">地点</h4>
                                            <p class="list-group-item-text">
                                                xq-lfh-mp:{{$data->re_xq.'-'.$data->re_lfh.'-'.$data->re_mph}}</p></div>
                                    </div>
                                    <div class="panel panel-info">
                                        <div class="list-group-item active">
                                            <h4 class="list-group-item-heading">故障说明</h4>
                                            <p class="list-group-item-text">
                                                kind+detail:{{$data->re_kind.'-'.$data->re_remarks}}</p></div>
                                    </div>
                                    <div class="panel panel-info">
                                        <div class="list-group-item active">
                                            <h4 class="list-group-item-heading">photo</h4>
                                            <p class="list-group-item-text">p</p></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">GET</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{url('/repairman/delete',['id'=>$data->re_id])}}">
                            <button type="button" class="btn btn-danger">清除</button>
                        </a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <div style="text-align: center; margin: 0 auto">
        {{ $repairData->render() }}
    </div>
@endsection