<?php
    session_start();
    require '../function.php';
    $email = $_SESSION["email"];
    
    $data = query("SELECT * FROM dibeli d 
                    JOIN produk p ON d.id_produk = p.id_produk 
                    WHERE a.email_penjual = '$email'
                    ORDER BY a.id_produk DESC");    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style_web.css?v=<?php echo time(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="scrollmenu">
            <h1>UkmZone</h1>
            <hr>
             <a href="../home/home_web.php">Home</a>
             <a href="../keranjang/keranjang_web.php">Keranjang</a>
             <a style="background-color: white; color: rgb(14, 124, 0);margin-right: -5px;margin-left: -5px;" href="../transaksi/transaksi_web.php">Transaksi</a>
             <a style="margin-right: 0px;" href="../login/login.php">Logout</a>
        </div>

        <div class="keranjang" align="center">
            <br>
            <h2>Status Barang</h2>

                <table class="tabel" border="0">
                    <tr>
                        <td>
                            <form method="POST" enctype="multipart/form-data" style="margin-right: auto; margin-left: auto">
                                <input type="hidden" name="id"  value="<?= $row["id_pembelian"];?>">
                                <img src="../z_img/download (14).jpg" width="200" height="150"> 
                                <strong>
                                    <p> 
                                        Belimbing
                                        <br>
                                        Rp. 12.000

                                        <br>
                                        <br>
                                        <button type="submit" name="update" class="uploadButton"> Sedang Dikirim</button>                                    </p>
                                </strong>
                            </form>  
                        </td>
                    </tr>
                </table>
        </div> 
    </body>
    <footer class="kaki" style="margin-top:5vw"> 
        <p> &copy;Copyright UKM Zone</p>
    </footer>
</html>