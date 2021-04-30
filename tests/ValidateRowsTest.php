<?php

namespace Rows;

use PHPUnit\Framework\TestCase;

class ValidateRowsTest extends TestCase
{
    public function testRow()
    {
        $execute = new ValidateRows();
        $yearCurrent = date('Y');

        $fifityYears = $yearCurrent - 50;
        $caseNofifityYeats = $yearCurrent - 20;

        $this->assertEquals(true, $execute->validateRowToMale('m', $fifityYears)[0]); // Prevê caso de validação com "M"
        $this->assertEquals(false, $execute->validateRowToMale('f', $fifityYears)); // Prevê caso de validação com "M"

        $exit = $execute->validateRowToMale('m', $fifityYears)[1]; // Prevê caso de retorno da string "SIM"
        $exit2 = $execute->validateRowToMale('m', $caseNofifityYeats)[1]; // Prevê caso de retorno da string "NÃO"

        if ($exit == "SIM" or $exit == "NÃO") {
            $this->assertEquals(
                $exit,
                $execute->validateRowToMale('m', $fifityYears)[1]
            );
        } else {
            $this->assertEquals(
                "error",
                $execute->validateRowToMale('m', $fifityYears)[1]
            );
        }

         if ($exit2 == "SIM" or $exit2 == "NÃO") {
            $this->assertEquals(
                $exit2,
                $execute->validateRowToMale('m', $caseNofifityYeats)[1]
            );
        } else {
            $this->assertEquals(
                "error",
                $execute->validateRowToMale('m', $caseNofifityYeats)[1]
            );
        }
    }
}
