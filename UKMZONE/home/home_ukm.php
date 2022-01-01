<?php
    session_start();
    $email = $_SESSION["email"];
    require '../function.php';
    
    $data = query("SELECT * FROM produk
                    WHERE email_penjual = '$email'
                    ORDER BY id_produk DESC");  

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
        <table>
            <div class="scrollmenu">
                <h1>UkmZone</h1>
                <hr>
                <a style="background-color: white; color: rgb(14, 124, 0); margin-right: -5px;" href="../home/home_ukm.php">Home</a>
                <a style="margin-right: 0px;" href="../upload/upload_ukm.php">Upload</a>
                <a style="margin-right: 0px;" href="../transaksi/transaksi_ukm.php">Transaksi</a>
                <a style="margin-right: 0px;" href="../login/login.php">Logout</a>
            </div>
            <div class="baru">
                <h2 style="color:rgb(14, 124, 0)">Warung <?= $toko["toko"]; ?></h2>
                
                <?php foreach($data as $row) : ?> 
                    <div class="list-produk">
                        <img src="../z_img/<?= $row["gambar"]; ?>" width="250" height="200">
            
                        <h4><?= $row["nama_produk"]; ?></h4>
                        <h5><?= $row["harga_produk"]; ?></h5>

                        <center>
                            <a class="tombol tombol-detail" href="edit_ukm.php?id=<?= $row["id_produk"]; ?>">Edit</a> 
                        </center>
                    </div>
                <?php endforeach; ?>
            </div>
        </table>
    </body>
    <footer class="kaki" style="margin-top:7.9vw"> 
        <p> &copy;Copyright UKM Zone</p>
    </footer>
</html>