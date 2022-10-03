<?php
    error_reporting(0);
    include 'db.php';

    $produk = mysqli_query($conn, "SELECT * FROM tb_produk WHERE produk_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/style.css">
    <title>AnimStore</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body background="img/demon2.png">
    <!--header-->
    <header>
        <div class="container">
            <h1><a href="index.php">AnimStore</a></h1>
            <ul>
                <li><a href="produk.php">Produk</a></li>
       
            </ul>
        </div>
    </header>

    <!--Search-->
    <div class="search">
        <div class="container">
            <form action="produk.php" method="GET">
                <input type="text" name="search" placeholder="Search Produk" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" id="">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!--produk detail-->
    <div class="section">
        <div class="container">
            <h3><span style="color: white;">Detail Produk</span></h3>
            <div class="box">
                <div class="col-2">
                    <img src="img/<?php echo $p->produk_image ?>"  alt="">
                </div>
                <div class="col-2">
                    <h3><?php echo $p->produk_nama ?></h3><br>
                    <p>Deskripsi : 
                        <?php echo $p->produk_description ?>
                    </p><br>
                    <h4>IDR. <?php echo number_format($p->produk_price)  ?></h4>
                    <p><a href="https://api.whatsapp.com/send?phone=+6281224381371&text=I want order this tape." target="_blank">
                        Order 
                        <img src="img/wa.png" width="50px" alt=""></a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!--footer-->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p>Jl,Bandung Raya</p>

            <h4>Email</h4>
            <p>rifaldia513.com</p>

            <h4>Instagram</h4>
            <p>@AnimStore666</p>

            <small><span style="color: white;">Coppyright &copy; 2021 - AnimStore</span></small>
        </div>
    </div>
</body>
</html>