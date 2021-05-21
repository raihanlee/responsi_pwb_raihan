<?php
include "../../function.php";

switch ($_GET['act']) {
    case 'insert':
        if ($_POST) {
            if (insertDetail($_POST) > 0) {
                echo "<script>alert('Detail Pesanan berhasil ditambahkan.')</script>";
                echo "<script>window.location.href = '../../index.php?page=detail_pesanan'</script>";
            } else {
                echo "<script>alert('Detail Pesanan gagal ditambahkan.')</script>";
                echo "<script>window.location.href = '../../index.php?page=detail_pesanan'</script>";
            }
        }
        break;

    case 'edit':
        if ($_POST) {
            if (editDetail($_POST) > 0) {
                echo "<script>alert('Detail Pesanan berhasil diedit.')</script>";
                echo "<script>window.location.href = '../../index.php?page=detail_pesanan'</script>";
            } else {
                echo "<script>alert('Detail Pesanan gagal diedit.')</script>";
                echo "<script>window.location.href = '../../index.php?page=detail_pesanan'</script>";
            }
        }
        break;

    case 'delete':
        if ($_POST) {
            if (deleteDetail($_POST) > 0) {
                echo "<script>alert('Detail Pesanan berhasil dihapus.')</script>";
                echo "<script>window.location.href = '../../index.php?page=detail_pesanan'</script>";
            } else {
                echo "<script>alert('Detail Pesanan gagal dihapus.')</script>";
                echo "<script>window.location.href = '../../index.php?page=detail_pesanan'</script>";
            }
        }
        break;
    default:
        # code...
        break;
}
