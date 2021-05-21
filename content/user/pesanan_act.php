<?php 
include "../../function.php";

switch ($_GET['act']) {
    case 'bayar':
        if ($_POST) {
            if (insertDetail($_POST) > 0) {
                echo "<script>alert('Pesanan berhasil dibayar.')</script>";
                echo "<script>window.location.href = '../../index.php?page=pesanan'</script>";
            } else {
                echo "<script>alert('Pesanan gagal dibayar')</script>";
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
                }
            }
            break;
    
    default:
        # code...
        break;
}
