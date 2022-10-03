
<?php 
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $produk = mysqli_query($conn, "SELECT * FROM tb_produk WHERE produk_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($produk) == 0){
        echo '<script>window.location="data-produk.php"</script>';
    }
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
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
</head>
<body background="img/demon.png">
    <!--header-->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">AnimStore</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <!--content-->
    <div class="section">
        <div class="container">
            <h3><span style="color: white;">Edit Data Produk</span></h3>
            <div class="box">
               <form action="" method="POST" enctype="multipart/form-data">
                   <select name="kategori" id="" class="input-control" required>
                       <option value="">--Choose--</option>
                       <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori_id DESC");
                            while($r = mysqli_fetch_array($kategori)){


                        ?>
                         <option value="<?php echo $r['kategori_id'] ?>" <?php echo ($r['kategori_id'] == $p->kategori_id)? 'selected':''; ?>><?php echo $r['kategori_nama'] ?></option>
                        <?php } ?>
                   </select>
                   <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->produk_nama ?>" required>
                   <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->produk_price ?>" required>

                   <img src="img/<?php echo $p->produk_image ?>" width="100px" alt="">
                   <input type="hidden" name="foto" value="<?php echo $p->produk_image ?>" id="">
                   <input type="file" name="gambar" class="input-control">
                   <textarea name="deskripsi" class="input-control" placeholder="Deskripsi"<?php echo $p->produk_description ?>></textarea><br>
                   <select class="input-control" name="status">
                        <option value="">--Choose--</option>
                        <option value="1" <?php echo ($p->produk_status == 1)? 'selected':''; ?>>Aktif</option>
                        <option value="0" <?php echo ($p->produk_status == 0)? 'selected':''; ?>>Tidak Aktif</option>
                   </select>
                   <input type="submit" name="submit" value="Submit" class="btn">
               </form>
               <?php
                    if(isset($_POST['submit'])){
                       //data inputan dari form
                       $kategori   = $_POST['kategori'];
                       $nama       = $_POST['nama'];
                       $harga      = $_POST['harga'];
                       $deskripsi  = $_POST['deskripsi'];
                       $status     = $_POST['status'];
                       $foto       = $_POST['foto'];
                       //dta gamaar yang baru
                       $filename = $_FILES['gambar']['name'];
                       $tmp_name = $_FILES['gambar']['tmp_name'];

                       $type1 = explode('.', $filename);
                       $type2 = $type1[1];

                       $newname = 'img'.time().'.'.$type2;

                        //menampung data format data file yang diizinkan
                        $tipe_diizinkan = array('jpg','jpeg', 'png', 'gif');

                       //jika admin ganti gambar
                        if($filename != ''){
                            //validasi format file
                            if(!in_array($type2, $tipe_diizinkan)){
                                //jika format file tidak ada didalam tipe diizinkan
                                echo '<script>alert("Format tidak diizinkan")</script>';
                            }else{ 
                                unlink('./img/'.$foto);
                                move_uploaded_file($tmp_name, './img/'. $newname);
                                $namagambar = $newname;
                            }

                        }else{
                            //jika admin tidak ganti gambar
                            $namagambar = $foto;
                        }
                       
                        //query update data produk
                        $update = mysqli_query($conn, "UPDATE tb_produk SET
                                   kategori_id = '".$kategori."',
                                   produk_nama = '".$nama."',
                                   produk_price = '".$harga."',
                                   produk_description = '".$deskripsi."',
                                   produk_image = '".$namagambar."',
                                   produk_status = '".$status."'
                                   WHERE produk_id = '".$p->produk_id."' ");

                        if($update){
                            echo '<script>alert("Add data Success")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                        }else{
                            echo 'Failed'.mysqli_error($conn);
                        }
                    } 
                ?>
            </div>
        </div>
    </div>

    <!--footer-->
    <footer>
        <div class="container">
            <small><span style="color: white;">CoppyRight &copy; 2021 - AnimStore</span></small>
        </div>
    </footer>
    <script>
            CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>