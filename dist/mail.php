<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$to = $_POST['_replyto'];
$fio = $_POST['name'];
$phone = $_POST['phone'];
$subject = 'Заявка с сайта nb-holding.kz';

$message = '
<html>
<head>
  <title>Заявка с сайта <a href="http://nb-holding.kz/">NB holding</a></title>
</head>
<body>
  <p>Заявка с сайта <a href="http://nb-holding.kz/">nb holding</a></p>
  <p>ФИО: '.$fio.'</p>
  <p>Телефон:'.$phone.'</p>
</body>
</html>
';

$headers =  'MIME-Version: 1.0'. "\r\n" .'Content-type: text/html; charset=utf-8'. "\r\n" .'From: <info@nb-holding.kz>';
mail($to, $subject, $message);
if(mail($to, $subject, $message, $headers))
{
    echo "Message accepted";
}
else
{
    echo "Error: Message not accepted";
}
?>