@extends('backend.layout.main')
@section('content')
<h1>Tất cả người dùng</h1>
    <div class="box box-primary">
        <div class="box-body">
            {{ Form::open(array('url' => '/admin/user','method' => 'get')) }}
            <div class="row">
                <div class="col-sm-3">
                    
                </div>
                <div class="col-sm-9">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-10">
                                {{ Form::text('keyword',null, array('placeholder' => 'Tìm kiếm theo Email , tên đầy đủ hoặc tất cả', 'class' => 'form-control')) }}
                            </div>
                            <div class="col-sm-2">
                                {{ Form::submit('Tìm kiếm') }}
                            </div>

                            <div class="col-sm12">
                                <p class="helper-block">
                                    <label class="checkbox-inline" style="padding-left: 50px">Tìm kiếm theo: </label>
                                        <label class="checkbox-inline">
                                            {{ Form::radio('search_opt','email',true) }} Email
                                        </label>
                                        <label class="checkbox-inline">
                                            {{ Form::radio('search_opt','name') }} Tên đầy đủ
                                        </label>
                                        <label class="checkbox-inline">
                                            {{ Form::radio('search_opt','account') }} Tên tài khoản
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
                    <th class="email">
                    @if ($sortby == 'email' && $order == 'asc')
                        {{ link_to_action('BEUsersController@index','Email',array('sortby' => 'email','order' => 'desc','keyword' => $keyword,'search_opt' => $option)) }}<i class="fa fa-sort-asc" style="color:#3c8dbc;"></i>
                    @else
                        {{ link_to_action('BEUsersController@index','Email',array('sortby' => 'email','order' => 'asc','keyword' => $keyword,'search_opt' => $option)) }}<i class="fa fa-sort-desc" style="color:#3c8dbc;"></i>
                    @endif
                    </th>
                    <th width="200" class="account">
                    @if ($sortby == 'account' && $order == 'asc')
                        {{ link_to_action('BEUsersController@index','Account',array('sortby' => 'account','order' => 'desc','keyword' => $keyword,'search_opt' => $option)) }}<i class="fa fa-sort-asc up" style="color:#3c8dbc;"></i>
                    @else
                        {{ link_to_action('BEUsersController@index','Account',array('sortby' => 'account','order' => 'asc','keyword' => $keyword,'search_opt' => $option)) }}<i class="fa fa-sort-desc down" style="color:#3c8dbc;"></i>
                    @endif
                    </th>
                    <th width="200">Name</th>
                    <th width="200">Avatar</th>
                    <th width="100">Phone</th>
                    <th width="300">Admin</th>
                    <th width="500">Address</th>
                    <th class="text-center" width="200">Ngày đăng ký</th>
                    <th class="action" width="150">Action</th>

                </tr>
                </thead>
                <tbody>
                @if(count($users) > 0)
                    <?php $i=1; ?>
                    @foreach($users as $item)
                        <tr>
                            <td class="text-center">{{ $i++ }}.</td>
                            <td>
                                {{ $item->email }}
                            </td>
                            <td>
                                {{ $item->account }}
                            </td>
                            <td>
                                {{$item->name}}
                            </td>
                            <td>
                                 <img src="{{url($item->avatar)}}" width="64" height="64" class="img-thumbnail" /> 
                            </td>
                            <td>
                                {{ $item->phone}}
                            </td>
                            <td>
                                 @if($item->is_admin == 1) Có
                                 @else Không là Admin
                                 @endif
                            </td>
                            <td>
                                {{ $item->address }}
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                            {{ link_to_route('admin.user.edit', 'Edit',array($item->id), array('class' => 'btn btn-info')) }}
                            </td>
                            <td>
                            {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.user.destroy', $item->id))) }}         {{ Form::submit('Delete', array('class'=> 'btn btn-danger delete-btn')) }}
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
                    {{ $users->appends(array('keyword' => $keyword,'search_opt' => $option,'sortby' => $sortby,'order' => $order))->links() }}
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
               if($('.account > i').hasClass('down')){
                $('.account > i').css('display', 'none');
               }
               else if($('.account > i').hasClass('up')){
                $('.account > i').css('display', 'inline-block');
               }
        });
    </script>
@stop
