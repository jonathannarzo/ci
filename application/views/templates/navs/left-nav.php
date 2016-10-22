<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=base_url('assets/img/male.png')?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=$this->_print_user?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>User Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url('users')?>"><i class="fa fa-circle-o"></i> Users</a></li>
                    <li><a href="<?=base_url('user_types')?>"><i class="fa fa-circle-o"></i> User Types</a></li>                    
                </ul>
            </li>
        </ul>
    </section><!-- /.sidebar -->
</aside>