<form method="post">
<div>
<label for="userName">Nome do usuário:</label>
<input type="text" id="userName" name="userName">
</div>
<div>
<label for="zipCode">CEP</label>
<input type="text" id="zipCode" name="zipCode">
</div>
<div>
<label for="phoneNumber">Número do telefone:</label>
<input type="text" id="phoneNumber" name="phoneNumber">
</div>
<div>
<label for="email">Email:</label>
<input type="text" id="email" name="email">
</div>
<div>
<label for="password">Senha (8 caracteres mínimo, contendo pelo menos 1 letra e 1
número):</label>
<input type="password" id="password" name="password">
</div>
<input type="submit" value="Cadastrar">
</form>

<?php
function select($info)
{
    if ($info != 'NOT FOUND INFO IN MOCK DB') {
        return false;
    }else{
    	return true;
    }
}

function insert($info)
{
    $searchInBd = $info;
    if ($searchInBd != 'NOT FOUND IN MOCK DB') {
        return true;
    } else {
        return false;
    }
}

function curl($url, $information)
{
    $curl = curl_init();

    function curl_mock_exec($curl){
    	$result = "{ 'result': 'success!'}";
    	return $result;
    }

    curl_setopt_array($curl, [CURLOPT_URL => "$url", CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => "", CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 30, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "POST", CURLOPT_POSTFIELDS => "$information", CURLOPT_HTTPHEADER => ["auth token", "Content-Type: application/json"], ]);

    $response = curl_mock_exec($curl);

    echo "<hr>$response";
    
}


foreach ($_POST as $indice => $value) {
    $_POST[$indice] = addslashes($_POST[$indice]);
    $_POST[$indice] = htmlspecialchars($_POST[$indice]);
}

$modelRegister = [];
$error = 0;

$userName = $_POST['userName'];

if (preg_match('/^\w{5,}$/', $userName)) {
    array_push($modelRegister, $userName);
} else {
    $error++;
}

$CEP = $_POST['zipCode'];
if (!is_numeric($CEP) || strlen($CEP) < 8) {
    $error++;
} else {
    array_push($modelRegister, $CEP);
}

$telefone = $_POST['phoneNumber'];
if (!is_numeric($telefone) || strlen($telefone) < 11) {
    $error++;
} else {
    array_push($modelRegister, $telefone);
}

$email = $_POST['email'];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($modelRegister, $email);
} else {
    $error++;
}

// Given password
$password = $_POST['password'];

// Validate password strength
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if (
    !$uppercase ||
    !$lowercase ||
    !$number ||
    !$specialChars ||
    strlen($password) < 8
) {
    $error++;
} else {

	$senha = $password;
	$custo = '08';
	$salt = 'Cf1f11ePArKlBJomM0F6aJ';
	 
	// Gera um hash baseado em bcrypt
	$hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');

    array_push($modelRegister, $hash);
}

if ($error == 0) {
	$register = json_encode($modelRegister);
	$searchByUserName = select($userName);


	if ($searchByUserName == false) {
		insert($modelRegister);
		$result = select($userName);

		if ($result == false) {
			print_r("<p>Cadastro do usuário $userName realizado com sucesso!");
			echo "<p>$register";
			curl("www.meusite.com.br/api", $register);
		}
	}



}else{
	echo "<p style='color: red;'> Foram encontrados $error erro(s) no formulário! Revise os campos!";
}


?>
