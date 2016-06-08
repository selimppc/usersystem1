<div id="navigation">
    <div class="profile-picture">

        <div class="stats-label text-color">
            <span class="font-extra-bold font-uppercase">{{isset(Auth::user()->username)?ucfirst(Auth::user()->username):''}}</span>

            <div class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><b class="caret"></b>
                    {{--<small class="text-muted">Founder of App <b class="caret"></b></small>--}}
                </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <li><a href="{{Route('user-profile')}}">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="{{Route('user-logout')}}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <ul class="nav" id="side-menu">
        <li class="active">
            <a href="{{URL::to('dashboard')}}"> <i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span> </a>
        </li>
        {{--<li class="active">
            <a href="{{URL::to('bord')}}"> <i class="fa fa-calculator"></i> <span class="nav-label">Calculator</span> </a>
        </li>
        <li class="active">
            <a href="{{URL::to('department')}}"> <i class="fa fa-align-center"></i> <span class="nav-label">Department</span> </a>
        </li>
        @if(file_exists(app_path().'/modules/user/Views/layouts/user_sidebar.blade.php'))
            @include('user::layouts.user_sidebar')
        @endif--}}

        @if(\Illuminate\Support\Facades\Session::has('sidebar_menu_user'))
            <?php $side_bar_menu = \Illuminate\Support\Facades\Session::get('sidebar_menu_user');
            //print_r($side_bar_menu);

            ?>
            @if($side_bar_menu)
                @foreach($side_bar_menu as $module)
                    @foreach($module['sub-menu'] as $sub_module)

                        @if(count($sub_module['sub-menu'])>0)
                            <li>
                                <a tabindex="-1" href="{{URL::to($sub_module['route'])}}">
                                    <i class="{{@$sub_module['icon_code']}}"> </i>
                                    <span class="mm-text">{{$sub_module['menu_name']}}</span>
                                </a>
                                <ul class="nav nav-second-level collapse">
                                    @foreach($sub_module['sub-menu'] as $sub_sub_module)
                                        <li>
                                            <a tabindex="-1" href="{{URL::to($sub_sub_module['route'])}}">
                                                <i class="{{@$sub_sub_module['icon_code']}}"> </i>
                                                <span class="mm-text">{{$sub_sub_module['menu_name']}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif

                    @endforeach
                @endforeach
            @endif
        @endif

    </ul>
</div>