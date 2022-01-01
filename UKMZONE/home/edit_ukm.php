<?php 
    require '../function.php';
    $id = $_GET["id"];
    $data = query("SELECT * FROM produk WHERE id_produk = $id")[0];

    if(isset($_POST["update"])){
        if(update($_POST) > 0){
            echo "<script>
                    alert('Berhasil mengupdate data');
                    document.location.href = 'home_ukm.php'
               </script>";
        }
        else{
            echo "<script>
                    alert('Tidak ada perubahan data');
                    document.location.href = 'home_ukm.php'
               </script>";
        }
    }

    if(isset($_POST["hapus"])){
        if(hapus($id) > 0){
            $gambar = $data["gambar"];
            if(file_exists("../z_img/$gambar")){
                unlink("../z_img/$gambar");
            }
            echo "<script>
                    alert('Berhasil menghapus data');
                    document.location.href = 'home_ukm.php'
               </script>";
        }
        else{
            echo "<script>
                    alert('Gagal menghapus data');
                    document.location.href = 'home_ukm.php'
               </script>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Upload</title>
        <link rel="stylesheet" type="Text/css" href="../upload/style_ukm.css?v=<?php echo time(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <table>
            <div class="scrollmenu">
                <h1>UkmZone</h1>
                <hr>
                <a style="margin-right: 0px;" href="../home/home_ukm.php">Home</a>
                <a style="margin-right: 0px;" href="../upload/upload_ukm.php">Upload</a>
                <a style="margin-right: 0px;" href="../transaksi/transaksi_ukm.php">Transaksi</a>
                <a style="margin-right: 0px;" href="../login/login.php">Logout</a>
            </div>
            <div>
                <table border="0" style="background-color: Gold; border: 5px solid black;" class="upload">
                    <tr>
                        <td>
                            <h3 style="color:rgb(0, 0, 0); text-align: center;">Ubah Data Dagangan</h3>
                            <br>
                            <form method="POST" enctype="multipart/form-data" style="margin-right: auto; margin-left: auto">
                                <input type="hidden" name="id"  value="<?= $data["id_produk"]; ?>">
                                <input type="hidden" name="gambarLama"  value="<?= $data["gambar"]; ?>">

                                <h4 style="color:black;margin-top:10px;">Nama Buah</h4>
                                <input class="inputbox" style="color:black; background-color: white ;border-radius: 10px; border: solid black" 
                                    type="text" name="buah" value="<?= $data["nama_produk"]; ?>" required>
                                <br>

                                <h4 style="color:black; margin-top:10px;">Upload Foto</h4>
                                <input class="inputfoto" style="color:black; background-color:white ;border-radius: 10px; border: solid black" 
                                    type="file" name="gambar">
                                <br>
                                <br>
                                <img src="../z_img/<?= $data["gambar"]; ?>" width="250" height="200">
                                <br>

                                <h4 style="color:black;margin-top:10px;">Harga</h4>
                                <input id="rupiah" class="inputbox" style="color:black; background-color:white ;border-radius: 10px; border: solid black" 
                                    type="text" name="harga" value="<?= $data["harga_produk"]; ?>" required>
                                <br>

                                <h4 style="color:black;margin-top:10px;">Detail</h4>
                                <textarea name="detail" cols="40" rows="5" required><?php echo $data["detail_produk"]; ?></textarea>
                                <br>
                                <br>
                                
                                <center>
                                    <button type="submit" name="update" class="uploadButton">Update</button>
                                    <button type="submit" name="hapus" class="uploadButton" style="background:rgb(168, 6, 0); border-bottom: 5px solid rgb(105, 4, 0);">Hapus</button>
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
