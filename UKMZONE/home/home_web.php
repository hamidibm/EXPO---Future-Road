<?php 
    session_start();
    $email = $_SESSION["email"];
    require '../function.php';

    $keranjang = query("SELECT * FROM produk ORDER BY id_produk DESC");

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
                    document.location.href = 'home_web.php'
               </script>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>UKMZONE</title>
        <link rel="stylesheet" type="Text/css" href="style_web.css?v=<?php echo time(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <table>
            <div class="scrollmenu">
                <h1>UkmZone</h1>
                <hr>
                <a style="background-color: white; color: rgb(14, 124, 0); margin-right: -5px;" href="../home/home_web.php">Home</a>
                <a style="margin-right: 0px;" href="../keranjang/keranjang_web.php">Keranjang</a>
                <a style="margin-right: 0px;" href="../transaksi/transaksi_web.php">Transaksi</a>
                <a style="margin-right: 0px;" href="../login/login.php">Logout</a>
            </div>
            <div class="baru">
                <h2 style="color:rgb(14, 124, 0)">Produk Baru</h2>
                
                <?php foreach($keranjang as $row) : ?> 
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id"  value="<?= $row["id_produk"]; ?>">
                        <input type="hidden" name="email"  value="<?= $email; ?>">
                        <div class="list-produk">
                            <img src="../z_img/<?= $row["gambar"]; ?>">
                            
                            <h4><?= $row["nama_produk"]; ?></h4>
                            <input type="hidden" name="buah"  value="<?= $row["nama_produk"]; ?>">

                            <h5><?= $row["harga_produk"]; ?></h5>
                            <input type="hidden" name="harga"  value="<?= $row["harga_produk"]; ?>">
                        
                            <a href="../detail/detail_web.php?id=<?= $row["id_produk"]; ?>" class="tombol tombol-detail">Detail</a>
                            <button type="submit" name="beli" class="tombol tombol-beli">Add</button>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </table>
    </body>

    <footer class="kaki" style="margin-top:7.9vw"> 
        <p> &copy;Copyright UKM Zone</p>
    </footer>
    
</html>