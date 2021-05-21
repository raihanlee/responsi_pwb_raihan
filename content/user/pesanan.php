<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Pesanan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Pesanan</li>
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
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="mb-3">
                            <span>Pesanan</span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Makanan</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Tanggal Diubah</th>
                                    <th style="width: 50px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = show("SELECT pes.*, m.*,pes.id AS id_pesanan ,pen.`nama` AS nama_pengguna FROM pesanan pes JOIN makanan m ON pes.`makanan_id` = m.`id` JOIN pengguna pen ON pes.`pengguna_id` = pen.`id`");
                                foreach ($data as $d) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $d['id_pesanan'] ?></td>
                                        <td>
                                            <div class="d-flex no-block align-items-center">
                                                <div class="mr-3">
                                                    <img src="uploads/<?= $d['gambar'] ?>" alt="user" class="rounded-circle" width="45" height="45">
                                                </div>
                                                <div class="w-100">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h5 class="text-dark mb-0 font-16 font-weight-medium"><?= $d['nama'] ?></h5>
                                                        <span>x<?= $d['jumlah_beli'] ?></span>
                                                    </div>
                                                    <span class="text-muted font-14"><?= rupiah($d['harga']) ?> /item</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= date_format(date_create($d['tanggal_dibuat']), "d F Y") ?></td>
                                        <td><?= date_format(date_create($d['tanggal_diubah']), "d F Y") ?></td>
                                        <td>
                                        <?php 
                                        $queryCek = mysqli_query($conn, "SELECT m.`harga`*p.`jumlah_beli` AS jumlah_bayar, dp.`bayar` FROM makanan m JOIN pesanan p ON m.`id` = p.`makanan_id` JOIN detail_pesanan dp ON dp.`pesanan_id` = p.`id` WHERE p.`id` = '$d[id_pesanan]'");
                                        $cek = mysqli_fetch_array($queryCek);
                                        $jumlahBayar = isset($cek['jumlah_bayar']) ? $cek['jumlah_bayar'] : "";
                                        $bayar = isset($cek['bayar']) ? $cek['bayar'] : "";
                                        if ($jumlahBayar == $bayar && !empty($jumlahBayar) || !empty($bayar)) {
                                            ?>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete<?= $d['id_pesanan'] ?>">Delete</button>
                                            <?php
                                        } else {
                                            ?>
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalBayar<?= $d['id_pesanan'] ?>">Bayar</button>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete<?= $d['id_pesanan'] ?>">Delete</button>
                                            <?php
                                        }
                                        ?>
                                        </td>
                                        <!-- Bayar modal content -->
                                        <div id="modalBayar<?= $d['id_pesanan'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Bayar Pesanan</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="content/user/pesanan_act.php?act=bayar" method="post" enctype="multipart/form-data">
                                                            <input type="text" value="<?= $d['id_pesanan'] ?>" name="pesanan_id" hidden>
                                                            <div class="form-group">
                                                                <label for="bayar">Bayar</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                                    </div>
                                                                    <input type="number" min="1000" class="form-control" name="bayar" id="bayar">
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Bayar</button>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                        <!-- delete modal content -->
                                        <div id="modalDelete<?= $d['id_pesanan'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Delete Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="content/user/pesanan_act.php?act=delete" method="post" enctype="multipart/form-data">
                                                            <input type="text" value="<?= $d['id_pesanan'] ?>" name="id_pesanan" hidden>
                                                            <h5>Are you sure to delete this item?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>