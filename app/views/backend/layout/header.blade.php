<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('') }}" class="logo">Home</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <div class="dropdown user user-menu" style="margin-right: 30px;">
                    <a href="#"style="padding-top: 10px;padding-bottom: 7px; display: inline-block;">
                    <span style= "color:#333; line-height: 28px; margin-right: 20px">{{User::find(Session::get('current_user'))->name}}</span>
                    <img src="{{url(User::find(Session::get('current_user'))->avatar)}}" class="user-image" alt="User Image" style="    float: right;width: 35px;height: 35px;border-radius: 50%;margin-right: 10px;margin-top: -2px;" />
                    </a>
            </div>
        </div>
    </nav>
</header>