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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html lang="ru">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <? if($_SESSION['admin'] !== true) { echo header("Location:index.php"); } else { echo $_SESSION['admin']; }?>	 
    <link rel="stylesheet" href="style.css">
    <title>Project</title>
</head>
  
<body>

</body>
</html>

<?
$page_limit_comment = 10;                                    
$select_limit = isset( $_GET['page']) ? (INT)$_GET['page']*10 : 0;
$admin_name = $_SESSION['admin_name'];
$today = date("m.d.y");

if(isset($_POST['submit'])) {
	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone_number']) && isset($_POST['comment'])) {
		   
    	          
    $username1 = $_POST['username'];
    $email1  = $_POST['email'];
    $phone1  = $_POST['phone_number'];
    $comment1 = $_POST['comment'];   
      
}   else { $stopBit = 4;   echo "isset"; }  
}   else { $stopBit = 3;   echo "submit";  }
    	          


    if(!isset($stopBit)){   
         if( $r = $conn->query("INSERT INTO users_table (username, email, phone_number, message) VALUES ('$username1', '$email1', '$phone1', '$comment1')")){
                echo "Вы успешно оставили комментарий";
                
         } else { echo "bad";  }
    } else { echo "noааааааааааааа";  }



if( $result = $conn->query('SELECT `id`, `username`, `email`, `phone_number`, `message`, `status`, `edit`, `edit_admin`, `edit_time` FROM users_table LIMIT '.$select_limit.',10')) { echo "WOW"; }

if($result->num_rows==0) {
        
      } else {
                                                                                                  // 
      while( $comment_data = mysqli_fetch_array($result)){

?>			 
<div class="comment-block"><?=  'Имя:    ' . $comment_data['username']; ?>      <? if($comment_data['status'] !== NULL) { echo " Рассмотрена"; } else {echo " Не рассмотрена"; }?>     </div>
<div class="comment-block"><?=  'email:   ' .  $comment_data['email'];  ?>              <form action="" method="post">
											<input type="hidden" name="commentid" value="<?=  $comment_data['id']; ?>"></input>                                        
									      	  	<input type="submit" class="tip" name="yes" value="Опубликовать"></input> 
											<input type="submit" class="tip" name="no" value="Отклонить"></input>
											<input type="submit" class="tip" name="edit" value="Редактировать"></input>
											<? if($comment_data['edit'] !== NULL ) { echo 'Изменено администратором '.$comment_data['edit_admin'].' В '.$comment_data['edit_time'].''; } ?>      
	                                                                		  </form>          </div>  
<div class="comment-block"><?=  'Телефон:' . $comment_data['phone_number']; ?> </div>               
<form action="" method="post">
                                       
</form>         
</div>  
<div class="gbtext"><?=  'Сообщение:   '  . $comment_data['message'];  ?>    </div> 
       
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
					?>   <p> 
					<div class="pg_button"><a href="http://timsan.name/project/admin.php?submit12=%D0%9E%D1%82%D0%BF%D1%80%D0%B0%D0%B2%D0%B8%D1%82%D1%8C&page=<?=$i;?>"><?=$i;?></a></div>
                                            </p>  <?php				
				}    
      ?> </div> <?php	 }            
 }


if(isset($_POST['yes'])) {
	 if( $result1 = $conn->query('UPDATE users_table SET status = 1 WHERE id = "'.$_POST['commentid'].'" ')) { 	}  }  
                                                                                                    
if(isset($_POST['no'])) { 
	if( $result2 = $conn->query('UPDATE users_table SET status = 0 WHERE id = '.$_POST['commentid'].' ')) {	}  }

if(isset($_POST['edit'])) {
	 if( $result3 = $conn->query('SELECT `id`, `username`, `email`, `phone_number`, `message` FROM users_table WHERE id = '.$_POST['commentid'].' ')) { echo "wwwwwwwwwwwwwwwww"; $comment_data1 = mysqli_fetch_array($result3);  }  }

if(isset($_POST['editmes'])) {
 	if( $result4 = $conn->query('UPDATE `users_table` SET `username` = "'.$_POST['username'].'", `email` = "'.$_POST['email'].'", `phone_number` = "'.$_POST['phone_number'].'",  `message` = "'.$_POST['message'].'", `edit` = 1, `edit_admin` = "'.$admin_name.'", `edit_time` = "'.$today.'"  WHERE `id` = "'.$_POST['commentid1'].'"')){   }   } 

?>
<footer>    
        <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="commentid1" value="<? echo $comment_data1['id']; ?>"></input>
            <div class="form">   
                <p><label>имя* :</label> <input type="text" size="30" name="username" value="<? if($comment_data1['username'] !== NULL) { echo $comment_data1['username']; } ?>" required> </p>
                <p> <label>email* :</label> <input type="text" size="30" name="email" value="<? if($comment_data1['email'] !== NULL) { echo $comment_data1['email']; } ?>" required> </p>
                <p> <label>phone* :</label> <input type="text" size="30" name="phone_number" value="<? if($comment_data1['phone_number'] !== NULL) { echo $comment_data1['phone_number']; } ?>" required> </p>
                <p> <label>сообщение* :</label> </p>
                <p> <textarea rows="5" cols="40" name="message" required><? if($comment_data1['message'] !== NULL) { echo $comment_data1['message']; } ?></textarea></p>
                <p> <input type="submit" name="submit" value="Отправить сообщение"></input> <input type="submit" name="editmes" value="Редактировать сообщение"></input> </p>
	
            </div>
        </form>
    </footer>   






