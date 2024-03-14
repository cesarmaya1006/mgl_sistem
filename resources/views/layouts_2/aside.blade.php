<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach ($menusComposer as $key => $item)
                    @if ($item['config_menu_id'] != 0)
                        @break
                    @endif
                    @include("layouts.menu-ite_2", ["item" => $item])
                @endforeach
            </ul>

            <!--<ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html" aria-expanded="false" >
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @foreach ($menusComposer as $key => $item)
                    @if ($item['config_menu_id'] != null)
                        @break
                    @endif
                    @include("layouts.menu-item", ["item" => $item])
                @endforeach
            </ul>
        -->
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
