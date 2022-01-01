<?php 
    session_start();
    require '../function.php';
    
    if(isset($_POST["login"])){
        
        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM penjual WHERE
                                email_penjual = '$email' ");
        $result2 = mysqli_query($conn, "SELECT * FROM pembeli WHERE
                                email_pembeli = '$email' ");

        if($email != null){
            $row = mysqli_fetch_assoc($result);
            $row2 = mysqli_fetch_assoc($result2);

            if(password_verify($password, $row["password_penjual"])){
                $_SESSION["email"] = $email;
                header("Location: ../home/home_ukm.php");
                exit;
            }

            else if(password_verify($password, $row2["password_pembeli"])){
                $_SESSION["email"] = $email;
                header("Location: ../home/home_web.php");
                exit;
            }

            else{
                echo "<script>
                    alert('Password salah');
                    document.location.href = '../login/login.php'
                  </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style_login.css?v=<?php echo time(); ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, inital-scale=1.0">
        <title>Login UKMZone</title>
    </head>

    <body class="body" style="background-color:#0085FF">
        <table border="0" style="background-color: rgb(14, 124, 0); border: 10px solid white;" class="loginForm">
            <tr>
                <td>
                    <img src="../z_img/img_logo.png" width="250" height="250" class="logo">
                    <h3 style="color:white; text-align: center; margin: 0px;">Login UKMzone</h3>
                    <br>
                    <form method="POST" style="margin-right: auto; margin-left: auto">
                        <h4 style="margin: 0px;">Email</h4>
                        <input class="inputbox" type="text" name="email" placeholder="Masukkan Email" required>    
                        <br>
                        <br>
                        <h4 style="margin: 0px;">Password</h4>
                        <input class="inputbox" type="password" name="password" placeholder="Masukkan Password" required>
                        <br>
                        <br>

                        <center>
                            <input class="loginButton" type="submit" name="login" value="Login">
                        </center>
                        <br>
                        <p style="color:white">Jika belum memiliki akun klik 
                            <a style="color:yellow" href="../registrasi/registrasi.php">daftar</a>
                        </p>
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>