<?php
session_start();
$servername = "localhost";
$username = "dADWADAd"; 
$password = "ORADJAWla"; 
$db = "fadaad";

$conn = new mysqli( $servername, $username,$password, $db);            
if( $conn->connect_error) {
    die("Ошбка:Не удалось подрубиться " . $conn->connect_error);
}                                                                               
$conn->select_db( $db);

if($result = $conn->query('Select * FROM admins')) { $check = mysqli_fetch_array($result); }

if($_POST['login'] || $_POST['password'] !== $check) { 
echo "Неверный логин или пароль";
 } else { echo "ok";  }
echo $_POST['login'];
echo $_POST['password'];
if($result2 = $conn->query('Select `id` FROM admins WHERE `username` = "'.$_POST['login'].'" AND `password` = "'.$_POST['password'].'"')) { $data = mysqli_fetch_array($result2); }
if($data !== NULL) { $_SESSION['admin'] = true; $_SESSION['admin_name'] = $_POST['login']; header("Location: admin.php"); }

?>
<form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="commentid1" value=""></input>
            <div class="checkform">   
                <p><label>Login:</label> <input type="text" size="30" name="login" value="" required> </p>
		<p><label>password:</label> <input type="text" size="30" name="password" value="" required> </p>
                <p> <input type="submit" name="submit" value="Enter"></input></p>       
                            </div>
        </form>
