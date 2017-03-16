<?php
/**
 * Arquivo com funções globais utilizadas pelas 
 * classes e áreas internas do sistema
 *
 * @package primenote
 * @since 4.0 | 03/02/2017
 */


/**
 * Verifica chaves de arrays
 * Verifica se a chave existe no array e se ela tem algum valor.
 * @param array  $array O array onde desejo verificar
 * @param string $key   A chave do array que desejo verificar
 * @return string|null  O valor da chave do array ou nulo
 */
function chk_array ( $array, $key ) {
	// Verifica se a chave existe no array
	if ( isset( $array[ $key ] ) && ! empty( $array[ $key ] ) ) {
		// Retorna o valor da chave
		return $array[ $key ];
	}
	
	// Retorna nulo por padrão
	return null;
} // chk_array


/**
 * Publica os dados de um array em JSON.
 * A função recebe um array de dados e converte para JSON.
 * @param array  $array O array onde desejo converter
 * @return string|null  O valor do array em JSON, com os cabeçalhos HTML do JSON
 */
function RetornaJSON($array){
    header('Content-type: text/json');             
    header('Content-type: application/json');
    echo json_encode($array);
    //print_r($array);
}


/**
 * Função para carregar automaticamente todas as classes padrão
 * Ver: http://php.net/manual/pt_BR/function.autoload.php.
 * Nossas classes estão na pasta classes/.
 * O nome do arquivo deverá ser class-NomeDaClasse.php.
 * Por exemplo: para a classe TutsupMVC, o arquivo vai chamar class-TutsupMVC.php
 */
function __autoload($class_name) {
	$file = ABSPATH . '/core/' . $class_name . '.php';
	
	if ( ! file_exists( $file ) ) {
		require_once ABSPATH . '/includes/404.php';
		return;
	}
	
	// Inclui o arquivo da classe
    require_once $file;
} // __autoload


/**
 * Função formata os campos de cep, cpf, cnpj, rg, phone e celphone para visualização
 * O parametro clear é para remoção de todos os pontos e inserir apenas numeros
 *
 * @param string $value 	O valor que deverá passar pela formatação
 * @param string $type 		O typo de formatação que será aplicado
 * @return string O dado formato
 */
function formatItem ($value, $type) {

    $value = preg_replace('/[^0-9]/', '', $value);
	
	if (strlen($value) > 0) {
		switch ($type){
			case 'phone':
				$value = '(' . substr($value, 0, 2) . ') ' . substr($value, 2, 4) . 
					'-' . substr($value, 6);
			break;
			case 'cep':
				$value = substr($value, 0, 5) . '-' . substr($value, 5, 3);
			break;
			case 'cpf':
				$value = substr($value, 0, 3) . '.' . substr($value, 3, 3) . 
					'.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
			break;
			case 'cnpj':
				$value = substr($value, 0, 2) . '.' . substr($value, 2, 3) . 
					'.' . substr($value, 5, 3) . '/' . 
					substr($value, 8, 4) . '-' . substr($value, 12, 2);
			break;
			case 'rg':
				$value = substr($value, 0, 2) . '.' . substr($value, 2, 3) . 
					'.' . substr($value, 5, 3);
			break;
			case 'celphone':
				$value = '(' . substr($value, 0, 2) . ') ' . substr($value, 2, 1) .
					' ' . substr($value, 3, 4) . '-' . substr($value, 7);
			break;
			case 'clear':
				$value = $value;
			break;
		}
	} else {
		$value = '';
	}
	return $value;
}// formatItem


/**
 * Função de validação de email
 * Valida o email informado e retorna '' caso o email seja inválido
 *
 * @param string $value 	O valor que deverá ser verificado
 * @return string O dado validado ou '' em caso de email inválido
 */
function emailValidade($email) {
	
	if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$email)) {
		return $email;
	} else {
		return '';
	}

}
