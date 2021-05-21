<?php

include "../../function.php";

switch ($_GET['act']) {
    case 'insert':
        if ($_POST) {
            if (insertPesanan($_POST) > 0) {
                echo "<script>alert('Pesanan berhasil ditambahkan.')</script>";
                echo "<script>window.location.href = '../../index.php?page=pesanan'</script>";
            } elseif (insertPesanan($_POST) == 'ekstensi_salah') {
                echo "<script>alert('Ekstensi harus berupa gambar')</script>";
                echo "<script>window.location.href = '../../index.php?page=pesanan'</script>";
            } elseif (insertPesanan($_POST) == 'ukuran_salah') {
                echo "<script>alert('Ukuran file terlalu besar.')</script>";
                echo "<script>window.location.href = '../../index.php?page=pesanan'</script>";
            } else {
                echo "<script>alert('Pesanan gagal ditambahkan')</script>";
                echo "<script>window.location.href = '../../index.php?page=pesanan'</script>";
            }
        }
        break;

    case 'edit':
        if ($_POST) {
            if (editPesanan($_POST) > 0) {
                echo "<script>alert('Pesanan berhasil diedit.')</script>";
                echo "<script>window.location.href = '../../index.php?page=pesanan'</script>";
            } else {
                echo "<script>alert('Pesanan gagal diedit')</script>";
                echo "<script>window.location.href = '../../index.php?page=pesanan'</script>";
            }
        }
        break;

    case 'delete':
        if ($_POST) {
            if (deletePesanan($_POST) > 0) {
                echo "<script>alert('Pesanan berhasil dihapus.')</script>";
                echo "<script>window.location.href = '../../index.php?page=pesanan'</script>";
            } else {
                echo "<script>alert('Pesanan gagal dihapus')</script>";
                echo "<script>window.location.href = '../../index.php?page=pesanan'</script>";
            };
        }
        break;

    default:
        # code...
        break;
}
