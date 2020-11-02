<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$to = 'info@nb-construction.kz';
if(isset($_POST['fio'])){
	$fio = $_POST['fio'];
}else{
	$fio = $_POST['name'];
}
$phone = $_POST['phone'];
$type = $_POST['type'];

$subject = 'Заявка с сайта nb-construction.kz';

if($type == 1){
	$city = $_POST['city'];
	$target = $_POST['target'];
	$size = $_POST['size'];
	$price = $_POST['price'];
	$payment = $_POST['payment'];
	$pluses = $_POST['pluses'];
	
	$message = '
	<html>
	<head>
	  <title>Заявка с сайта <a href="http://nb-construction.kz/">NB construction</a></title>
	</head>
	<body>
	  <p>Тип: Подобрать квартиру</p>
	  <p>ФИО: '.$fio.'</p>
	  <p>Телефон:'.$phone.'</p>

	  <p>Город:'.$city.'</p>
	  <p>Цель:'.$target.'</p>
	  <p>Площадь:'.$size.'</p>
	  <p>Цена:'.$price.'</p>
	  <p>Способ оплаты:'.$payment.'</p>
	  <p>Дополнительно:'.$pluses.'</p>
	</body>
	</html>
	';
	$to = 'info@nb-construction.kz';
} else if($type == 0){
	$message = '
	<html>
	<head>
	  <title>На сайте <a href="http://nb-construction.kz/">NB construction</a> скачали презентацию</title>
	</head>
	<body>
	  <p>Тип: Скачать презентацию</p>
	  <p>ФИО: '.$fio.'</p>
	  <p>Телефон:'.$phone.'</p>
	</body>
	</html>
	';
	$to = 'prezentazia@nb-construction.kz';
} else if($type == 2){
	$message = '
	<html>
	<head>
	  <title>На сайте <a href="http://nb-construction.kz/">NB construction</a> запросили обратный звонок</title>
	</head>
	<body>
	  <p>Тип: Обратный звонок</p>
	  <p>Телефон:'.$phone.'</p>
	</body>
	</html>
	';
	$to = 'call@nb-construction.kz';
} else if($type == 3){
	$zk = $_POST['zk'];
	$rooms = $_POST['rooms'];
	$size = $_POST['size'];

	$message = '
	<html>
	<head>
	  <title>Стоимость квартиры <a href="http://nb-construction.kz/">NB construction</a></title>
	</head>
	<body>
	  <p>Тип: Стоимость квратиры</p>
	  <p>Телефон:'.$phone.'</p>
	  <p>Кол-во комнат:'.$rooms.'</p>
	  <p>Площадь:'.$size.'</p>
	</body>
	</html>
	';
	$to = 'shop@nb-construction.kz';
}


$headers =  'MIME-Version: 1.0'. "\r\n" .'Content-type: text/html; charset=utf-8'. "\r\n" .'From: <info@nb-construction.kz>';
#mail($to, $subject, $message);
if(mail($to, $subject, $message, $headers))
{
    echo "Message accepted";
}
else
{
    echo "Error: Message not accepted";
}
?>