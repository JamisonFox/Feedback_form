<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html lang="ru">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Project</title>
</head>
<body>
    <footer>    
        <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="commentid" value=""></input>
            <div class="form">   
                <p><label>имя* :</label> <input type="text" size="30" name="username" value="" required> </p>
                <p> <label>email* :</label> <input type="text" size="30" name="email" value="" required> </p>
                <p> <label>phone* :</label> <input type="text" size="30" name="phone_number" value="" required> </p>
                <p> <label>сообщение* :</label> </p>
                <p> <textarea id="commentidd" rows="5" cols="40" name="comment" required> </textarea> </p>
                <p> <input type="submit" name="submit" value="Отправить сообщение"></input> </p>
            </div>
        </form>
    </footer>   
</body>
</html>

<?php
session_start();
$servername = "localhost";
$username = "dADWADAd"; 
$password = "ORADJAWla"; 
$db = "fadaad";

error_reporting(E_ALL ^ E_NOTICE);

$conn = new mysqli( $servername, $username,$password, $db);            
if( $conn->connect_error) {
    die("Ошбка:Не удалось подрубиться " . $conn->connect_error);
}                                                                               
$conn->select_db( $db);

$page_limit_comment = 10;                                    
$select_limit = isset( $_GET['page']) ? (INT)$_GET['page']*10 : 0; 


if(isset($_POST['submit'])) {
	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone_number']) && isset($_POST['comment'])) {
		   
    	          
    $username1 = $_POST['username'];
    $email1  = $_POST['email'];
    $phone1  = $_POST['phone_number'];
    $comment1 = $_POST['comment'];   
      
}   else { $stopBit = 4;   echo "isset"; }  
}   else { $stopBit = 3;   echo "submit";  }
    	          
$_SESSION['username'] = $_POST['username']; 
$_SESSION['email'] = $_POST['email'];
$_SESSION['comment'] = $_POST['comment'];
$_SESSION['phone_number'] = $_POST['phone_number'];



    if(!isset($stopBit)){   
         if( $r = $conn->query("INSERT INTO users_table (username, email, phone_number, message) VALUES ('$username1', '$email1', '$phone1', '$comment1')")){
                echo "Вы успешно оставили комментарий";
                
         } else { echo "bad";  }
    } else { echo "noааааааааааааа";  }



if( $result = $conn->query('SELECT `id`, `username`, `email`, `phone_number`, `message` FROM users_table WHERE status = 1 LIMIT '.$select_limit.',10')) { echo "WOW"; }

if($result->num_rows==0) {
        
      } else {
                                                                                                  // 
      while( $comment_data = mysqli_fetch_array($result)){

?>			 
<div class="comment-block"><?=  'Имя:    ' . $comment_data['username']; ?> </div> 
<div class="comment-block"><?=  'email:   ' .  $comment_data['email'];  ?> </div>
<div class="comment-block"><?=  'Телефон:' . $comment_data['phone_number'] ?> </div>               
<form action="" method="post">
<input type="hidden" name="commentid" value="<?= $comment_data['id']?>"></input>                                        
</form>         
</div>  
<div class="gbtext"><?=  'Сообщение:   '  . $comment_data['message']; ?>    </div> 
       
      <?php                              
      }    
    $result->close();
  }

   if($result=$conn->query('SELECT count(*) FROM users_table')) { 
 		$count_object = $result->fetch_row(); 
                              
	  	  if($count_object[0] < $page_limit_comment){  
	true;	
		  } else {  
	
 			   $count_pg_button = floor($count_object[0] / $page_limit_comment); 
			?> <div class="button_block">		      
			<?php    
				for($i = 0; $i <= $count_pg_button; $i++){ 
					?>   		                               
					   <p>

                                            <div class="pg_button"><a href="http://timsan.name/project/index.php?submit12=%D0%9E%D1%82%D0%BF%D1%80%D0%B0%D0%B2%D0%B8%D1%82%D1%8C&page=<?=$i;?>"><?=$i;?></a></div>
                                           
                                           </p> 
					 <?php				
				 }    
		 
	
		?> </div> <?php	 }             }

 




