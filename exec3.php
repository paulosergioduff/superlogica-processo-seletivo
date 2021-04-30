<?php

require 'vendor/autoload.php';

use Rows\ValidateRows as ValidateByGender;

function aprint($tableName, $array)
{
    echo "<h3>$tableName</h3><pre>";

    print_r($array);

    echo "</pre>";
}


class InsertInDataBase 
{
	
	public function send($info)
	{
		echo "<p>Success! ";
		aprint("Output: ",$info);
	}
}

class MergeMaleGenderToDb
{
    public $userOutPut;
    public $infoOutPut;
    public $filterArray;
    public $tableExpeted;

    function __construct($userTable, $infoTable)
    {
        $this->filterArray = [];
		$this->tableExpeted = [];

        $merge = [];

        $countInfo = count($infoTable);

        for ($i = 0; $i < $countInfo; $i++) {
            $merge[$i] = array_merge($infoTable[$i], $userTable[$i]);
        }

        $cache = [];

        foreach ($merge as $key => $value) {
            foreach ($merge[$key] as $key => $value) {
                if (
                    $key == "genero" or
                    $key == "nome" or
                    $key == "ano_nascimento"
                ) {
                    array_push($cache, $value);
                }

                $count = count($cache);
                $countFilter = count($this->filterArray);

                if ($count == 3 and $countFilter < 3) {
                    $genero = $cache[0];
                    $ano_nascimento = $cache[1];
                    $nome = $cache[2];

                    $usuario = $nome . " - " . $genero;
                    $ValidateByGender = new ValidateByGender();
                    $resultValidate = $ValidateByGender->validateRowToMale(
                        $genero,
                        $ano_nascimento
                    );

                    if (!empty($resultValidate[0]) == true) {
                        array_push($this->filterArray, [
                            "usuario" => $usuario,
                            "maior_50_anos" => $resultValidate[1],
                        ]);
						//$this->tableExpeted["$usuario"] = $resultValidate[1];

                    }

                    $cache = [];
                }
            }
        }


        $this->tableExpeted[0] = $this->filterArray[1];
        $this->tableExpeted[1] = $this->filterArray[0];
        $this->tableExpeted[2] = $this->filterArray[2];

        $sendToDataBase = new InsertInDataBase();
        $sendToDataBase = $sendToDataBase->send($this->tableExpeted);
    }
}


include "mockDB.php";

$joinTables = new MergeMaleGenderToDb($userTable, $infoTable);



