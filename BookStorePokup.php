<?php
    $hostname="localhost";
	$username="root";
	$password="";
	$dbname="bookstore1";
	$link = mysqli_connect($hostname, $username, 
	$password, $dbname) 
         or die("Ошибка " . mysqli_error($link));
	mysqli_set_charset($link,'utf8');
error_reporting(0);

print<<< _HTML_

<head>
<link rel = "stylesheet" href = "IndexBookStyle.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<style type ="text/css">
body{
	background:black;
}
.form{
	background:orange;
	margin-left:470px;
	margin-right:470px;
	margin-top:30px;
	padding:35px;
	padding-top:50px;
	padding-bottom:7px;
	height:400px;
	width:400px;
	font-size:25px;
	font-weight:bold;
	text-decoration:none;
	text-align:center;
	display:flex;
	align-items:center;
	justify-content:center;
	border-radius:35px;
}
.button{
	font-size:20px;
	width:200px;
	height:40px;
	background:gray;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.8);
}

</style>

</head>

<body>

<div class = "shapka">

  <div class = "fotos" >
     <script type="text/javascript">
     var images = new Array();
     var i = 0;
    images[0] = './images/5001.jpg'; // Пушкин
	images[2] = './images/5002.jpg'; // Гоголь
    images[1] = './images/5003.jpg'; // Достоевский
		    function viewImages() {
        document.getElementById("img_main").src =
		images[i]; 
        i++;
        if (i == images.length) {
            i = 0;
        }
        setTimeout("viewImages()",4000);
    }   
       </script>
 <img src="" id="img_main">
 <script> viewImages(); </script> 
</div>

<div class = "name"> Книгочтей </div>

<div> 
<a href="IndexLast.php"
div class="MoiZakaz"
style ="right:400px; top:45px; width:210px; ">
 На главную </a>  
 </div> 

<button  id ="spasibo" class="MoiZakaz" 
style="right:70px; top:40px; width:200px;"> 
Оплатить </button>
 
 </div>

<div class ="form" id ="form">
<form method "POST" action = "BookStorePokup.php">

<div class ="familia">

Введите вашу фамилию:<br><br>
<input type = "text" id="surname" name ="surname" > <br>

</div>
<br><br>
<div class ="login">

Введите уникальное имя:<br><br>
<input type = "text" id="login" name ="login" > <br>

</div>
<br><br>
<input type = "submit" class="button"
 name="submit" value = "ОТПРАВИТЬ"> <br> <br> <br>

 </div>
</form>




<div class ="spasibo1" id ="spasibo1"
style= "position:absolute; 
	right:150px; left:150px;top:30px;
    font-size:80px; color:white; 
	text-align:center;
	margin-top:270px;
	display:none;">
СПАСИБО ЗА ПОКУПКУ
</div>



<script>
 $('#form').submit(function() {
 if ($('#surname').val() == '' ||
 $('#login').val() == '')
 {
 alert('Пожалуйста, введите ФАМИЛИЮ и УНИКАЛЬНОЕ ИМЯ')
 return false
 }
 })
 </script>

<script>
 $('#spasibo').click(function() 
 { $('#form').hide('slow', 'linear') })
  $('#spasibo').click(function() 
 { $('#MoiZakaz').hide('slow', 'linear') })
  $('#spasibo').click(function() 
 { $('#spasibo').hide('slow', 'linear') })
  $('#spasibo').click(function() 
 { $('#spasibo1').show('slow', 'linear') })
  
 </script>

</body>
_HTML_;


$surname = $_GET["surname"];
$parol = $_GET['parol'];


$query = "INSERT INTO покупатели (фамилия, пароль) 
VALUES ('{$surname}', '{$parol}')";
$result = $link->query($query);


$queryyy = "SELECT покупатель_id
        FROM покупатели WHERE фамилия ='$surname'";
$result = $link->query($queryyy);
if (!$result) die($link->error); 

	$result->data_seek(0);  //выбор строки
$row = $result->fetch_row(); //получение строки

$pokupatel = $row[0];


$query = "UPDATE покупка 
       SET покупатель_id = '$pokupatel'";
$result = $link->query($query);

/*
$query = "DELETE FROM покупатели 
       WHERE фамилия = '' ";
$result = $link->query($query);
*/

$query = "DELETE FROM покупка 
       WHERE книга_id = '0' ";
$result = $link->query($query);


$query = "INSERT INTO продажи(книга_id, покупатель_id) 
SELECT книга_id, покупатель_id FROM покупка";
$result = $link->query($query);

$query = "TRUNCATE TABLE покупка";
$result = $link->query($query);



echo '<div class ="podval">';
print<<< _HTML_
&copy; Захар Книгочтей
_HTML_;
echo '</div>';












?>














