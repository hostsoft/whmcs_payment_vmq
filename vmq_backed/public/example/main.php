<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");

$key = "b563ec797026d0cf2c501f4fcc6fe4c8";//通讯密钥
$host = "../createOrder";

$sign = md5($_GET['payId'].$_GET['param'].$_GET['type'].$_GET['price'].$key);
$p = "payId=".$_GET['payId'].'&param='.$_GET['param'].'&type='.$_GET['type']."&price=".$_GET['price'].'&sign='.$sign.'&isHtml=1';

echo "<script>window.location.href = '".$host."?".$p."'</script>";

