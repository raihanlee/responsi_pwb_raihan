<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Makanan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Makanan</li>
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
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <?php
        $_GET['filter'] = isset($_GET['filter']) ? $_GET['filter'] : "";
        $i = 1;
        if ($_GET['filter'] == 'terlaris') {
            $data = show("SELECT SUM(pes.`jumlah_beli`) AS jumlah_beli, pes.`id` AS id_pesanan, m.`id` AS id_makanan, pes.*, m.* FROM pesanan pes JOIN makanan m ON pes.`makanan_id` = m.`id` GROUP BY pes.`makanan_id` ORDER BY jumlah_beli DESC");
        } else {
            $data = show("SELECT * FROM makanan");
        }
        foreach ($data as $d) {
        ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="media">
                                <img class="mr-3" width="132" height="132" src="uploads/<?= $d['gambar'] ?>" alt="Generic placeholder image">
                                <div class="media-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mt-0 mb-1 font-weight-medium"><?= $d['nama'] ?></h5>
                                        <?php 
                                        if ($_GET['filter'] == 'terlaris') {
                                            ?>
                                            <span>#<?= $i ?></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <span><?= rupiah($d['harga']) ?></span>
                                    <div class="form-group mt-5">
                                        <form action="content/user/makanan_act.php" method="post">
                                            <input type="hidden" name="makanan_id" value="<?= $d['id'] ?>">
                                            <div class="input-group w-100">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">x</span>
                                                </div>
                                                <input type="number" min="1" name="jumlah" id="jumlah" class="form-control" required>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary">Pesan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
            $i++;
        }
        ?>
    </div>
</div>