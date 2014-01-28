<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
  
session_start();

require 'JurosCompostos.php';
$sum     = $_POST['sum'];
$capital = $_POST['capital'];
$rate    = $_POST['rate'];
$time    = $_POST['time'];

$operation = $_POST['operation'];

$juros = new JurosCompostos();
$juros->setSum($sum);
$juros->setCapital($capital);
$juros->setRate($rate);
$juros->setTime($time);

switch($operation)
{
	case '1':
	    $json = $juros->GetSumChart();
	    break;
    case '2':
        $json = $juros->GetCapitalChart();
        break;
    case '3':
        $json = $juros->GetRateChart();
        break;
    case '4':
        $json = $juros->GetTimeChart();
        break;
    default:
        throw new Exception('Bug');
        break;    
}

echo json_encode($json);