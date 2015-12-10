@extends('backend.layout.main')
@section('content')
<h1>Tất cả ảnh</h1>
    <div class="box box-primary">
        <div class="box-body">
        {{ Form::open(array('url' => '/admin/image','method' => 'get')) }}
            <div class="row">
                <div class="col-sm-3">
                    
                </div>
                <div class="col-sm-9">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-10">
                                {{ Form::text('keyword',null, array('placeholder' => 'Tìm kiếm theo người đăng', 'class' => 'form-control')) }}
                            </div>
                            <div class="col-sm-2">
                                {{ Form::submit('Tìm kiếm',['name']) }}
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
                    <th>Hình Ảnh</th>
                    <th width="200">Người đăng</th>
                    <th width="200">album</th>
                    <th class="text-center">Caption</th>
                    <th class="text-center" width="200">Ngày đăng</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($images) > 0)
                    <?php $i=1; ?>
                    @foreach($images as $item)
                        <tr>
                            <td class="text-center">{{ $i++ }}.</td>
                            <td>
                                <img src="{{url('public/'.'/'.$item->path)}}"width="80px" height="80px!important" class="img-thumbnail">
                            </td>
                            <td>
                                {{ $item->album->user->name }}
                            </td>
                            <td>
                                {{$item->album->title}}
                            </td>
                            <td class="text-center">
                                {{ $item->caption }}                  
                            </td>
                            <td class="text-center">{{ $item->created_at }}</td>
                            <td>
                                {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.image.destroy', $item->id))) }}         {{ Form::submit('Delete', array('class'=> 'btn btn-danger delete-btn')) }}
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
                    {{ $images->appends(array('keyword' => $keyword))->links() }}
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
