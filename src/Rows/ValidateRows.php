<?php

namespace Rows;

class ValidateRows{
  public $yearCurrent;
  public $oldOutput;

  public function validateRowToMale($gender, $yearOfBirth){

  	$result = [];

	$yearCurrent = $this->yearCurrent = date('Y');

	$date1 = new \DateTime( "$yearCurrent-01-01" );
	$date2 = new \DateTime( "$yearOfBirth-01-01" );
	$interval = $date1->diff( $date2 );

    $finalInterval = $interval->y;

    //tratando variável do gênero do usuário
    if (strcasecmp($gender, "M") == 0) {// Indifere se a variável do gênero virá maiúscula ou minúscula
    	$gender = 'M';
    	// Caso for do sexo masculino, e maior que 50 anos
	    if ($finalInterval >= 50) {
	    	$this->oldOutput = "SIM";
	    }else {
	    	$this->oldOutput = "NÃO";
	    }
	    $result = [true, $this->oldOutput];
	}

	else{
    	$result = false;
    }

    return $result;
  }
}
