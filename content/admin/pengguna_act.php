<?php

include "../../function.php";

switch ($_GET['act']) {
    case 'insert':
        if ($_POST) {
            if (insertPengguna($_POST) > 0) {
                echo "<script>alert('Pengguna berhasil ditambahkan.')</script>";
                echo "<script>window.location.href = '../../index.php?page=pengguna'</script>";
            } else {
                echo "<script>alert('Pengguna gagal ditambahkan')</script>";
                echo "<script>window.location.href = '../../index.php?page=pengguna'</script>";
            }
        }
        break;

    case 'edit':
        if ($_POST) {
            if (editPengguna($_POST) > 0) {
                echo "<script>alert('Pengguna berhasil diedit.')</script>";
                echo "<script>window.location.href = '../../index.php?page=pengguna'</script>";
            } else {
                echo "<script>alert('Pengguna gagal diedit')</script>";
                echo "<script>window.location.href = '../../index.php?page=pengguna'</script>";
            }
        }
        break;

    case 'delete':
        if ($_POST) {
            if (deletePengguna($_POST) > 0) {
                echo "<script>alert('Pengguna berhasil dihapus.')</script>";
                echo "<script>window.location.href = '../../index.php?page=pengguna'</script>";
            } else {
                echo "<script>alert('Pengguna gagal dihapus')</script>";
                echo "<script>window.location.href = '../../index.php?page=pengguna'</script>";
            }
        }
        break;

    default:
        # code...
        break;
}
