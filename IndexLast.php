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

</div>

 <div> 
<a href="BookStoreZakaz.php" target ="_blank"
div class="MoiZakaz"
style ="right:70px; top:35px; ">
 МОЙ ЗАКАЗ </a>  
 </div> 



</body>
_HTML_;


$query = "SELECT DISTINCT автор
           FROM книги ORDER BY автор ";
$result = $link->query($query);
if (!$result) die($link->error); 
$rows = $result->num_rows; 
echo '<div class = "otbor">';
echo '<div class = "otbor1"> АВТОРЫ 
<i class="arrow down"></i>    ';
echo '<div class = "otbor2">';
 for ($i = 0 ; $i < $rows ; ++$i){
	$result->data_seek($i);  //выбор строки
$row = $result->fetch_row(); //получение строки
print<<< _HTML_

<form action ="books.php" target ="_blank" method "POST">
<button  type ="submit" id ="otborrr" name ="otbor3"
value ="$row[0]"> 
  $row[0]
  </button>
</form>

_HTML_;
}
echo '</div>'; 
echo '</div>'; 
echo '</div>';





$query = "SELECT DISTINCT жанр
           FROM книги ORDER BY жанр ";
$result = $link->query($query);
if (!$result) die($link->error); 
$rows = $result->num_rows; 
echo '<div class = "otbor">';
echo '<div class = "otbor1"> ЖАНРЫ 
<i class="arrow down"></i>    ';
echo '<div class = "otbor2">';
 for ($i = 0 ; $i < $rows ; ++$i)
{
	$result->data_seek($i);  //выбор строки
$row = $result->fetch_row(); //получение строки
print<<< _HTML_

<form action ="books.php" target ="_blank" method "POST">

<button  type ="submit" id ="otborrr" name ="otbor5"
value ="$row[0]"> 
  $row[0]
  </button>

</form>

_HTML_;
}
echo '</div>'; 
echo '</div>'; 
echo '</div>';


echo '<div class = "otbor">';
print<<< _HTML_
<div class = "otbor1" style ="width:510px;">
О нашем магазине
</div> 
_HTML_;
echo '</div>';





$otbor = $_GET['otbor3'];
$query = "SELECT картинка, книга_id, автор, название, 
жанр, издательство, город_издания, год_издания, 
стоимость_продажи
           FROM книги WHERE автор = '$otbor' ";
$result = $link->query($query);
if (!$result) die($link->error); 
$rows = $result->num_rows; 
echo '<div class = "blockk" id ="otbor4">';
for ($i = 0 ; $i < $rows ; ++$i){
	$result->data_seek($i);  //выбор строки
$row = $result->fetch_row(); //получение строки

print<<< _HTML_

<div class = "blocks">
 <img src = $row[0] width = "200" height = "250"> 
 <br> <br> 
<em>Артикуль:</em> $row[1]  <br>
<em>Автор:</em>  $row[2]  <br>
<em>Название:</em> $row[3]  <br>
<em>Жанр:</em>    $row[4] <br>
<em>Издательство:</em> $row[5]  <br>
<em>Город издания:</em> $row[6]  <br>
<em>Год издания:</em> $row[7]  <br>
<em>Стоимость:</em> $row[8]  <br><br>

<form action="IndexLast.php" method "POST">
  <button type ="submit" id ="kupit" 
name ='kupit' 
  value ="$row[1]" > КУПИТЬ </button>
</form>
</div>
_HTML_;
}
echo '</div>'; 


$otbor = $_GET['otbor5'];
$query = "SELECT картинка, книга_id, автор, название, 
жанр, издательство, город_издания, год_издания, 
стоимость_продажи
           FROM книги WHERE жанр = '$otbor' ";
$result = $link->query($query);
if (!$result) die($link->error); 
$rows = $result->num_rows; 
echo '<div class = "blockk" id ="otbor4">';
for ($i = 0 ; $i < $rows ; ++$i){
	$result->data_seek($i);  //выбор строки
$row = $result->fetch_row(); //получение строки

print<<< _HTML_

<div class = "blocks">
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

<form action="IndexLast.php" method "POST">
  
<button type ="submit" id ="kupit" 
name ='kupit' 
  value ="$row[1]" > КУПИТЬ </button>
</form>
</div>
_HTML_;
}
echo '</div>'; 


$query = "SELECT картинка, книга_id, автор, название, 
жанр, издательство, город_издания, год_издания, 
стоимость_продажи
           FROM книги ";
$result = $link->query($query);
if (!$result) die($link->error); 
$rows = $result->num_rows; 
echo '<div class = "block" id ="main">';
for ($i = 0 ; $i < $rows ; ++$i)
{
	$result->data_seek($i);  //выбор строки
$row = $result->fetch_row(); //получение строки

print<<< _HTML_

<div class = "blocks">
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

<form action="IndexLast.php" method "POST">
  
<button type ="submit" id ="kupit" 
name ='kupit' 
  value ="$row[1]" > КУПИТЬ </button>
</form>

</div>

_HTML_;
}
echo '</div>';


$artikul = $_GET['kupit'];
$query = "INSERT INTO покупка (книга_id)
           VALUES ('$artikul')";
$result = $link->query($query);


echo '<div class ="podval">';
print<<< _HTML_
&copy; Захар Книгочтей
_HTML_;
echo '</div>';



?>





























