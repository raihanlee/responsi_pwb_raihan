<?php

include "../../function.php";

switch ($_GET['act']) {
    case 'insert':
        if ($_POST) {
            if (insertMakanan($_POST) > 0) {
                echo "<script>alert('Makanan berhasil ditambahkan.')</script>";
                echo "<script>window.location.href = '../../index.php?page=makanan'</script>";
            } elseif (insertMakanan($_POST) == 'ekstensi_salah') {
                echo "<script>alert('Ekstensi harus berupa gambar')</script>";
                echo "<script>window.location.href = '../../index.php?page=makanan'</script>";
            } elseif (insertMakanan($_POST) == 'ukuran_salah') {
                echo "<script>alert('Ukuran file terlalu besar.')</script>";
                echo "<script>window.location.href = '../../index.php?page=makanan'</script>";
            } else {
                echo "<script>alert('Makanan gagal ditambahkan')</script>";
                echo "<script>window.location.href = '../../index.php?page=makanan'</script>";
            }
        }
        break;

    case 'edit':
        if ($_POST) {
            if (editMakanan($_POST) > 0) {
                echo "<script>alert('Makanan berhasil diedit.')</script>";
                echo "<script>window.location.href = '../../index.php?page=makanan'</script>";
            } else {
                echo "<script>alert('Makanan gagal diedit')</script>";
                echo "<script>window.location.href = '../../index.php?page=makanan'</script>";
            }
        }
        break;

    case 'delete':
        if ($_POST) {
            if (deleteMakanan($_POST) > 0) {
                echo "<script>alert('Makanan berhasil dihapus.')</script>";
                echo "<script>window.location.href = '../../index.php?page=makanan'</script>";
            } else {
                echo "<script>alert('Makanan gagal dihapus')</script>";
                echo "<script>window.location.href = '../../index.php?page=makanan'</script>";
            };
        }
        break;

    default:
        # code...
        break;
}
