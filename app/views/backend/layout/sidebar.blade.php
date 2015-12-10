<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="{{route('admin.user.index')}}">
                    <i class="fa fa-user text-red"></i>
                    <span>User</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user text-red"></i>
                    <span>Category</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.category.index')}}"><i class="fa fa-angle-double-right"></i> Lists</a></li>
                    <li><a href="{{route('admin.category.create')}}"><i class="fa fa-angle-double-right"></i> Create</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="{{route('admin.image.index')}}">
                    <i class="fa fa-user text-red"></i>
                    <span>Image</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>