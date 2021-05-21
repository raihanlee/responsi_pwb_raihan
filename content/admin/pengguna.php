<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Pengguna</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.php" class="text-muted">Kelola</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Pengguna</li>
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
                            <span>Pengguna</span>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalInsert">Insert Data<i class="fa fa-plus ml-2"></i></button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Level</th>
                                    <th style="width: 50px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = show("SELECT * FROM pengguna");
                                foreach ($data as $d) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $d['id'] ?></td>
                                        <td><?= $d['nama'] ?></td>
                                        <td><?= $d['username'] ?></td>
                                        <td><?= $d['password'] ?></td>
                                        <?= $d['level_id'] == 1 ? "<td class='text-center'><span class='badge badge-dark'>ADMIN</span></td>" : "<td class='text-center'><span class='badge badge-light'>PEMBELI</span></td>"; ?>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalEdit<?= $d['id'] ?>">Edit</button>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete<?= $d['id'] ?>">Delete</button>
                                        </td>
                                        <!-- edit modal content -->
                                        <div id="modalEdit<?= $d['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="content/admin/pengguna_act.php?act=edit" method="post" enctype="multipart/form-data">
                                                            <input type="text" value="<?= $d['id'] ?>" name="id" hidden>
                                                            <div class="form-group">
                                                                <label for="nama">Nama</label>
                                                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $d['nama'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="username">Username</label>
                                                                <input type="text" name="username" id="username" class="form-control" value="<?= $d['username'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password">Password</label>
                                                                <input type="password" name="password" id="password" class="form-control" value="">* Kosongkan jika tidak diubah
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="level">Level</label>
                                                                <select name="level" id="level" class="custom-select">
                                                                    <?php
                                                                    $option = show("SELECT * FROM `level`");
                                                                    foreach ($option as $o) {
                                                                        if ($o['id'] == $d['level_id']) {
                                                                    ?>
                                                                            <option value="<?= $o['id'] ?>" selected><?= $o['keterangan'] ?></option>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <option value="<?= $o['id'] ?>"><?= $o['keterangan'] ?></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                        <!-- delete modal content -->
                                        <div id="modalDelete<?= $d['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Delete Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="content/admin/pengguna_act.php?act=delete" method="post" enctype="multipart/form-data">
                                                            <input type="text" value="<?= $d['id'] ?>" name="id" hidden>
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
<!-- insert modal content -->
<div id="modalInsert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Insert Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="content/admin/pengguna_act.php?act=insert" method="post" enctype="multipart/form-data">
                    <input type="text" name="id" hidden>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="custom-select">
                            <?php
                            $option = show("SELECT * FROM `level`");
                            foreach ($option as $o) {
                            ?>
                                <option value="<?= $o['id'] ?>"><?= $o['keterangan'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->