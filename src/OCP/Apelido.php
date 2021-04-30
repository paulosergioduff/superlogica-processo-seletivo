<?php 

namespace OCP;

class Apelido {
	public function __toString() {
		return get_class($this);
	}

	public function teste(){
		echo "<p>.....Classe apelido teste2";
	}
}