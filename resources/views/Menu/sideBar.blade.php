<nav id="sidebar">
    <div class="sidebar_blog_1">
        <div class="sidebar-header">
            <div class="logo_section">
                <a href="index.html"><img class="logo_icon img-responsive" src="{{url('images/layout_img/user_img.jpg')}}" alt="#" /></a>
            </div>
        </div>
        <div class="sidebar_user_info">
            <div class="icon_setting"></div>
            <div class="user_profle_side">
                <div class="user_img"><img class="img-responsive" src="{{url('images/layout_img/user_img.jpg')}}" alt="#" /></div>
                <div class="user_info">
                    <h6 style="color:#0a417b; font-style:italic">{{auth()->user()->name}}</h6>
                    <p><span class="online_animation"></span> Online</p>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_blog_2">
        <h4>General</h4>
        <ul class="list-unstyled components">
            <li><a href="{{route('fiches')}}"><i class="fa fa-home red_color"></i> <span>Liste fiche</span></a></li>

            <!-- Administrateur -->
            @if(auth()->user() != null && auth()->user()->post_id == 1)
            <li>
                <a href="#admin" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-database blue2_color"></i> <span>Gestion Utilisateur</span></a>
                <ul class="collapse list-unstyled" id="admin">
                    <li><a href="{{route('user.Create')}}">> <span>Crée</span></a></li>
                    <li><a href="{{route('users')}}">> <span>Liste</span></a></li>
                </ul>
            </li>
            @endif
            <!-- Magasinier -->
            @if(auth()->user() != null && auth()->user()->post_id == 2)
            <li>
                <a href="#magasinier" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-file-text-o blue2_color"></i> <span>Gestion FCPCC</span></a>
                <ul class="collapse list-unstyled" id="magasinier">
                    <li><a href="{{route('fiche.create')}}">> <span>Nouvelle fiche</span></a></li>
                    <li><a href="{{route('fiche.list')}}">> <span>Liste FCPCC</span></a></li>
                </ul>
            </li>
            <li><a href="{{route('article.adresse')}}"><i class="fa fa-table purple_color"></i> <span>Liste ardresses sur rack</span></a></li>
            @endif

            <!-- Responsable approvisionnement -->
            @if(auth()->user() != null && auth()->user()->post_id == 3)
            <li><a href="{{route('Appro.chart.vue')}}"><i class="fa fa-bar-chart-o red_color"></i> <span>Dashboard</span></a></li>
            <li><a href="{{route('fiche.new')}}"><i class="fa fa-table purple_color2"></i> <span>Liste nouvelles fiches</span></a></li>
            @endif
            <!--  -->

            <!-- Pharmacien Responsable -->
            @if(auth()->user() != null && auth()->user()->post_id == 4)
            <li><a href="{{route('Pharmacien.chart.vue')}}"><i class="fa fa-bar-chart-o red_color"></i> <span>Dashboard</span></a></li>
            <li>
                <a href="#FCPCC" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-database blue2_color"></i> <span>Gestion FCPCC</span></a>
                <ul class="collapse list-unstyled" id="FCPCC">
                    <li><a href="{{route('Pharma/fiche.new')}}"><i class="fa fa-table purple_color2"></i> <span>Liste nouvelles fiches</span></a></li>
                    <li><a href="{{route('Pharma/fiche.attente')}}"><i class="fa fa-archive blue1_color"></i> <span>Liste mis en quarantaine</span></a></li>
                    <li><a href="{{route('Pharma/fiche.rebut')}}"><i class="fa fa-trash red_color"></i> <span>Liste des Rebuts</span></a></li>
                </ul>
            </li>
            @endif
            <!--  -->

            <!-- Responsable Stock -->
            @if(auth()->user() != null && auth()->user()->post_id == 5)
            <li><a href="{{route('calendar')}}"><i class="fa fa-calendar red_color"></i> <span>Calendrier de reception</span></a></li>
            <li>
                <a href="#FCPCC" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-database blue2_color"></i> <span>Gestion FCPCC</span></a>
                <ul class="collapse list-unstyled" id="FCPCC">
                    <li><a href="{{route('Stock/fiche.new')}}"><i class="fa fa-table purple_color2"></i> <span>Liste fiches validées</span></a></li>
                    <li><a href="{{route('Stock/fiche.attente')}}"><i class="fa fa-table red_color"></i> <span>Liste fiches non validées</span></a></li>
                </ul>
            </li>
            @endif
            <!--  -->

            <!-- Chef de Rayon -->
            @if(auth()->user() != null && auth()->user()->post_id == 6)
            <li><a href="{{route('ChefRayon.chart.vue')}}"><i class="fa fa-bar-chart-o red_color"></i> <span>Dashboard</span></a></li>
            <li>
                <a href="#FCPCC" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-cubes blue2_color"></i> <span>Gestion stock</span></a>
                <ul class="collapse list-unstyled" id="FCPCC">
                    <li><a href="{{route('ChefRayon/fiche.new')}}"><i class="fa fa-table purple_color2"></i> <span>Lot non mise en place</span></a></li>
                    <li><a href="{{route('ChefRayon/fiche.stock')}}"><i class="fa fa-file blue2_color"></i> <span>Fiche de Stock</span></a></li>
                </ul>
            </li>
            @endif
            <!--  -->
        </ul>
    </div>
</nav>