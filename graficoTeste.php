<?php 

require_once 'JurosCompostos.php';
require_once 'Chart.php';

echo date('d-m-Y H:i:s',1390788000);


$juros = new JurosCompostos();
$juros->setCapital(500);
$juros->setRate('0.6%');
$juros->setTime(36);
$juros->getCalcSum();
echo $juros->getProfit().'<br>';
echo json_encode($juros->getMontyBalance());
$juros->toChartCapitalByTime();
var_dump($juros);
/* 
$juros = new JurosCompostos();
$juros->setCapital(2500);
$juros->setRate('0.6%');

$juros = new JurosCompostos();
$juros->setCapital(10000);
$juros->setRate('0.6%');

$juros = new JurosCompostos();
$juros->setCapital(50000);
$juros->setRate('0.6%'); */