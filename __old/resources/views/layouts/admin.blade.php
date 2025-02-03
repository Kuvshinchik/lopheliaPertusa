<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Lophelia Pertusa</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('dashboard/images/favicon.png')}}">
    <link href="{{asset('dashboard/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('dashboard/vendor/chartist/css/chartist.min.css')}}">
    <link href="{{asset('dashboard/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/style.css')}}" rel="stylesheet">
    <!-- Datatable -->
    <link href="{{asset('dashboard/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="/" class="brand-logo">
            <img class="logo-abbr" src="{{asset('dashboard/images/logo.png')}}" alt="">
        </a>
        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <div class="dashboard_bar">
                            {{$namePage}}
                        </div>
                    </div>
                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                <img src="{{asset('dashboard/images/profile/17.jpg')}}" width="20" alt=""/>
                                <div class="header-info">
                                    <span class="text-black"><strong>Qwelly_13</strong></span>
                                    <p class="fs-12 mb-0">Администратор</p>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="./app-profile.html" class="dropdown-item ai-icon">
                                    <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <span class="ml-2">Profile </span>
                                </a>
                                <a href="./email-inbox.html" class="dropdown-item ai-icon">
                                    <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                    <span class="ml-2">Inbox </span>
                                </a>
                                <a href="./page-login.html" class="dropdown-item ai-icon">
                                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                    <span class="ml-2">Logout </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="deznav">
        <div class="deznav-scroll">
            <ul class="metismenu" id="menu">
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">Трафик</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('admin')}}">Свод</a></li>
                        <li><a href="{{route('adminSocial', ['alias' => 'vkontakte'])}}">ВКонтакте</a></li>
                        <li><a href="{{route('adminSocial', ['alias' => 'pinterest'])}}">Pinterest</a></li>
                        <li><a href="{{route('adminSocial', ['alias' => 'yarmarka'])}}">Ярмарка мастеров</a></li>
                        <li><a href="{{route('adminSocial', ['alias' => 'telegram'])}}">Телеграм</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">База данных</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('adminTable', ['alias' => 'users'])}}">Пользователи</a></li>
                        <li><a href="{{route('adminTable', ['alias' => 'tovars'])}}">Товары</a></li>
                        <li><a href="{{route('adminTable', ['alias' => 'carts'])}}">Корзина</a></li>
                        <li><a href="{{route('adminTable', ['alias' => 'blogs'])}}">Блоги</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->


	@yield('body')


    <!--**********************************
            Footer start
        ***********************************-->
    <div class="footer">
        <div class="copyright">
            <p>Copyright © Designed &amp; Developed by <a href="http://maisonmarine.ru/" target="_blank">Lophelia Pertusa</a> 2024</p>
        </div>
    </div>
    <!--**********************************
        Footer end
    ***********************************-->

    </div>
<!--**********************************
    Main wrapper end
***********************************-->

    <script src="{{asset('dashboard/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('dashboard/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('dashboard/vendor/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('dashboard/js/custom.min.js')}}"></script>
    <script src="{{asset('dashboard/js/deznav-init.js')}}"></script>
    <script src="{{asset('dashboard/vendor/owl-carousel/owl.carousel.js')}}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{asset('dashboard/vendor/peity/jquery.peity.min.js')}}"></script>

    <!-- Apex Chart -->
    <script src="{{asset('dashboard/vendor/apexchart/apexchart.js')}}"></script>

    <!-- Dashboard 1 -->
@switch(true)
//Этот скрипт обеспечивает работу главной страницы администратора
    @case($pathAdmin=='admin')
        <script src="{{asset('dashboard/js/dashboard/dashboard-1.js')}}"></script>
    @break
//Этот скрипт обеспечивает работу страниц подгрузки и аналитики данных из социальных сетей
    @case($pathAdmin=='adminSocial')
        <script src="{{asset('dashboard/js/dashboard/workout-statistic.js')}}"></script>
    @break
//Этот скрипт обеспечивает работу страниц редактирования, добавления и удаления строк в таблицах Базы Данных
    @case($pathAdmin=='adminTable')
        <script src="{{asset('dashboard/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('dashboard/js/plugins-init/datatables.init.js')}}"></script>
    @break

    @default
        <script src="{{asset('dashboard/js/dashboard/dashboard-1.js')}}"></script>
@endswitch
{{--     --}}

    <script>
        function carouselReview(){
            /*  testimonial one function by = owl.carousel.js */
            jQuery('.testimonial-one').owlCarousel({
                loop:true,
                autoplay:true,
                margin:30,
                nav:false,
                dots: false,
                left:true,
                navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
                responsive:{
                    0:{
                        items:1
                    },
                    484:{
                        items:2
                    },
                    882:{
                        items:3
                    },
                    1200:{
                        items:2
                    },

                    1540:{
                        items:3
                    },
                    1740:{
                        items:4
                    }
                }
            })
        }
        jQuery(window).on('load',function(){
            setTimeout(function(){
                carouselReview();
            }, 1000);
        });
    </script>
    {{--    @include('layouts.header.headJavascript')   --}}
</body>
</html>
