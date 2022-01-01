<?php 
    session_start();
    require '../function.php';
    $email = $_SESSION["email"];
    $data = query("SELECT * FROM penjual WHERE email_penjual = '$email'")[0];

    if(isset($_POST["upload"])){
        if(upload($_POST) > 0){
            echo "<script>
                    alert('Berhasil menambahkan barang');
               </script>";
        }
        else{
            echo "<script>
                    alert('Gagal menambahkan barang');
               </script>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Upload</title>
        <link rel="stylesheet" type="Text/css" href="style_ukm.css?v=<?php echo time(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <table>
            <div class="scrollmenu">
                <h1>UkmZone</h1>
                <hr>
                <a style="margin-right: 0px;" href="../home/home_ukm.php">Home</a>
                <a style="background-color: white; color: rgb(14, 124, 0);margin-right: -5px;margin-left: -5px;" href="../upload/upload_ukm.php">Upload</a>
                <a style="margin-right: 0px;" href="../transaksi/transaksi_ukm.php">Transaksi</a>
                <a style="margin-right: 0px;" href="../login/login.php">Logout</a>
            </div>
            
            <div>
                <table border="0" style="background-color: Gold; border: 5px solid black;" class="upload">
                    <tr>
                        <td>
                            <h3 style="color:rgb(0, 0, 0); text-align: center;">Upload Dagangan Buah</h3>
                            <br>
                            <form method="POST" enctype="multipart/form-data" style="margin-right: auto; margin-left: auto">
                                <input type="hidden" name="email"  value="<?= $email ?>">
                                <h4 style="color:black;margin-top:10px;">Nama Buah</h4>
                                <input type="text" class="inputbox" style="color:black; background-color: white ;border-radius: 10px; border: solid black" name="buah" placeholder="  Nama Buah" required>
                                <br>
                                <h4 style="color:black; margin-top:10px;">Upload Foto</h4>
                                <input class="inputfoto" style="color:black; background-color:white ;border-radius: 10px; border: solid black" type="file" name="gambar" placeholder="Upload" required>
                                <br>
                                <h4 style="color:black;margin-top:10px;">Harga</h4>
                                <input id="rupiah" class="inputbox" style="color:black; background-color:white ;border-radius: 10px; border: solid black" type="text" name="harga" placeholder="  Harga" required>
                                <br>
                                <h4 style="color:black;margin-top:10px;">Detail</h4>
                                <textarea name="detail" cols="40" rows="5" placeholder="  Masukkan Detail Buah" required></textarea>
                                <br>
                                <br>
                                <center>
                                <input class="uploadButton" type="submit" name="upload" value="Upload">
                                </center>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </table>
        <script src="../java.js"></script>
        </body>

        <footer class="kaki" style="margin-top:12vw"> 
            <p> &copy;Copyright UKM Zone</p>
        </footer>
</html>