<?php 
	session_start();
    require '../function.php';
    $id = $_GET["id"];
	$email = $_SESSION["email"];

    $data = query("SELECT * FROM produk a 
				JOIN penjual b ON a.email_penjual = b.email_penjual
				WHERE id_produk = $id")[0];


	if(isset($_POST["beli"])){
        $id = mysqli_real_escape_string($conn, $_POST["id"]);
        $duplikat = "SELECT id_produk FROM dibeli WHERE id_produk = '$id' ";
        $cek = mysqli_query($conn, $duplikat);
        $count = mysqli_num_rows($cek);

        if($count > 0){
            echo "<script>
                    alert('Gagal ditambahkan, barang sudah di keranjang');
                  </script>";
        }

        else if(beli($_POST) > 0){
            echo "<script>
                    alert('Berhasil ditambah ke keranjang');           
               </script>";
        }
        else{
            echo "<script>
                    alert('Gagal ditambah ke keranjang');
                    document.location.href = 'detail_web.php?id=$id'
               </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detail Barang</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style_web.css?v=<?php echo time(); ?>">
</head>
<body>
	<div class="scrollmenu">
		<h1>UkmZone</h1>
		<hr>
		<a style="margin-right: -5px;" href="../home/home_web.php">Home</a>
		<a style="margin-right: 0px;" href="../keranjang/keranjang_web.php">Keranjang</a>
		<a style="margin-right: 0px;" href="../transaksi/transaksi_web.php">Transaksi</a>
		<a style="margin-right: 0px;" href="../login/login.php">Logout</a>
	</div>

	<form method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id"  value="<?= $data["id_produk"]; ?>">

		
		<div class="left">
			<img class="img" src="../z_img/<?= $data["gambar"]; ?>"  style="width: 230px; height: 180px;">
		</div>
		
		<div class="middle">
			<h1 class="namaBarang"> <?= $data["nama_produk"]; ?> </h1>
		
			<div class="hargaBarang">
				<?= $data["harga_produk"]; ?>
			</div>

			<br>
			<br>
			<input type="submit" name="beli" value="Add" name="proses" class="tombol tombol-beli">
			
			<div class="detailBarang">
				<p>Warung <?= $data["toko"]; ?></p>
				<?= $data["username"]; ?>

				<p>No. HP</p>
				<?= $data["no_penjual"]; ?>

				<p>Alamat</p>
				<?= $data["alamat_penjual"]; ?>

				<p style="margin-top: 50px; font-size: 25px;">Informasi Produk</p>
				<?= $data["detail_produk"]; ?>
			</div>
		</div>
	</form>

	<footer class="kaki"> 
		<p> &copy;Copyright UKM Zone</p>
	</footer>
	</body>
</html>