<!DOCTYPE html>
<html>
    <head>
        <title>Halaman Pembayaran</title>
        <link rel="stylesheet" type="text/css" href="style_bayar.css?v=<?php echo time(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="scrollmenu">
           <h1>UkmZone</h1> 
       </div>
           <hr>
           <h2>Pilihan Bayar:</h2><br><br>
           <select name="Pembayaran" id="Pembayaran" required>
               <option value="">Pilih metode pembayaran</option>
               <option value="ovo">Ovo</option>
               <option value="gopay">Gopay</option>
               <option value="dana">Dana</option>
           </select>
           <br><br><br><br>
           <h2>Pilihan Bayar:</h2><br><br>
           <select name="kurir" id="kurir" required>
            <option value="">Pilih Jasa Kurir</option>
            <option value="pos">POS Indonesia</option>
            <option value="jne">JNE</option>
            <option value="tiki">TIKI</option>
            <option value="wahana">Gojek</option>
          </select>
          <br><br><br>
          <a href="Proses_web.html"><button>Proses</button></a>
          <br>
        </body>
        <footer class="kaki">
            <p> &copy;Copyright UKM Zone</p>
        </footer>
 </html>