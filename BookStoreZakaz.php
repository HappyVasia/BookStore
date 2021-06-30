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
<script scr = "BookStore.js"></script> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style type ="text/css">
#zakaz1, #zakaz2{
	background:lightgrey;
}
body{
	background:lightgrey;
}
#udalit{
	background:orange;
	cursor:pointer;
}
.block{
	margin-top:28px;
}
.pokupka{
	font-weight:bold;
	font-size:20px;
	font-family:sans-serif;
	font-stretch:ultra-expanded;
	font-size:25px;
}
.none1{
	position:absolute; 
	right:150px; left:150px;top:30px;
    font-size:50px; 
	color:black; 
	text-align:center;
	margin-top:260px;
	
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
style ="right:400px; top:55px; width:210px;">
 На главную </a>  
 </div> 

<div> 
<a href="BookStorePokup.php" target ="_blank"
div class="MoiZakaz" id = "none"
style ="right:70px; top:40px; width:200px; ">
 Перейти к оформлению </a>  
 </div> 

</div>

</body>
_HTML_;



$query = "SELECT картинка, книга_id, автор, название, 
жанр, издательство, город_издания, год_издания, 
стоимость_продажи  FROM книги
INNER JOIN покупка USING(книга_id)";	

$result = $link->query($query);
if (!$result) die($link->error); 
$rows = $result->num_rows; 
if ($rows == 0){
	 /*echo '<script>var x=document.getElementById("none");
	 x.removeAttribute("href"); </script>';*/
	 echo '<script>var x=document.getElementById("none");
	 x.remove(x); </script>';
	echo '<div class = "none1" id ="none1">';
	print <<< _HTML_
	У Вас нет выбранного товара для покупки
_HTML_;
}
else{
echo '<div class = "block" id ="zakaz1">';

for ($i = 0 ; $i < $rows ; ++$i){
	$result->data_seek($i);  //выбор строки
$row = $result->fetch_row(); //получение строки

print<<< _HTML_

<div class = "blocks" id ="zakaz2">
 <img src = $row[0] width = "200" height = "250"> 
 <br> <br> 
<em>Артикуль:</em> $row[1]  <br>
<em>Автор:</em>  $row[2]  <br>
<em>Название:</em> $row[3]  <br>
<em>Жанр:</em>    $row[4] <br>
<em>Издательство:</em> $row[5]  <br>
<em>Город издания:</em> $row[6]  <br>
<em>Год издания:</em> $row[7]  <br>
<em>Стоимость:</em> $row[8]  <br>

<form action="BookStoreZakaz.php" method "POST">
  <button type ="submit" id ="udalit" 
name ='udalit' 
  value ="$row[1]" > УДАЛИТЬ </button>
</form>

</div>
_HTML_;
}
echo '</div>';



$query = "SELECT SUM(стоимость_продажи) FROM покупка
INNER JOIN книги USING(книга_id)";
$result = $link->query($query);
if (!$result) die($link->error); 
$result->data_seek(); 
$row = $result->fetch_row(); 
$summa = $row[0];

print<<< _HTML_
<div class ="pokupka" style ="padding:10px;">
<div class ="text" style="left:15px;
width:300px; position:absolute; display:inline-block;
margin-bottom:0px;">
ВАША ПОКУПКА 
</div>
<div class ="tsena" style ="position:absolute;
display:inline-block; right:10px;
width:300px;">
на сумму $summa руб.
</div>
</div>
_HTML_;

}


$udalit = $_GET['udalit'];
$query = "DELETE FROM покупка 
           WHERE книга_id ='$udalit'";
$result = $link->query($query);




$query = "SELECT картинка, книга_id, автор, название, 
жанр, издательство, город_издания, год_издания, 
стоимость_продажи  FROM книги
INNER JOIN покупка USING(книга_id)";	

$result = $link->query($query);
if (!$result) die($link->error); 


echo '<div class ="podval">';
print<<< _HTML_
&copy; Захар Книгочтей
_HTML_;
echo '</div>';


?>
