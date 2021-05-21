<?php 
include "../../function.php";

if ($_POST) {
    if (insertPesanan($_POST) > 0) {
        echo "<script>alert('Pesanan berhasil ditambahkan.')</script>";
        echo "<script>window.location.href = '../../index.php?page=makanan'</script>";
    } else {
        echo "<script>alert('Pesanan gagal ditambahkan')</script>";
        echo "<script>window.location.href = '../../index.php?page=makanan'</script>";
    }
}
?>