<?php

function console($field, $valor){
      $debugMode = false;
      
      if ($debugMode == true) {
        echo '<style type="text/css">body{background-color:black;color:#7CFC00}</style>';
        $result = json_encode($valor);

          if (empty($valor)) {
                        echo "<hr>$field: null<hr>";

            }else{
                    echo "<hr>$field: ".$valor."<hr>";

            }
      }
    }

//1) Crie um array 
$createArray = [];

//2) Popule este array com 7 números
function populateArray($array, $lengh){
	for ($i=0; $i < $lengh; $i++) { 
		array_push($array, $i);
	}

	return $array;
}

$createArray = populateArray($createArray, 7);
//Exemplo de debug no browser
//console("Resultado exibido em json : ", json_encode($createArray));

//3) Imprima o número da posição 3 do array
print_r($createArray[3]);

//4) Crie uma variável com todas as posições do array no formato de string separado por vírgula
$countOfElements = count($createArray);

function getAllArrayPositionsToString($array, $limit){
	$result = "";
	for ($i=0; $i < $limit; $i++) { 
		$result = $result.$array[$i].",";
			}
	$result = rtrim($result, ',');

	return $result;

}

$arrayToString = getAllArrayPositionsToString($createArray, $countOfElements);

//5) Crie um novo array a partir da variável no formato de string que foi criada

$newArray = explode(",", $arrayToString);

//6) Crie uma condição para verificar se existe o valor 14 no array

	function checkElement($array, $key){
		if (array_key_exists($key, $array)) {
			return true;
		}else{
			return false;
		}
	}

$checkElement14 = checkElement($newArray, 14);

//7) Faça uma busca em cada posição. Se o número da posição atual for menor que a posição anterior, exclua esta posição

	foreach ($newArray as $key => $value) {
		$currentPosition = $key;
		if ($key > 0) {
			$lastPosition = $currentPosition -1;
		}else{
			$lastPosition = null;
		}

		if ($newArray[$currentPosition] < !empty($newArray[$lastPosition])) {
			array_pop($newArray);
		}
	}

//8) Remova a última posição deste array

array_pop($newArray);

//9) Conte quantos elementos tem neste array

$countNewArray = count($newArray);

//10) Inverta as posições deste array

$invertido = array_reverse($newArray);
$invertidoMantendoChaves = array_reverse($newArray, true);


?>