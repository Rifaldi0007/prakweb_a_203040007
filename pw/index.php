<?php
    include 'db.php';
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
<body background="img/demon.png">
    <!--header-->
    <header>
        <div class="container">
            <h1><a href="index.php">AnimStore</a></h1>
            <ul>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="login.php">Login</a></li>
       
            </ul>
        </div>
    </header>

    <!--Search-->
    <div class="search">
        <div class="container">
            <form action="produk.php" method="GET">
                <input type="text" name="search" placeholder="Search Produk">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!--Category-->
    <div class="section">
        <div class="container">
            <h3><span style="color: white;">Kategori</span></h3>
            <div class="box">
                <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY 
                            kategori_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                    
                 ?>
                    <a href="produk.php?kat=<?php echo $k['kategori_id'] ?>">
                    <div class="col-5">
                        <img src="img/icon.png" width="50px" style="margin-bottom:5px;" >
                        <p><?php echo $k['kategori_nama'] ?></p>
                    </div>
                    </a>
                <?php }}else{ ?>
                    <p>No Kategori</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!--new produk-->
    <div class="section">
        <div class="container">
            <h3><span style="color: white;">News Produk</span></h3>
            <div class="box">
                <?php
                    $produk = mysqli_query($conn, "SELECT * FROM tb_produk WHERE produk_status = 1 ORDER BY produk_id DESC
                         LIMIT 8");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                 ?>
                    <a href="detail-produk.php?id=<?php echo $p['produk_id'] ?>">
                        <div class="col-4">
                            <img src="img/<?php echo $p['produk_image'] ?>" alt="">
                            <p class="nama"><?php echo substr( $p['produk_nama'], 0, 30) ?></p>
                            <p class="harga">IDR. <?php echo number_format( $p['produk_price']) ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>No Produk</p>
                <?php } ?>
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