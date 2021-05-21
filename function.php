<?php
session_start();

$servername = "localhost";
$database = "responsi_pwb_raihan";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

function show($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function rupiah($angka)
{

    $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function login($data)
{
    global $conn;
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $query = "SELECT * FROM pengguna WHERE username = '$username' AND `password` = '$password'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result);
}

function register($data)
{
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);

    $cek = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'");
    if (mysqli_fetch_assoc($cek)) {
?>
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                Username already exists!
            </div>
        </div>
<?php
        return false;
    }
    mysqli_query($conn, "INSERT INTO pengguna (level_id,nama,username,`password`,alamat) VALUES('2','$nama','$username','$password','$alamat')");
    return mysqli_affected_rows($conn);
}

function insertMakanan($data)
{
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['harga']);

    $rand = rand();
    $ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
    $filename = $_FILES['gambar']['name'];
    $ukuran = $_FILES['gambar']['size'];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($ext, $ekstensi)) {
        return "ekstensi_salah";
    } else {
        if ($ukuran < 1044070) {
            $nameWithRand = $rand . '_' . $filename;
            move_uploaded_file($_FILES['gambar']['tmp_name'], '../../uploads/' . $nameWithRand);
            mysqli_query($conn, "INSERT INTO makanan (nama,harga,gambar) VALUES ('$nama','$harga','$nameWithRand')");
            return mysqli_affected_rows($conn);
        } else {
            return "ukuran_salah";
        }
    }
}

function editMakanan($data)
{
    global $conn;
    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['harga']);

    if (!empty($_FILES['gambar']['name'])) {
        $rand = rand();
        $ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
        $filename = $_FILES['gambar']['name'];
        $ukuran = $_FILES['gambar']['size'];

        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $namaSebelumnya = show("SELECT gambar FROM makanan WHERE id = '$id'")[0];

        if (!in_array($ext, $ekstensi)) {
            return "ekstensi_salah";
        } else {
            if ($ukuran < 1044070) {
                $nameWithRand = $rand . '_' . $filename;
                unlink("../../uploads/" . $namaSebelumnya['gambar']);
                move_uploaded_file($_FILES['gambar']['tmp_name'], '../../uploads/' . $nameWithRand);
                mysqli_query($conn, "UPDATE makanan SET 
                nama = '$nama',
                harga = '$harga',
                gambar = '$nameWithRand'
                WHERE id = '$id'");
                return mysqli_affected_rows($conn);
            } else {
                return "ukuran_salah";
            }
        }
    } else {
        mysqli_query($conn, "UPDATE makanan SET 
                nama = '$nama',
                harga = '$harga',
                gambar = gambar
                WHERE id = '$id'");
        return mysqli_affected_rows($conn);
    }
}

function deleteMakanan($data)
{
    global $conn;
    $id = htmlspecialchars($data['id']);

    $namaSebelumnya = show("SELECT gambar FROM makanan WHERE id = '$id'")[0];
    unlink("../../uploads/" . $namaSebelumnya['gambar']);

    mysqli_query($conn, "DELETE FROM makanan WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

function insertPengguna($data)
{
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $level = htmlspecialchars($data['level']);

    mysqli_query($conn, "INSERT INTO pengguna (level_id,nama,username,`password`) VALUES ('$level','$nama','$username','$password')");
    return mysqli_affected_rows($conn);
}

function editPengguna($data)
{
    global $conn;
    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $level = htmlspecialchars($data['level']);

    if (empty($password)) {
        mysqli_query($conn, "UPDATE pengguna SET 
        level_id = '$level',
        nama = '$nama',
        username = '$username',
        `password` = `password`
        WHERE id = '$id'");
    } else {
        mysqli_query($conn, "UPDATE pengguna SET 
        level_id = '$level',
        nama = '$nama',
        username = '$username',
        `password` = '$password'
        WHERE id = '$id'");
    }
    return mysqli_affected_rows($conn);
}

function deletePengguna($data)
{
    global $conn;
    $id = htmlspecialchars($data['id']);

    mysqli_query($conn, "DELETE FROM pengguna WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

function insertPesanan($data)
{
    global $conn;
    $makanan_id = htmlspecialchars($data['makanan_id']);
    $jumlah = htmlspecialchars($data['jumlah']);

    if (!empty($data['pengguna'])) {
        $user = htmlspecialchars($data['pengguna']);

        mysqli_query($conn, "INSERT INTO pesanan (makanan_id,pengguna_id,jumlah_beli,tanggal_dibuat,tanggal_diubah) VALUES ('$makanan_id','$user','$jumlah',now(),now())");
        return mysqli_affected_rows($conn);
    } else {
        $user = show("SELECT id FROM pengguna WHERE username = '$_SESSION[username]'")[0];

        mysqli_query($conn, "INSERT INTO pesanan (makanan_id,pengguna_id,jumlah_beli,tanggal_dibuat,tanggal_diubah) VALUES ('$makanan_id','$user[id]','$jumlah',now(),now())");
        return mysqli_affected_rows($conn);
    }
}

function editPesanan($data)
{
    global $conn;
    $id = htmlspecialchars($data['id']);
    $makanan_id = htmlspecialchars($data['makanan_id']);
    $jumlah = htmlspecialchars($data['jumlah']);

    if (!empty($data['pengguna'])) {
        $user = htmlspecialchars($data['pengguna']);

        mysqli_query($conn, "UPDATE pesanan
        SET makanan_id = '$makanan_id',
        pengguna_id = '$user',
        jumlah_beli = '$jumlah',
        tanggal_dibuat = now(),
        tanggal_diubah = now()
        WHERE id = $id");
        return mysqli_affected_rows($conn);
    } else {
        $user = show("SELECT id FROM pengguna WHERE username = '$_SESSION[username]'")[0];

        mysqli_query($conn, "UPDATE pesanan
        SET makanan_id = '$makanan_id',
        pengguna_id = '$user[id]',
        jumlah_beli = '$jumlah',
        tanggal_dibuat = now(),
        tanggal_diubah = now()
        WHERE id = $id");
        return mysqli_affected_rows($conn);
    }
}

function insertDetail($data)
{
    global $conn;
    $pesanan_id = htmlspecialchars($data['pesanan_id']);
    $bayar = htmlspecialchars($data['bayar']);

    mysqli_query($conn, "INSERT INTO detail_pesanan (pesanan_id,bayar,tanggal_dibuat,tanggal_diubah) VALUES ('$pesanan_id','$bayar',now(),now())");
    return mysqli_affected_rows($conn);
}

function editDetail($data)
{
    global $conn;
    $id = htmlspecialchars($data['id']);
    $pesanan_id = htmlspecialchars($data['pesanan_id']);
    $bayar = htmlspecialchars($data['bayar']);

    mysqli_query($conn, "UPDATE detail_pesanan
    SET pesanan_id = '$pesanan_id',
    bayar = '$bayar',
    tanggal_dibuat = now(),
    tanggal_diubah = now()
    WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

function deletePesanan($data)
{
    global $conn;
    $id_pesanan = htmlspecialchars($data['id_pesanan']);

    mysqli_query($conn, "DELETE FROM pesanan WHERE id = '$id_pesanan'");
    return mysqli_affected_rows($conn);
}

function deleteDetail($data)
{
    global $conn;
    $id = htmlspecialchars($data['id']);

    mysqli_query($conn, "DELETE FROM detail_pesanan WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}