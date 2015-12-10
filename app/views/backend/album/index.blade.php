@extends('backend.layout.main')
@section('content')
<h1>Tất cả album</h1>
    <div class="box box-primary">
        <div class="box-body">
        {{ Form::open(array('url' => '/admin/album','method' => 'get')) }}
            <div class="row">
                <div class="col-sm-3">
                    
                </div>
                <div class="col-sm-9">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-10">
                                {{ Form::text('keyword',null, array('placeholder' => 'Tìm kiếm theo Tiêu đề , tên người đăng', 'class' => 'form-control')) }}
                            </div>
                            <div class="col-sm-2">
                                {{ Form::submit('Tìm kiếm') }}
                            </div>

                            <div class="col-sm12">
                                <p class="helper-block">
                                    <label class="checkbox-inline" style="padding-left: 50px">Tìm kiếm theo: </label>
                                        <label class="checkbox-inline">
                                            {{ Form::radio('search_opt','title',true) }} Tiêu đề
                                        </label>
                                        <label class="checkbox-inline">
                                            {{ Form::radio('search_opt','fullname') }} Người đăng 
                                        </label>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{ Form::close() }}
            <table class="table table-hover table-classroom">
                <thead>
                <tr>
                    <th class="text-center row-number">#</th>
                    <th width="200">
                        @if ($sortby == 'title' && $order == 'asc')
                        {{ link_to_action('BEAlbumController@index','Tiêu đề',array('sortby' => 'title','order' => 'desc','keyword' => $keyword,'search_opt' => $option)) }}<i class="fa fa-sort-asc" style="color:#3c8dbc;"></i>
                    @else
                        {{ link_to_action('BEAlbumController@index','Tiêu đề',array('sortby' => 'title','order' => 'asc','keyword' => $keyword,'search_opt' => $option)) }}<i class="fa fa-sort-desc" style="color:#3c8dbc;"></i>
                    @endif
                    </th>
                    <th width="200">Ảnh</th>
                    <th width="200">Người đăng</th>
                    <th>Privacy</th>
                    <th class="text-center" width="200">Ngày đăng</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($albums) > 0)
                    <?php $i=1; ?>
                    @foreach($albums as $item)
                        <tr>
                            <td class="text-center">{{ $i++ }}.</td>
                            <td>
                                {{ $item->title }}
                            </td>
                            <td>
                                <img src="{{url('public/upload/'.$item->user->account.'/'.$item->album_img)}}" alt="{{$item->title}}" width="64" height="64" class="img-thumbnail">
                            </td>
                            <td>
                                {{$item->user->fullname}}
                            </td>
                            <td>
                                @if($item->privacy == 1) Công khai
                                @elseif($item->privacy == 2) Bạn bè
                                @else Riêng tư
                                @endif                                
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.album.destroy', $item->id))) }}         
                                {{ Form::submit('Delete', array('class'=> 'btn btn-danger delete-btn')) }}
                            {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">
                            Data empty
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <div class="box-tools">
                <div class="col-md-9 text-right">
                    {{ $albums->appends(array('keyword' => $keyword,'search_opt' => $option,'sortby' => $sortby,'order' => $order))->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".delete-btn").click(function(e){
                
                if(confirm("Bạn có muốn xóa không?")){

                }else{
                    e.preventDefault();
                }
            });
        });
    </script>
@stop
