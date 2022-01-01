<?php
    session_start();
    require '../function.php';
    $email = $_SESSION["email"];
    
    $data = query("SELECT * FROM produk a 
                    JOIN dibeli b ON a.id_produk = b.id_produk 
                    WHERE a.email_penjual = '$email'
                    ORDER BY a.id_produk DESC");    

    $toko = query("SELECT toko FROM penjual WHERE email_penjual = '$email'")[0]; 
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style_ukm.css?v=<?php echo time(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="scrollmenu">
            <h1>UkmZone</h1>
            <hr>
             <a href="../home/home_ukm.php">Home</a>
             <a href="../upload/upload_ukm.php">Upload</a>
             <a style="background-color: white; color: rgb(14, 124, 0);margin-right: -5px;margin-left: -5px;" href="../transaksi/transaksi_ukm.php">Transaksi</a>
             <a style="margin-right: 0px;" href="../login/login.php">Logout</a>
        </div>

        <div class="keranjang" align="center">
            <br>
            <h2>Status Barang</h2>
            <?php foreach($data as $row) : ?>
                <table class="tabel" border="0">
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
                                        <button type="submit" name="update" class="uploadButton"> <?= $row["status"]; ?></button>                                    </p>
                                </strong>
                            </form>  
                        </td>
                    </tr>
                </table>
            <?php endforeach; ?>
        </div> 
    </body>
    <footer class="kaki" style="margin-top:5vw"> 
        <p> &copy;Copyright UKM Zone</p>
    </footer>
</html>