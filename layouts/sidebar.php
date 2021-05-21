        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="index.php" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Kelola</span></li>

                        <?php
                        if ($user['level_id'] == 1) {
                        ?>
                            <li class="sidebar-item"> <a class="sidebar-link" href="index.php?page=makanan" aria-expanded="false"><i class="fa fa-utensils"></i><span class="hide-menu">Makanan
                                    </span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="index.php?page=pesanan" aria-expanded="false"><i class="fa fa-shopping-cart"></i><span class="hide-menu">Pesanan</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="index.php?page=detail_pesanan" aria-expanded="false"><i class="fa fa-history"></i><span class="hide-menu">Detail Pesanan</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="index.php?page=pengguna" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Pengguna</span></a></li>
                        <?php
                        } else {
                        ?>
                            <li class="sidebar-item"> <a class="sidebar-link" href="index.php?page=makanan" aria-expanded="false"><i class="fa fa-utensils"></i><span class="hide-menu">Makanan
                                    </span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="index.php?page=pesanan" aria-expanded="false"><i class="fa fa-shopping-cart"></i><span class="hide-menu">Pesanan</span></a></li>
                        <?php
                        }
                        ?>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="admin/logout.php" aria-expanded="false"><i class="fa fa-sign-out-alt"></i><span class="hide-menu">Logout</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->