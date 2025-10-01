<!doctype html>
<html lang="en" data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" dir="ltr" data-pc-theme="light">
  <!-- [Head] start -->

  <head>
    <title>Textile</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Datta Able is trending dashboard template made using Bootstrap 5 design framework. Datta Able is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies."
    />
    <meta
      name="keywords"
      content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard"
    />
    <meta name="author" content="CodedThemes" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- [Favicon] icon -->
    <link rel="icon" href="{{asset('assets/images/favicon.svg')}}" type="image/x-icon" />

     <!-- [Font] Family -->
     <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{asset('assets/fonts/phosphor/duotone/style.css')}}" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{asset('assets/fonts/tabler-icons.min.css')}}" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{asset('assets/fonts/feather.css')}}" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome.css')}}" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{asset('assets/fonts/material.css')}}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" id="main-style-link" />
    
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->

  <body>
    <!-- [ Pre-loader ] start -->
<div class="loader-bg fixed inset-0 bg-white dark:bg-themedark-cardbg z-[1034]">
  <div class="loader-track h-[5px] w-full inline-block absolute overflow-hidden top-0">
    <div class="loader-fill w-[300px] h-[5px] bg-primary-500 absolute top-0 left-0 animate-[hitZak_0.6s_ease-in-out_infinite_alternate]"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
 <!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header flex items-center py-4 px-6 h-header-height">
      <a href="" class="b-brand flex items-center gap-3">
        <!-- ========   Change your logo from here   ============ -->
        <img src="{{asset('assets/images/logo-white.svg')}}" class="img-fluid  logo-lg" alt="logo" />
        <img src="{{asset('assets/images/favicon.svg')}}" class="img-fluid  logo-sm" alt="logo" />
      </a>
    </div>
    <div class="navbar-content h-[calc(100vh_-_74px)] py-2.5">
      <ul class="pc-navbar">
        <li class="pc-item pc-caption">
          <label>Hisobotlar</label>
        </li>
        <li class="pc-item">
        <li class="pc-item">
          <a href="{{ route('incomes.index') }}" class="pc-link">
            <span class="pc-micon">
              <i data-feather="activity"></i>
            </span>
            <span class="pc-mtext">Hozirgi Holat</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('statistics.index') }}" class="pc-link">
            <span class="pc-micon">
              <i data-feather="bar-chart-2"></i>
            </span>
            <span class="pc-mtext">Statistika</span>
          </a>
        </li>
        <li class="pc-item pc-caption">
          <label>Katalog</label>
          <i data-feather="feather"></i>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="{{ route('textile.index') }}" class="pc-link">
            <span class="pc-micon"> <i data-feather="list"></i></span>
            <span class="pc-mtext">Kategoriya</span>
          </a>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="{{ route('types.index') }}" class="pc-link">
            <span class="pc-micon"> <i data-feather="type"></i></span>
            <span class="pc-mtext">Turlari</span>
          </a>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="{{ route('colors.index') }}" class="pc-link">
            <span class="pc-micon"> <i class="fas fa-palette"></i></span>
            <span class="pc-mtext">Ranglari</span>
          </a>
        </li>

        <li class="pc-item pc-caption">
          <label>Pages</label>
          <i data-feather="monitor"></i>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="{{ route('login') }}" class="pc-link" target="_blank">
            <span class="pc-micon"> <i data-feather="lock"></i></span>
            <span class="pc-mtext">Login</span>
          </a>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="{{ route('register') }}" class="pc-link" target="_blank">
            <span class="pc-micon"> <i data-feather="user-plus"></i></span>
            <span class="pc-mtext">Register</span>
                                   
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>
<!-- [ Sidebar Menu ] end -->
 <!-- [ Header Topbar ] start -->
<header class="pc-header">
  <div class="header-wrapper flex max-sm:px-[15px] px-[25px] grow"><!-- [Mobile Media Block] start -->
<div class="me-auto pc-mob-drp">
  <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
    <!-- ======= Menu collapse Icon ===== -->
    <li class="pc-h-item pc-sidebar-collapse max-lg:hidden lg:inline-flex">
      <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="sidebar-hide">
        <i data-feather="menu"></i>
      </a>
    </li>
    <li class="pc-h-item pc-sidebar-popup lg:hidden">
      <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="mobile-collapse">
        <i data-feather="menu"></i>
      </a>
    </li>
   @yield('search')
  </ul>
</div>
<!-- [Mobile Media Block end] -->
<div class="ms-auto">
  <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
    <li class="dropdown pc-h-item">
      <a class="pc-head-link dropdown-toggle me-0" data-pc-toggle="dropdown" href="#" role="button"
        aria-haspopup="false" aria-expanded="false">
        <i data-feather="settings"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
        <a href="#!" class="dropdown-item">
          <i class="ti ti-settings"></i>
          <span>Settings</span>
        </a>
        <a href="#!" class="dropdown-item">
          <i class="ti ti-headset"></i>
          <span>Support</span>
        </a>
        <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <i class="ti ti-power" ></i>
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
      </div>
    </li>

    <li class="dropdown pc-h-item header-user-profile">
      <a class="pc-head-link dropdown-toggle arrow-none me-0" data-pc-toggle="dropdown" href="#" role="button"
        aria-haspopup="false" data-pc-auto-close="outside" aria-expanded="false">
        <i data-feather="user"></i>
      </a>
      <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown p-2 overflow-hidden">
        <div class="dropdown-header flex items-center justify-between py-4 px-5 bg-primary-500">
          <div class="flex mb-1 items-center" style="margin-left: -45px" >
            <div class="shrink-0">
              <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="user-image" class="w-10 rounded-full" />
            </div>
            <div class="grow ms-3">
              <h6 class="mb-1 text-white">{{ Auth::user()->name }}</h6>
              <span class="text-white">{{ Auth::user()->email }}</span>
            </div>
          </div>
        </div>
        <div class="dropdown-body py-4 px-5">
          <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2 inline-block">
                  <use xlink:href="#custom-setting-outline"></use>
                </svg>
                <span>Settings</span>
              </span>
            </a>
            <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2 inline-block">
                  <use xlink:href="#custom-share-bold"></use>
                </svg>
                <span>Share</span>
              </span>
            </a>
            <div class="grid my-3">
              <button class="btn btn-primary flex items-center justify-center">
                <svg class="pc-icon me-2 w-[22px] h-[22px]">
                  <use xlink:href="#custom-logout-1-outline"></use>
                </svg>
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </button>
            </div>
          </div>
        </div>
      </div>
    </li>
  </ul>
</div></div>
</header>
<!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="page-header-title">
             @yield('title')
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        @yield('content')
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <!-- [ Main Content ] end -->

 
    <!-- Required Js -->
    <script src="{{asset('assets/js/plugins/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/icon/custom-icon.js')}}"></script>
    <script src="{{asset('assets/js/plugins/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/component.js')}}"></script>
    <script src="{{asset('assets/js/theme.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>

    <div class="floting-button fixed bottom-[50px] right-[30px] z-[1030]">
    </div>

    
    <script>
      layout_change('false');
    </script>
     
    
    <script>
      layout_theme_sidebar_change('dark');
    </script>
    
     
    <script>
      change_box_container('false');
    </script>
     
    <script>
      layout_caption_change('true');
    </script>
     
    <script>
      layout_rtl_change('false');
    </script>
     
    <script>
      preset_change('preset-1');
    </script>
     
    <script>
      main_layout_change('vertical');
    </script>
    <script src="{{ asset('jquery/jquery.js') }}" ></script>
    <script>
        $('.ser').on('keyup', function () {
        let value = $(this).val();

        $.ajax({
            url: '{{ route("cats.search") }}',
            type: 'GET',
            data: { ser: value },
            success: function (data) {
                $('.cat_table').html(data.html);
            }
        });
    });

        $('.ser_type').on('keyup',function(){
            let value=$(this).val();

            $.ajax({
                url:'{{ route("types.search") }}',
                type:"GET",
                data:{ser_type:value},
                success:function(data){
                    $(".type_table").html(data.html);
                }
            });
        });
        $('.ser_color').on('keyup',function(){
            let value=$(this).val();

            $.ajax({
                url:'{{ route("colors.search") }}',
                type:"GET",
                data:{ser_color:value},
                success:function(data){
                    $('.color_table').html(data.html);
                }
            })
        });

        $('.ser_income').on('keyup',function(){
            let value=$(this).val();

            $.ajax({
                url:'{{ route("incomes.search_input") }}',
                type:"GET",
                data:{ser_income:value},
                success:function(data){
                    [$('.income_table').html(data.html1),
                      $('.sum').html(data.sum),
                    ]
                },
            })
        });

        $('.income_change_1').on('change',function(){
          let value1=$(this).val();

          $.ajax({
            url:'{{ route("incomes.cat_search") }}',
            type:"GET",
            data:{income_change_1:value1},
            success:function(data){
              $('.income_table').html(data.html);
                $('.income_change_2').html(data.types);
                $('.sum').html(data.sum);
      
            },
          })
        });

        $('.income_change_2').on('change',function(){
          let value1=$('.income_change_1').val();
          let value2=$(this).val();

          $.ajax({
            url:'{{ route("incomes.type_search") }}',
            type:"GET",
            data:{income_change_1:value1,
                  income_change_2:value2
            },
            success:function(data){
              $('.income_table').html(data.html);
              $('.sum').html(data.sum);
            },
          })
        });

        $('.delete-form').on('submit',function(e){
          if(!confirm("Rostdan ham o'chirmoqchimisiz?")){
            e.preventDefault();
          }
        });

        $("#cat_id").on('change',function(){
          let cat_id=$("#cat_id").val();

          $.ajax({
            url:'{{ route("statistics.cat_search") }}',
            type:"GET",
            data:{cat_search:cat_id},
            success:function(data){
            [
             $('#type_id').html(data.type),
            ]
            },
          })
        });

        
        
        $("#date_id").on('change',function(){
          let cat_id=$("#cat_id").val();
          let type_id=$("#type_id").val();
          let status_id=$("#status_id").val();
          let date_id=$("#date_id").val();

          $.ajax({
            url:'{{ route("statistics.date_search") }}',
            type:"GET",
            data:{cat_search:cat_id,
              type_search:type_id,
              status_search:status_id,
              date_search:date_id,
            },
            success:function(data){
            [$('.statistic_table').html(data.html), 
            $('.title_date').html(data.title_date),
            $('.sum').html(data.sum),  
            ]
            },
          })
        });

        $("#month_id").on('change',function(){
          let cat_id=$("#cat_id").val();
          let type_id=$("#type_id").val();
          let status_id=$("#status_id").val();
          let month_id=$("#month_id").val();
          let parts = month_id.split('-');
          let month = parts[1];

          $.ajax({
            url:'{{ route("statistics.month_search") }}',
            type:"GET",
            data:{cat_search:cat_id,
              type_search:type_id,
              status_search:status_id,
              month_search:month,
              month:month_id,

            },
            success:function(data){
            [$('.statistic_table').html(data.html),
            $('.title_date').html(data.title_date),
            $('.sum').html(data.sum),            
            ]
            },
          })
        });

    </script>
  </body>
  <!-- [Body] end -->
</html>
