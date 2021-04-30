<?php 

namespace OCP;

class Exemplo {
	public function __toString() {
		return get_class($this);
	}

	public function testeAlias(){
		echo "<p>.....teste alias";
	}
}