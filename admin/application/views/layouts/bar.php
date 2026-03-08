<body id="body">
    <!-- leftbar-tab-menu -->
    <div class="leftbar-tab-menu">
        <div class="main-icon-menu">
            <a href="<?= base_url('/dashboard') ?>" class="logo logo-metrica d-block text-center">
                <span>
                    <img src="<?= base_url('../') ?>portal_assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
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
                            <!--end nav-link-->
                        </li>
                        <!--end nav-item-->
                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Packages"
                            data-bs-trigger="hover">
                            <a href="#MetricaApps" id="apps-tab" class="nav-link">
                                <i class="ti ti-apps menu-icon"></i>
                            </a>
                            <!--end nav-link-->
                        </li>
                        <!--end nav-item-->

                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Support"
                            data-bs-trigger="hover">
                            <a href="#MailSupport" id="uikit-tab" class="nav-link">
                                <i class="ti ti-mail menu-icon"></i>
                            </a>
                            <!--end nav-link-->
                        </li>

                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Teams & Networks"
                            data-bs-trigger="hover">
                            <a href="#MetricaUikit" id="uikit-tab" class="nav-link">
                                <i class="ti ti-users menu-icon"></i>
                            </a>
                            <!--end nav-link-->
                        </li>
                        <!--end nav-item-->

                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Products"
                            data-bs-trigger="hover">
                            <a href="#MetricaPages" id="pages-tab" class="nav-link">
                                <i class="ti ti-shopping-cart menu-icon"></i>
                            </a>
                            <!--end nav-link-->
                        </li>
                        <!--end nav-item-->

                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Income & Payouts"
                            data-bs-trigger="hover">
                            <a href="#IncomeMenu" id="authentication-tab" class="nav-link">
                                <i class="ti ti-wallet menu-icon"></i>
                            </a>
                            <!--end nav-link-->
                        </li>

                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Settings"
                            data-bs-trigger="hover">
                            <a href="#SettingsMenu" id="authentication-tab" class="nav-link">
                                <i class="ti ti-settings menu-icon"></i>
                            </a>
                        </li>
                        <!--end nav-item-->
                    </ul>
                    <!--end nav-->
                </div>
                <!--end /div-->
            </div>
            <!--end main-icon-menu-body-->
            <div class="pro-metrica-end">
                <a href="#" class="profile">
                    <img src="<?= base_url('../') ?>portal_assets/images/favicon.png" alt="profile-user"
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
                        <img src="<?= base_url('../') ?>portal_assets/images/logo-dark.png" alt="logo-large"
                            class="logo-lg logo-dark">
                        <img src="<?= base_url('../') ?>portal_assets/images/logo.png" alt="logo-large"
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
                        <h6 class="menu-title">Dashboard</h6>
                    </div>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/dashboard') ?>">My Dashboard</a>
                        </li>
                    </ul>
                    <!--end nav-->
                </div><!-- end Dashboards -->

                <div id="MetricaApps" class="main-icon-menu-pane tab-pane" role="tabpanel" aria-labelledby="apps-tab">
                    <div class="title-box">
                        <h6 class="menu-title">Package Master</h6>
                    </div>

                    <div class="collapse navbar-collapse" id="sidebarCollapse">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('package/package') ?>">Create Package</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('package/active_package') ?>">Manage Packages</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="MailSupport" class="main-icon-menu-pane tab-pane" role="tabpanel" aria-labelledby="apps-tab">
                    <div class="title-box">
                        <h6 class="menu-title">Mail Support</h6>
                    </div>

                    <div class="collapse navbar-collapse" id="sidebarCollapse">
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


                <div id="MetricaUikit" class="main-icon-menu-pane  tab-pane" role="tabpanel"
                    aria-labelledby="uikit-tab">
                    <div class="title-box">
                        <h6 class="menu-title">Team & Networks</h6>
                    </div>
                    <div class="collapse navbar-collapse" id="sidebarCollapse_2">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#sidebarMaps" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarMaps">
                                    Members
                                </a>
                                <div class="collapse " id="sidebarMaps">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('team/all_members') ?>">All
                                                Members</a>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('team/pending_members') ?>">Pending
                                                Members</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('team/active_members') ?>">Active
                                                Members</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('team/blocked_members') ?>">Blocked
                                                Members</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('team/team_kyc') ?>">Team KYC</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('team/genealogy') ?>">Tree View</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('rank/rank_details') ?>">Rank</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="MetricaPages" class="main-icon-menu-pane  tab-pane" role="tabpanel"
                    aria-labelledby="uikit-tab">
                    <div class="title-box">
                        <h6 class="menu-title">Products & Orders</h6>
                    </div>
                    <div class="collapse navbar-collapse" id="sidebarCollapse_2">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarProducts">
                                    Product Master
                                </a>
                                <div class="collapse " id="sidebarProducts">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="<?= base_url('product/categories') ?>">Categories</a>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('product/products') ?>">Add
                                                Product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="<?= base_url('product/manageProducts/active') ?>">Manage
                                                Products</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('product/orders') ?>">Orders</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="IncomeMenu" class="main-icon-menu-pane  tab-pane" role="tabpanel"
                    aria-labelledby="uikit-tab">
                    <div class="title-box">
                        <h6 class="menu-title">Products & Orders</h6>
                    </div>
                    <div class="collapse navbar-collapse" id="sidebarCollapse_2">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('payouts/payout_requests') ?>">Payout Request</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('payouts/paid_payouts') ?>">Paid Payouts</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('payouts/rejected_payouts') ?>">Rejected Payouts</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('payouts/weekly_payouts') ?>">Weekly Payouts</a>
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
                                <a class="nav-link" href="<?= base_url('content/bank_details') ?>">Bank Details</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#sidebarMaps" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarMaps">
                                    Notifications
                                </a>
                                <div class="collapse " id="sidebarMaps">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('notifications/newNotification') ?>">Add Notification</a>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('notifications/notifications') ?>">All Notifications</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>