<?php 

$minutos = -30;
$horario = mktime(00,$minutos,00,1,1,2013);


$table = '<table border="1">';
$table .= '<thead>
           </thead><tbody>';
$divisoes = 48;

for($i = 0; $i < $divisoes; $i++)
{
    //acordar
    $minutos += 30;
    $horario = mktime(00,$minutos,00,1,1,2013);
    $table .= '<tr><td>'.date('H:i:s',$horario).'</td>';
    
    //primeira refeição
    $carne = $minutos + 120;//2h    
    $horario = mktime(00,$carne,00,1,1,2013);
    $table .= '<td class="comida">'.date('H:i:s',$horario).'</td>';
    
    //inicio ciclo
    $ciclo1 = $carne + 30;
    $horario = mktime(00,$ciclo1,00,1,1,2013);
    $table .= '<td>'.date('H:i:s',$horario).'</td>';
    
    //fim ciclo
    $intervalo = $ciclo1 + 180;//3h
    $horario = mktime(00,$intervalo,00,1,1,2013);
    $table .= '<td>'.date('H:i:s',$horario).'</td>';
    
    //segunda refeição
    $carne2 = $intervalo + 30;//3h
    $horario = mktime(00,$carne2,00,1,1,2013);
    $table .= '<td class="comida">'.date('H:i:s',$horario).'</td>';
    
    //inicio segundo ciclo
    $ciclo2 = $carne2 + 30;
    $horario = mktime(00,$ciclo2,00,1,1,2013);
    $table .= '<td>'.date('H:i:s',$horario).'</td>';
    
    //fim ciclo
    $intervalo2 = $ciclo2 + 180;//3h
    $horario = mktime(00,$intervalo2,00,1,1,2013);
    $table .= '<td>'.date('H:i:s',$horario).'</td>';
    
    //terceira refeição
    $carne2 = $intervalo2 + 30;//3h
    $horario = mktime(00,$carne2,00,1,1,2013);
    $table .= '<td  class="comida">'.date('H:i:s',$horario).'</td>';
    
    $ciclo2 = $carne2 + 30;
    $horario = mktime(00,$ciclo2,00,1,1,2013);
    $table .= '<td>'.date('H:i:s',$horario).'</td>';
    
    $intervalo2 = $ciclo2 + 180;//3h
    $horario = mktime(00,$intervalo2,00,1,1,2013);
    $table .= '<td>'.date('H:i:s',$horario).'</td>';
    
    $carne2 = $intervalo2 + 30;//3h
    $horario = mktime(00,$carne2,00,1,1,2013);
    $table .= '<td  class="comida">'.date('H:i:s',$horario).'</td>';
    
    $table .= '</tr>';
	
}
$table .= '</tbody></table>';

?>

<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <style>
    .comida { background-color:yellow;}
    
    </style>
</head>
<body>
<?php echo $table;?>
</body>
</html>