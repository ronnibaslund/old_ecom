<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle"
                     alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Ronni H. Baslund</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                  <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <!-- Optionally, you can add icons to the links -->
            {{--<li class="active"><a href="#"><span>Link</span></a></li>--}}
            {{--<li><a href="#"><span>Another Link</span></a></li>--}}
            <li><a href="{{ url('admin/orders') }}"><i class="fa fa-money"></i> <span>Ordrer</span></a></li>
            <li><a href="{{ url('admin/coupons') }}"><i class="fa fa-tag"></i> <span>Kuponer</span></a></li>
            <li><a href="{{ url('admin/giftcards') }}"><i class="fa fa-gift"></i> <span>Gavekort</span></a></li>
            {{--<li><a href="#"><i class="fa fa-bar-chart"></i> <span>Rapporter</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-repeat"></i> <span>Abonnementer</span></a></li>--}}
            <li><a href="{{ url('admin/customers') }}"><i class="fa fa-users"></i> <span>Kunder</span></a></li>


            <li class="treeview">
                <a href="#"><i class="fa fa-shopping-cart"></i> <span>Produkter</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/products') }}">Produkter</a></li>
                    <li><a href="{{ url('admin/product/create') }}">Tilføj produkt</a></li>
                    <li><a href="{{ url('admin/categories') }}">Kategorier</a></li>
                    {{--<li><a href="#">Tags</a></li>--}}
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-file-o"></i> <span>Sider</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/pages') }}">Alle sider</a></li>
                    <li><a href="{{ url('admin/page/create') }}">Tilføj ny</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-picture-o"></i> <span>Medier</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/media') }}">Bibliotek</a></li>
                    {{--<li><a href="#">Tilføj ny</a></li>--}}
                </ul>
            </li>

            {{--<li class="treeview">--}}
                {{--<a href="#"><i class="fa fa-paint-brush"></i> <span>Udseende</span> <i class="fa fa-angle-left pull-right"></i></a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="#">Menuer</a></li>--}}
                    {{--<li><a href="#">Header</a></li>--}}
                    {{--<li><a href="#">Footer</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            {{--<li class="treeview">--}}
                {{--<a href="#"><i class="fa fa-newspaper-o"></i> <span>Nyhedsbrev</span> <i class="fa fa-angle-left pull-right"></i></a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="#">Tilmeldte</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            <li class="treeview">
                <a href="#"><i class="fa fa-cogs"></i> <span>Indstillinger</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/settings/email') }}">Email</a></li>
                    <li><a href="{{ url('admin/settings/general') }}">General</a></li>
                    <li><a href="{{ url('admin/settings/product') }}">Produkter</a></li>
                    <li><a href="{{ url('admin/settings/tax') }}">Moms</a></li>
                    <li><a href="{{ url('admin/settings/checkout') }}">Check ud</a></li>
                    <li><a href="{{ url('admin/settings/shipping') }}">Forsendelse</a></li>
                    {{--<li><a href="#">konti</a></li>--}}
                    {{--<li><a href="#">E-mails</a></li>--}}
                    {{--<li><a href="#">Integration</a></li>--}}
                    {{--<li><a href="#">Gavekort</a></li>--}}
                    {{--<li><a href="#">EU Moms</a></li>--}}
                    {{--<li><a href="#">PDF Faktura</a></li>--}}
                    {{--<li><a href="#">Brugere</a></li>--}}
                </ul>
            </li>


        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>