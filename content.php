<?php

$_GET['page'] = isset($_GET['page']) ? $_GET['page'] : "";

switch ($_GET['page']) {
    case 'makanan':
        $user['level_id'] == 1 ? include "content/admin/makanan.php" : include "content/user/makanan.php";
        break;

    case 'detail_pesanan':
        $user['level_id'] == 1 ? include "content/admin/detail_pesanan.php" : "";
        break;

    case 'pesanan':
        $user['level_id'] == 1 ? include "content/admin/pesanan.php" : include "content/user/pesanan.php";
        break;

    case 'pengguna':
        $user['level_id'] == 1 ? include "content/admin/pengguna.php" : "";
        break;

    default:
?>
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Have a nice Day <?= $user['nama'] ?>!</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <a href="?page=makanan&filter=terlaris">
                        <div class="card border-right">
                            <div class="card-body">
                                <div class="d-flex d-lg-flex d-md-block align-items-center">
                                    <div>
                                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">Terlaris</h2>
                                        </h6>
                                    </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0">
                                        <span class="opacity-7 text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 5vh; height: 5vh;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
<?php
        break;
}
