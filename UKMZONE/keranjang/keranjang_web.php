<?php 
    session_start();
    $email = $_SESSION["email"];
    require '../function.php';
    
    $data = query("SELECT * FROM dibeli b
                    JOIN produk p ON b.id_produk = p.id_produk
                    JOIN penjual j ON j.email_penjual = p.email_penjual
                    WHERE b.email_pembeli = '$email'
                    "); 

    if(isset($_POST["hapus"])){
        $id = mysqli_real_escape_string($conn, $_POST["id"]);
        if(hapusBarang($id) > 0){
            echo "<script>
                    alert('Berhasil menghapus keranjang');
                    document.location.href = 'keranjang_web.php'
            </script>";
        }
        else{
            echo "<script>
                    alert('Gagal menghapus keranjang');
                    document.location.href = 'keranjang_web.php'
            </script>";
        }
    }

    if(isset($_POST["beli"])){
        $id = mysqli_real_escape_string($conn, $_POST["id"]);
        if(hapusBarang($id) > 0){
            echo "<script>
                    alert('Terimakasih atas pembeliannya, pengiriman akan diproses');
                    document.location.href = 'keranjang_web.php'
            </script>";
        }
        else{
            echo "<script>
                    alert('Gagal membeli barang');
                    document.location.href = 'keranjang_web.php'
            </script>";
        }
    }
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Keranjang Belanja</title>
        <link rel="stylesheet" type="text/css" href="style_web.css?v=<?php echo time(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <div class="scrollmenu">
            <h1>UkmZone</h1>
            <hr>
            <a style="margin-right: -5px;" href="../home/home_web.php">Home</a>
            <a style="background-color: white; color: rgb(14, 124, 0); margin-right: -5px;" href="../keranjang/keranjang_web.php">Keranjang</a>
            <a style="margin-right: 0px;" href="../transaksi/transaksi_web.php">Transaksi</a>
            <a style="margin-right: 0px;" href="../login/login.php">Logout</a>
        </div>

        <div class="keranjang" align="center">
            <table class="tabel" border="0">
                <?php foreach($data as $row) : ?>
                    <tr>
                        <td>
                            <form method="POST" enctype="multipart/form-data" style="margin-right: auto; margin-left: auto">
                                <input type="hidden" name="id"  value="<?= $row["id_pembelian"];?>">
                                <img src="../z_img/<?= $row["gambar"]; ?>" width="200" height="150"> 
                                <strong>
                                    <p> 
                                        <?= $row["nama_produk"]; ?>
                                        <br> <?= $row["harga_produk"]; ?>

                                        <br>
                                        <br>
                                        <button type="submit" name="beli" class="uploadButton">Beli</button>
                                        <button type="submit" name="hapus" class="uploadButton2">Hapus</button>
                                    </p>
                                </strong>
                            </form>  
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div> 
    </body>
    
    <footer class="kaki" style="margin-top:5vw"> 
        <p> &copy;Copyright UKM Zone</p>
    </footer>
</html>