<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 12.04.13
 * Time: 15:12
 * To change this template use File | Settings | File Templates.
 */
header('Content-Type: text/html; charset=utf-8');

$text = $_REQUEST['text'];
$message = "Сообщение отправлено с адреса:" . $_REQUEST['email']. "\n" . $text;

if($mail_go = mail('tech@kmv.ru',$_REQUEST['topic'],$message)) {
    echo 'Сообщение отправлено!';
} else {
    echo 'Ошибка, попробуйте отправить сообщение позже!';
}
