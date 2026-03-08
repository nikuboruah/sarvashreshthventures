<body id="body">
    <!-- leftbar-tab-menu -->
    <div class="leftbar-tab-menu">
        <div class="main-icon-menu">
            <a href="<?= base_url('/dashboard/index') ?>" class="logo logo-metrica d-block text-center">
                <span>
                    <img src="<?= base_url('') ?>portal_assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                </span>
            </a>
            <div class="main-icon-menu-body">
                <div class="position-reletive h-100" data-simplebar style="overflow-x: hidden;">
                    <ul class="nav nav-tabs" role="tablist" id="tab-menu">
                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard"
                            data-bs-trigger="hover">
                            <a href="#MetricaDashboard" id="dashboard-tab" class="nav-link">
                                <i class="ti ti-smart-home menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Support"
                            data-bs-trigger="hover">
                            <a href="#MetricaUikit" id="uikit-tab" class="nav-link">
                                <i class="ti ti-mail menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Genealogy"
                            data-bs-trigger="hover">
                            <a href="#GenealogySubmenu" id="uikit-tab" class="nav-link">
                                <i class="ti ti-users menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Income & Payouts"
                            data-bs-trigger="hover">
                            <a href="#EarningMenu" id="authentication-tab" class="nav-link">
                                <i class="ti ti-wallet menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Settings"
                            data-bs-trigger="hover">
                            <a href="#SettingsMenu" id="authentication-tab" class="nav-link">
                                <i class="ti ti-settings menu-icon"></i>
                            </a>
                        </li>
                    </ul>
                    <!--end nav-->
                </div>
                <!--end /div-->
            </div>
            <!--end main-icon-menu-body-->
            <div class="pro-metrica-end">
                <a href="#" class="profile">
                    <img src="<?php echo base_url('uploads/profile/'.$this->session->userdata('aiplUserId').'.png') ?>" alt="profile-user"
                        class="rounded-circle thumb-sm">
                </a>
            </div>
            <!--end pro-metrica-end-->
        </div>
        <!--end main-icon-menu-->

        <div class="main-menu-inner">
            <!-- LOGO -->
            <div class="topbar-left">
                <a href="<?= base_url('/dashboard') ?>" class="logo">
                    <span>
                        <img src="<?= base_url('') ?>portal_assets/images/logo-dark.png" alt="logo-large"
                            class="logo-lg logo-dark">
                        <img src="<?= base_url('') ?>portal_assets/images/logo.png" alt="logo-large"
                            class="logo-lg logo-light">
                    </span>
                </a>
                <!--end logo-->
            </div>
            <!--end topbar-left-->
            <!--end logo-->
            <div class="menu-body navbar-vertical tab-content" data-simplebar>
                <div id="MetricaDashboard" class="main-icon-menu-pane tab-pane" role="tabpanel"
                    aria-labelledby="dasboard-tab">
                    <div class="title-box">
                        <h6 class="menu-title">Navigations</h6>
                    </div>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/dashboard/index') ?>">My Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/') ?>">Go to Website</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/registration') ?>">Registration</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('package/package') ?>">All Packages</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('product/orders') ?>">Orders</a>
                        </li>
                    </ul>
                    <!--end nav-->
                </div><!-- end Dashboards -->

                <div id="MetricaUikit" class="main-icon-menu-pane  tab-pane" role="tabpanel"
                    aria-labelledby="uikit-tab">
                    <div class="title-box">
                        <h6 class="menu-title">Support</h6>
                    </div>
                    <div class="collapse navbar-collapse" id="sidebarCollapse_2">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('mail/compose') ?>">Compose Mail</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('mail/inbox') ?>">Inbox</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('mail/sent') ?>">Sent</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="GenealogySubmenu" class="main-icon-menu-pane  tab-pane" role="tabpanel"
                    aria-labelledby="uikit-tab">
                    <div class="title-box">
                        <h6 class="menu-title">Genealogy</h6>
                    </div>
                    <div class="collapse navbar-collapse" id="sidebarCollapse_2">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('team/referral_list') ?>">My Referrals</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('team/genealogy') ?>">Tree View</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="EarningMenu" class="main-icon-menu-pane  tab-pane" role="tabpanel"
                    aria-labelledby="uikit-tab">
                    <div class="title-box">
                        <h6 class="menu-title">Income & Payouts</h6>
                    </div>
                    <div class="collapse navbar-collapse" id="sidebarCollapse_2">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('payouts/my_earnings') ?>">My Earnings</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('payouts/payout_requests') ?>">Payout Request</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('payouts/pending_payouts') ?>">Pending Payouts</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('payouts/paid_payouts') ?>">Paid Payouts</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('payouts/rejected_payouts') ?>">Rejected Payouts</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="SettingsMenu" class="main-icon-menu-pane  tab-pane" role="tabpanel"
                    aria-labelledby="uikit-tab">
                    <div class="title-box">
                        <h6 class="menu-title">Settings</h6>
                    </div>
                    <div class="collapse navbar-collapse" id="sidebarCollapse_2">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('settings/profile') ?>">Profile</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('settings/password') ?>">Manage Password</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('settings/bank_details') ?>">Bank Details</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('notifications/notifications') ?>">Notifications</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('member/welcome_letter') ?>">Welcome Letter</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>