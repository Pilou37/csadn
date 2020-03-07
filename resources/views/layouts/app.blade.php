<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard v4 | Gull Admin Template</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="{{ asset('css/themes/lite-blue.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins/perfect-scrollbar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins/datatables.min.css') }}" rel="stylesheet" />
</head>

<body class="text-left">

    <div class="app-admin-wrap layout-sidebar-large">

        <div class="main-header">
            <div>
                <a href="{{ route('index')}}">
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
                            <a href="#"><i class="i-Shop-4"></i> Home</a>
                            <a href="#"><i class="i-Library"></i> UI Kits</a>
                            <a href="#"><i class="i-Drop"></i> Apps</a>
                            <a href="#"><i class="i-File-Clipboard-File--Text"></i> Forms</a>
                            <a href="#"><i class="i-Checked-User"></i> Sessions</a>
                            <a href="#"><i class="i-Ambulance"></i> Support</a>
                        </div>
                    </div>
                </div>
                <!-- Notificaiton -->
                <div class="dropdown">
                    <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-primary">3</span>
                        <i class="i-Bell text-muted header-icon"></i>
                    </div>
                    <!-- Notification dropdown -->
                    <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none" aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>New message</span>
                                    <span class="badge badge-pill badge-primary ml-1 mr-1">new</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">10 sec ago</span>
                                </p>
                                <p class="text-small text-muted m-0">James: Hey! are you busy?</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Receipt-3 text-success mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>New order received</span>
                                    <span class="badge badge-pill badge-success ml-1 mr-1">new</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">2 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">1 Headphone, 3 iPhone x</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Empty-Box text-danger mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>Product out of stock</span>
                                    <span class="badge badge-pill badge-danger ml-1 mr-1">3</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">10 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">Headphone E67, R98, XL90, Q77</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Data-Power text-success mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>Server Up!</span>
                                    <span class="badge badge-pill badge-success ml-1 mr-1">3</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">14 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">Server rebooted successfully</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Notificaiton End -->
                <!-- User avatar dropdown -->
                <div class="dropdown">
                    <div class="user col align-self-end">
                        <img src="{{ asset('images/avatar.png') }}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <div class="dropdown-header">
                                <i class="i-Lock-User mr-1"></i> {{ Auth::user()->nom }}
                            </div>
                            <a class="dropdown-item">Account settings</a>
                            <a class="dropdown-item">Billing history</a>
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
            <a class="nav-link" href="{{ route('register') }}">Adhérer</a>
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
                    <li class="nav-item" data-item="administration"><a class="nav-item-hold" href="#"><i class="nav-icon i-Suitcase"></i><span class="nav-text">Administration</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="tresorerie"><a class="nav-item-hold" href="#"><i class="nav-icon i-Computer-Secure"></i><span class="nav-text">Trésorerie</span></a>
                        <div class="triangle"></div>
                    </li>
                </ul>
            </div>
            <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <!-- Submenu Dashboards-->
                <ul class="childNav" data-parent="adherents">
                    <li class="nav-item"><a href="{{ route('user.create')}}"><i class="nav-icon i-Add-User"></i><span class="item-name">Ajouter un adhérent</span></a></li>
                    <li class="nav-item"><a href="{{ route('user.index')}}"><i class="nav-icon i-ID-3"></i><span class="item-name">Liste des utilisateurs</span></a></li>
                </ul>
                <ul class="childNav" data-parent="administration">
                    <li class="nav-item"><a href="#"><i class="nav-icon i-Add-File"></i><span class="item-name">Sous-menu</span></a></li>
                </ul>
                <ul class="childNav" data-parent="tresorerie">
                    <li class="nav-item"><a href="#"><i class="nav-icon i-Add-File"></i><span class="item-name">Sous-menu</span></a></li>
                </ul>
            </div>
            <div class="sidebar-overlay"></div>
        </div>
        @endauth
        <!-- =============== Left side End ================-->
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <div class="row">
                    <div class="col">
                        <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Success!</strong> Lorem ipsum dolor sit amet.
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>
                </div>
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


    <script src="{{ asset('js/scripts/customizer.script.min.js') }}"></script>
</body>

</html>
