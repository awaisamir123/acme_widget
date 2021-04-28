<aside class="main-sidebar sidebar-dark-primary elevation-4" style="height: 0px;">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Acme Widget Co</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div>
    <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 301px;">
    </div>
    <div class="os-padding">
      <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
        <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            @if(auth()->user()->avatar != '')
                                <img src="{{asset('storage/user_image')}}/{{auth()->user()->avatar}}" class="img-circle elevation-2" alt="User Image">
                            @else
                                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                            @endif
                        </div>
                        <div class="info">
                            <a href="javascript:void(0)" class="d-block">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview">
                                <a href="{{route('dashboard')}}" class="nav-link @if(routeName() == 'dashboard') active @endif">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="{{route('product.list')}}" class="nav-link @if(routeName() == 'product.list') active @endif">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Product
                                    </p>
                                </a>
                            </li>
                            {{-- <li class="nav-item has-treeview">
                                <a href="{{route('product.offer.list')}}" class="nav-link @if(routeName() == 'product.offer.list') active @endif">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                      Product Offer
                                    </p>
                                </a>
                            </li> --}}
                            <li class="nav-item has-treeview">
                                <a href="{{route('product.basket')}}" class="nav-link @if(routeName() == 'product.basket') active @endif">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                      Product Basket
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="{{route('product.checkout')}}" class="nav-link @if(routeName() == 'product.checkout') active @endif">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                      Checkout
                                    </p>
                                </a>
                            </li>

                            {{-- <li class="nav-item has-treeview">
                                <a href="#" class="nav-link @if(routeName() == 'user.list' || routeName() == 'role.list') active @endif">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Users & Roles
                                        <i class="fas fa-angle-left right"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('company.list')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Company</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('employee.list')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Employee Of Company</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('role.list')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Roles </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="{{route('user.track')}}" class="nav-link @if(routeName() == 'user.track') active @endif">
                                  <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Track User
                                    </p>
                                </a>
                            </li> --}}

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 26.773%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
    <!-- /.sidebar -->
</aside>
