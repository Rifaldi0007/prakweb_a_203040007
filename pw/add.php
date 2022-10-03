
<?php 
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
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
<body background="img/anim3.png">
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
            <h3>Add Categori</h3>
            <div class="box">
               <form action="" method="POST">
                   <input type="text" name="nama" placeholder="Nama kategori" class="input-control" required>
                   <input type="submit" name="submit" value="Submit" class="btn">
               </form>
               <?php
                    if(isset($_POST['submit'])){
                        $nama = ucwords($_POST['nama']);

                        $insert = mysqli_query($conn, "INSERT INTO tb_kategori VALUES (
                            null,
                            '".$nama."') ");
                        if($insert){
                            echo '<script>alert("Add Data success")</script>';
                            echo '<script>window.location="data-kategori.php"</script>';
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
            <small>CoppyRight &copy; 2021 - AnimStore</small>
        </div>
    </footer>
</body>
</html>