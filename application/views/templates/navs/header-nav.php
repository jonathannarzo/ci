<header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url('/')?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>PP</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>APP</b>LICATION</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?=base_url('assets/img/male.png')?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?=$this->_print_user?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?=base_url('assets/img/male.png')?>" class="img-circle" alt="User Image">
                            <p>
                                <?=$this->_print_user?><br/>
                                <?=$this->_user->role?>
                                <small>Member since <?=date('M. j, Y', strtotime($this->_user->created_at))?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?=base_url('profile')?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?=base_url('authentication/logout')?>" class="btn btn-default btn-flat confirm-action" confirm-message="You are going to sign-out?">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li><!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>