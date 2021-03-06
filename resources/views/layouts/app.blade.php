<!DOCTYPE html>
<html lang="fr" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CSADN | Espace adhérents</title>
    <link href="{{ asset('images/fav_csadn.ico') }}" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="{{ asset('css/themes/lite-blue.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins/perfect-scrollbar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins/datatables.min.css') }}" rel="stylesheet" />
</head>

<body class="text-left">

    <div class="app-admin-wrap layout-sidebar-large">

        <div class="main-header">
            <div>
                @auth
                <a href="{{ route('home')}}">
                @else
                <a href="{{ route('index')}}">
                @endauth


                    <img src="{{ asset('images/logo.png') }}" alt="" height="60px;">
                </a>
            </div>
            @auth
            <div class="menu-toggle">
                <div></div>
                <div></div>
                <div></div>
            </div>
            @endauth
            <div style="margin: auto"></div>
            @auth
            <div class="header-part-right">
                <!-- Full screen toggle -->
                <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
                <!-- Grid menu Dropdown -->
                <div class="dropdown">
                    <i class="i-Safe-Box text-muted header-icon" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="menu-icon-grid">
                            <a href="#"><i class="i-Testimonal"></i> Formulaire d'adhésion</a>
                            <a href="#"><i class="i-Receipt-3"></i> Règlements</a>
                            <a href="#"><i class="i-Internet"></i> Site web</a>
                            <a href="#"><i class="i-Google"></i> Google</a>
                        </div>
                    </div>
                </div>
                <!-- User avatar dropdown -->
                <div class="dropdown">
                    <div class="user col align-self-end">
                        <img src="{{ asset('storage/'.Auth::user()->photo) }}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <div class="dropdown-header">
                                <i class="i-Lock-User mr-1"></i> {{ Auth::user()->nom }}
                            </div>
                            <a class="dropdown-item">Voir mon profil</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             Deconnexion
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                        </div>
                    </div>
                </div>

            </div>
            @else
            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
            @if (Route::has('register'))
            <a class="nav-link" href="{{ route('user.create') }}">Adhérer</a>
            @endif
            @endauth
        </div>
        @auth
        <div class="side-content-wrap">
            <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <ul class="navigation-left">
                    <li class="nav-item" data-item="adherents"><a class="nav-item-hold" href="#"><i class="nav-icon i-Library"></i><span class="nav-text">Adhérents</span></a>
                        <div class="triangle"></div>
                    </li>
                    @can('responsable-section')
                    <li class="nav-item" data-item="administration"><a class="nav-item-hold" href="#"><i class="nav-icon i-Suitcase"></i><span class="nav-text">Administration</span></a>
                        <div class="triangle"></div>
                    </li>
                    @endcan
                    @can('comptabilite')
                    <li class="nav-item" data-item="tresorerie"><a class="nav-item-hold" href="#"><i class="nav-icon i-Computer-Secure"></i><span class="nav-text">Trésorerie</span></a>
                        <div class="triangle"></div>
                    </li>
                    @endcan
                </ul>
            </div>
            <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <!-- Submenu Dashboards-->
                <ul class="childNav" data-parent="adherents">
                    @can('secretariat')<li class="nav-item"><a href="{{ route('user.create')}}"><i class="nav-icon i-Add-User"></i><span class="item-name">Nouvel adhérent</span></a></li>@endcan
                    @auth <li class="nav-item"><a href="{{ route('user.show', auth()->user())}}"><i class="nav-icon i-ID-3"></i><span class="item-name">Voir mon profil</span></a></li>@endauth
                </ul>
                <ul class="childNav" data-parent="administration">
                    <li class="nav-item"><a href="{{ route('user.index')}}"><i class="nav-icon i-ID-3"></i><span class="item-name">Liste des utilisateurs</span></a></li>
                </ul>
                <ul class="childNav" data-parent="administration">
                    <li class="nav-item dropdown-sidemenu"><a href=""><i class="nav-icon i-ID-3"></i><span class="item-name">Saisons</span><i class="dd-arrow i-Arrow-Down"></i></a>
                        <ul class="submenu">
                            @if ($saisons = App\Saison::orderBy('nom', 'desc')->get())
                                @foreach ($saisons as $saison)
                                <li><a href="{{ route('user.saison', $saison->id)}}">{{ $saison->nom }}@if (App\Saison::getNomActualSaison() == $saison->nom)
                                    <span class="badge badge-info m-2">Actuelle</span>
                                @endif</a></li>
                                @endforeach
                            @endif

                        </ul>
                    </li>
                </ul>
                @can('comptabilite')
                <ul class="childNav" data-parent="tresorerie">
                    <li class="nav-item"><a href="{{ route('reglement.index')}}"><i class="nav-icon i-Add-File"></i><span class="item-name">Liste</span></a></li>
                    <li class="nav-item"><a href="{{ route('reglement.create', 1)}}"><i class="nav-icon i-Add-File"></i><span class="item-name">Création</span></a></li>
                </ul>
                @endcan
            </div>
            <div class="sidebar-overlay"></div>
        </div>
        @endauth
        <!-- =============== Left side End ================-->
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                @include('plugins.flash-message')

            @yield('content')
            </div>
            <!-- Footer Start -->
            <div class="flex-grow-1"></div>
            <div class="app-footer">
                <div class="row">
                    <div class="col-md-9">
                        <p><strong>En cours de développement</strong></p>
                    </div>
                </div>
                <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">
                    <span class="flex-grow-1"></span>
                    <div class="d-flex align-items-center">
                        <img class="logo" src="{{ asset('images/logo.png') }}" alt="">
                        <div>
                            <p class="m-0">&copy; 2020 CSADN</p>
                            <p class="m-0">Tous droits réservés</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fotter end -->
        </div>
    </div>

    <script src="{{ asset('js/plugins/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap.bundle.min.js') }}"></script>
    <!-- Sidebar -->
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/scripts/script.min.js') }}"></script>
    <script src="{{ asset('js/scripts/sidebar.large.script.min.js') }}"></script>
    <!-- Graphiques -->
    <script src="{{ asset('js/plugins/echarts.min.js') }}"></script>
    <script src="{{ asset('js/scripts/echart.options.min.js') }}"></script>
    <script src="{{ asset('js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('js/scripts/apexSparklineChart.script.min.js') }}"></script>
    <!-- Tableaux -->
    <script src="{{ asset('js/scripts/datatables.script.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables.min.js') }}"></script>
    <!--  -->
    <script src="{{ asset('js/scripts/dashboard.v4.script.min.js') }}"></script>
    <script src="{{ asset('js/scripts/widgets-statistics.min.js') }}"></script>


    <script src="{{ asset('js/plugins/mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/scripts/customizer.script.min.js') }}"></script>

    @yield('js')

</body>

</html>
