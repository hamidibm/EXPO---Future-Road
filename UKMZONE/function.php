<?php 
    $conn = mysqli_connect("localhost", "root", "", "db_expo");

    //fungsi ambil data dari tabel apa => Ambil pakai assoc atau array(?)

    // **************************************************************
    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];

        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function rupiah($angka){
        $rupiah = "Rp " . number_format($angka,2,',','.');
        return $rupiah;
    }

    // ************************************************************* //

    // ========== 1. Registrasi UKM ========== //
    
    function registrasiUKM($data){
        global $conn;

        $email = htmlspecialchars(strtolower($data["email"]));
        $username = htmlspecialchars(stripslashes(ucwords($data["username"])));
        $password = htmlspecialchars(mysqli_real_escape_string($conn, $data["password"]));
        $password2 = htmlspecialchars(mysqli_real_escape_string($conn, $data["password2"]));
        $toko = htmlspecialchars(ucwords($data["toko"]));
        $nomor = htmlspecialchars($data["nomor"]);
        $alamat = htmlspecialchars($data["alamat"]);

        if($password !== $password2){
            echo "<script>
                    alert('Konfirmasi password tidak sesuai');
                  </script>";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO penjual VALUES ('$email', '$username', '$password', '$toko', '$nomor', '$alamat')";
        mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);
    }


    // ========== 2. Registrasi Konsumen ========== //
    function registrasiKonsumen($data){
        global $conn;

        $email = htmlspecialchars(strtolower($data["email"]));
        $username = htmlspecialchars(stripslashes(ucwords($data["username"])));
        $password = htmlspecialchars(mysqli_real_escape_string($conn, $data["password"]));
        $password2 = htmlspecialchars(mysqli_real_escape_string($conn, $data["password2"]));
        $nomor = htmlspecialchars($data["nomor"]);
        $alamat = htmlspecialchars($data["alamat"]);

        if($password !== $password2){
            echo "<script>
                    alert('Konfirmasi password tidak sesuai');
                  </script>";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO pembeli VALUES ('$email', '$username', '$password', '$nomor', '$alamat')";
        mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);
    }
    

    // ========== 3. Create Data (CRUD) ========== //
    function upload($data){
        global $conn;

        $buah = htmlspecialchars(ucwords($data["buah"]));
        $detail = htmlspecialchars($data["detail"]);
        $harga = htmlspecialchars($data["harga"]);
        $email = $data["email"];

        //upload gambar
        $gambar = uploadImg();
        if( !$gambar){
            return false;
        }

        $query =  "INSERT INTO produk VALUES ('', '$buah', '$detail', '$harga', '$email', '$gambar')";
        mysqli_query($conn,$query);
        
        return mysqli_affected_rows($conn);
    }

    function uploadImg(){
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        //cek ada gambar atau tidak --> udah pakai required tapi :( 
        if($error === 4){
            echo "<script>
                    alert('Gambar belum dipilih');
                  </script>";
            return false;
        }

        //cek eksstensi file
        $tipe = ['jpg', 'jpeg', 'png', 'jfif'];
        $ekstensi = explode('.', $namaFile);
        $ekstensi = strtolower(end($ekstensi));

        if( !in_array($ekstensi, $tipe)){
            echo "<script>
                    alert('File yang diupload bukan gambar');
                  </script>";
            return false;
        }

        //ukuran file gambar
        if($ukuranFile > 10_000_000){
            echo "<script>
                    alert('Ukuran gambar max 10 mb');
                  </script>";
            return false;
        }

        // lolos pengecekkan, siap dikirim ke DB
        // generate nama, mencegah nama sama
        $namaBaru = uniqid() . "." . $ekstensi;
        move_uploaded_file($tmpName, '../z_img/' . $namaBaru);
        return $namaBaru;
    }


    // ========== 4. Update Data (CRUD) ========== //
    function update($data){
        global $conn;

        $id = $data["id"];
        $buah = htmlspecialchars(ucwords($data["buah"]));
        $detail = htmlspecialchars($data["detail"]);
        $harga = htmlspecialchars($data["harga"]);
        $gambarLama = htmlspecialchars($data["gambarLama"]);
        $gambar = htmlspecialchars($data["gambar"]);
        //$ukm = htmlspecialchars($data["ukm"]);

        // cek apakah user ganti gambar
        
        if( $_FILES['gambar']['error']){
            $gambar = $gambarLama;
        }
        else{
            $gambar = uploadImg();
        }

        $query =  "UPDATE produk SET
                        nama_produk = '$buah',
                        detail_produk = '$detail',
                        harga_produk = '$harga',
                        gambar = '$gambar'
                    WHERE id_produk = $id
                ";
        mysqli_query($conn,$query);
        
        return mysqli_affected_rows($conn);
    }


    // ========== 5. Delete Data (CRUD) ========== //
    function hapus($id){
        global $conn;

        $query =  "DELETE FROM produk WHERE id_produk = $id";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
    }


    // ========== 6. Beli Barang ========== //
    function beli($data){
        global $conn;

        $email = $data["email"];
        $date = date('l, d M Y');
        $id = htmlspecialchars(ucwords($data["id"]));
        $status = "Menunggu Pembayaran";

        $query =  "INSERT INTO dibeli VALUES ('', '$email', '$date', '$id', '$status')";
        mysqli_query($conn,$query);
        
        return mysqli_affected_rows($conn);
    }

    // ========== 7. Delete Barang dibeli ========== //
    function hapusBarang($id){
        global $conn;

        $query =  "DELETE FROM dibeli WHERE id_pembelian = $id";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
    }
?>