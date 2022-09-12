<div class="topbar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="full">
            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
            <div class="logo_section">
                <a href="index.html"><img class="img-responsive" src="{{url('images/logo/logosalama.png')}}" alt="#" /></a>
            </div>
            <div class="right_topbar">
                <div class="icon_info">
                    <ul>
                        <li><a href="#"><i class="fa fa-bell-o" style="color:black"></i><span class="badge">2</span></a></li>
                        <li><a href="#"><i class="fa fa-question-circle" style="color:black"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope-o" style="color:black"></i><span class="badge">3</span></a></li>
                    </ul>
                    <ul class="user_profile_dd">
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="{{url('images/layout_img/user_img.jpg')}}" alt="#" /><span class="name_user">{{auth()->user()->nom}}</span></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="profile.html">My Profile</a>
                                <a class="dropdown-item" href="settings.html">Settings</a>
                                <a class="dropdown-item" href="help.html">Help</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                                <!-- <a class="dropdown-item" href="route('logout')"><span>Log Out</span> <i class="fa fa-sign-out"></i></a> -->
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
<hr>