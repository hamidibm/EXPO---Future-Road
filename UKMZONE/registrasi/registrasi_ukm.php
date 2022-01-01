<?php 
    require '../function.php';
    
    if(isset($_POST["registrasi"])){
        
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $duplikat = "SELECT email_penjual FROM penjual WHERE email_penjual = '$email' ";
        $cek = mysqli_query($conn, $duplikat);
        $count = mysqli_num_rows($cek);

        $duplikat2 = "SELECT email_pembeli FROM pembeli WHERE email_pembeli = '$email' ";
        $cek2 = mysqli_query($conn, $duplikat2);
        $count2 = mysqli_num_rows($cek2);

        if($count > 0){
            echo "<script>
                    alert('Email ini sudah terdaftar! Silahkan Gunakan email lain');
                  </script>";
        }

        else if($count2 > 0){
            echo "<script>
                    alert('Email ini sudah terdaftar sebagai konsumen!');
                  </script>";
        }

        else{
            if(registrasiUKM($_POST) > 0){
                echo "<script>
                        alert('user baru berhasil di tambahkan!');
                        document.location.href = '../login/login.php'
                      </script>";
            }
            else{
                echo mysqli_error($conn);
            }
        }   
    }
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style_registrasi.css?v=<?php echo time(); ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, inital-scale=1.0">
        <title>Login UKMZone</title>
    </head>
    <body style="background-color:rgb(14, 124, 0)">
        <table border="0" style="background-color: Gold; border: 10px solid black;" class="regisForm">
            <tr>
                <td>
                    <h3 style="color:rgb(0, 0, 0); text-align: center;">Registrasi UKMZone</h3>
                    <br>
                    <form  method="POST" style="margin-right: auto; margin-left: auto">
						<h4 style="color:black">Email</h4>
						<input type="email" class="inputbox" style="color:black; background-color: white ;border-radius: 10px; border: solid black" name="email" placeholder="Email" required>
						<br>
                        <h4 style="color:black">Username</h4>
                        <input class="inputbox" style="color:black; background-color: white ;border-radius: 10px; border: solid black" type="text" name="username" placeholder="Masukkan Username" required>
                        <br>
                        <h4 style="color:black">Password</h4>
                        <input class="inputbox" style="color:black; background-color:white ;border-radius: 10px; border: solid black" type="password" name="password" placeholder="Masukkan Password">
                        <br>
						<h4 style="color:black">Konfirmasi Password</h4>
                        <input class="inputbox" style="color:black; background-color:white ;border-radius: 10px; border: solid black" type="password" name="password2" placeholder="Konfirmasi Password" required>
						<br>
						<h4 style="color:black">Nama Toko</h4>
						<input class="inputbox" style="color:black; background-color: white ;border-radius: 10px; border: solid black" type="text" name="toko" placeholder="Masukkan Nama Toko" required>
                        <br>
                        <h4 style="color:black">Alamat Toko</h4>
                        <input class="inputbox" style="color:black; background-color: white ;border-radius: 10px; border: solid black" type="text" name="alamat" placeholder="Masukkan Alamat Toko" required>
                        <br>
                        <h4 style="color:black">No. Telp</h4>
                        <input class="inputbox" style="color:black; background-color: white ;border-radius: 10px; border: solid black" type="text" name="nomor" placeholder="Masukkan No. Telp" required>
                        <br>
						<br>
						<center>
                        <input class="regisButton" type="submit" name="registrasi" value="Registrasi">
						</center>
                        <br>
                        <p style="color:black">Jika sudah memiliki akun klik <a style="color:rgb(14, 124, 0)" href="../login/login.php">Log in</a></p>
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>