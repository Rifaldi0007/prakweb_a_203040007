<?php 
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."'");
    $d = mysqli_fetch_object($query);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/style.css">
    <title>BookStore</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body background="img/anim2.png">
    <!--header-->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">BookStore</a></h1>
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
            <h3>Profil</h3>
            <div class="box">
               <form action="" method="POST">
                   <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
                   <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                   <input type="text" name="hp" placeholder="No hp" class="input-control" value="<?php echo $d->admin_telp ?>" required>
                   <input type="text" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
                   <input type="text" name="address" placeholder="Address" class="input-control" value="<?php echo $d->admin_address ?>" required>
                   <input type="submit" name="submit" value="Ubah Profil" class="btn">
               </form>
               <?php 
                    if(isset($_POST['submit'])){
                        $nama       = ucwords($_POST['nama']);
                        $user       = $_POST['user'];
                        $hp         = $_POST['hp'];
                        $email      = $_POST['email'];
                        $address    = ucwords($_POST['address']);

                        $update = mysqli_query($conn, "UPDATE tb_admin SET 
                                  admin_name = '".$nama."',
                                  username = '".$user."',
                                  admin_telp = '".$hp."', 
                                  admin_email = '".$email."',
                                  admin_address = '".$address."'
                                  WHERE admin_id = '".$d->admin_id."' ");
                        if($update){
                            echo '<script>alert("Update data Success")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        }else{
                            echo 'Failed'.mysqli_error($conn);
                        }
                    }
                ?>
            </div>

            <h3>Change Password</h3>
            <div class="box">
               <form action="" method="POST">
                   <input type="password" name="pass1" placeholder="New password" class="input-control" required>
                   <input type="password" name="pass2" placeholder="confirm password" class="input-control" required>
                   <input type="submit" name="change_password" value="change password" class="btn">
               </form>
               <?php 
                    if(isset($_POST['change_password'])){
                        
                        $pass1      = $_POST['pass1'];
                        $pass2       = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("new confirm password not same")</script>';
                        }else{
                            $u_pass = mysqli_query($conn, "UPDATE tb_admin SET 

                            password = '".MD5($pass1)."'
                            WHERE admin_id = '".$d->admin_id."' ");
                            if($u_pass){
                                echo '<script>alert("Update data Success")</script>';
                                echo '<script>window.location="profil.php"</script>';
                            }else{
                                echo 'failed'.mysqli_error($conn);
                            }
                        }
                       
                    }
                ?>
            </div>
        </div>
    </div>

    <!--footer-->
    <footer>
        <div class="container">
            <small>CoppyRight &copy; 2021 - BookStore</small>
        </div>
    </footer>
</body>
</html>