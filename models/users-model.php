<?php 
/**
 * Modelo de Controle de Usuários (User)
 *
 * @package primenote
 * @since 4.0.4 | 16/03/2017
 */

class UsersModel extends MainModel{

	/**
	 * $postForm
	 * Array de dados do usuário enviados do form 
	 *
	 * @access public
	 */
	public $postForm = array();


	/**
	 * Construtor para essa classe
	 * Configura o DB, o controlador, os parâmetros e dados do usuário.
	 *
	 * @since 0.1
	 * @access public
	 * @param object $db Objeto da nossa conexão PDO
	 * @param object $controller Objeto do controlador
	 */
	public function __construct( $db = false, $controller = null ) {
		// Configura o DB (PDO)
		$this->db = $db;
		
		// Configura o controlador
		$this->controller = $controller;

		// Configura os parâmetros
		$this->parametros = $this->controller->parametros;

		// Configura os dados do usuário
		$this->userdata = $this->controller->userdata;
	}
	

	/**
	 * Função que valida os dados enviados do usuário
	 *
	 * @since 0.1
	 * @access public
	 * @param  boolean $insert Valor true caso seja um novo usuário | False para update
	 * @param  boolean $complete True caso a verificação inclua endereço e telefone
	 * @return array Os dados da base de dados
	 */
	public function validateForm ($insert=true, $complete=true) {

		// temporizador para debug
		$crono = new ClockTimer;
		$crono->setTime(microtime(true), memory_get_usage());
		
		$post = filter_input_array(INPUT_POST, array(
			'user_id'			=> FILTER_SANITIZE_NUMBER_INT,
			'user'				=> FILTER_SANITIZE_STRING,
			'user_short_name' 	=> FILTER_SANITIZE_STRING,
			'user_name' 		=> FILTER_SANITIZE_STRING,
			'user_group'		=> FILTER_SANITIZE_NUMBER_INT,
			
			'user_address'		=> FILTER_SANITIZE_STRING,
			'user_unit'			=> FILTER_SANITIZE_STRING,
			'user_city'			=> FILTER_SANITIZE_STRING,
			'user_postal_code'	=> FILTER_SANITIZE_STRING,
			'user_state'		=> FILTER_SANITIZE_STRING,
			
			'user_phone' 		=> FILTER_SANITIZE_STRING,
			'user_celphone'		=> FILTER_SANITIZE_STRING,
			'user_email' 		=> FILTER_SANITIZE_EMAIL
		));


		$prepare = array_map("strip_tags", $post);
		$response = array();

		// verifica os campos obrigatórios e formata para inserção
		// se o campos inserir é true, então o nome de usuário é obrigatório
		if ($insert == true){
			if ($prepare['user'] == '') {
				$arr['type'] = 'error'; $arr['from'] = 'user';
				$arr['title'] = 'Campo obrigatório';
				$arr['message'] = 'O nome do usuário é obrigatório.';			
				$response['toast'][] = $arr;};
			unset($prepare['user_id']); // excluí do registro o campo id pois é inserção
		}else{
			if ($prepare['user_id'] == '') {
				$arr['type'] = 'warning'; $arr['from'] = '';
				$arr['title'] = 'Erro Crítico';
				$arr['message'] = 'Recarregue a página e tente novamente.';			
				$response['toast'][] = $arr;};
		}

		if ($prepare['user_short_name'] == '') {
				$arr['type'] = 'error'; $arr['from'] = 'user_short_name';
				$arr['title'] = 'Campo obrigatório';
				$arr['message'] = 'O nome ou apelido do usuário é obrigatório.';			
				$response['toast'][] = $arr;};

		if ($prepare['user_name'] == '') {
				$arr['type'] = 'error'; $arr['from'] = 'user_name';
				$arr['title'] = 'Campo obrigatório';
				$arr['message'] = 'O nome completo do usuário é obrigatório.';			
				$response['toast'][] = $arr;};

		// se a validação é completa, estes dados são orbigatórios
		if ($complete == true){
			if ($prepare['user_address'] == '') {
				$arr['type'] = 'error'; $arr['from'] = 'user_address';
				$arr['title'] = 'Campo obrigatório';
				$arr['message'] = 'O endereço do usuário é obrigatório.';			
				$response['toast'][] = $arr;};

			if ($prepare['user_unit'] == '') {
				$arr['type'] = 'error'; $arr['from'] = 'user_unit';
				$arr['title'] = 'Campo obrigatório';
				$arr['message'] = 'O bairro do usuário é obrigatório.';			
				$response['toast'][] = $arr;};

			if ($prepare['user_city'] == '') {
				$arr['type'] = 'error'; $arr['from'] = 'user_city';
				$arr['title'] = 'Campo obrigatório';
				$arr['message'] = 'A cidade do usuário é obrigatória.';			
				$response['toast'][] = $arr;};

			if (formatItem($prepare['user_postal_code'],'cep') == '') {
				$arr['type'] = 'error'; $arr['from'] = 'user_postal_code';
				$arr['title'] = 'Campo obrigatório';
				$arr['message'] = 'O nome completo do usuário é obrigatório.';			
				$response['toast'][] = $arr;};

			if (formatItem($prepare['user_phone'], 'phone') == '' && formatItem($prepare['user_celphone'], 'celphone') == '') {
				$arr['type'] = 'error'; $arr['from'] = 'user_phone';
				$arr['title'] = 'Campo obrigatório';
				$arr['message'] = 'Um telefone ou celular de contato do usuário é obrigatório.';			
				$response['toast'][] = $arr;};

			if (emailValidade($prepare['user_email']) == '') {
				$arr['type'] = 'error'; $arr['from'] = 'user_email';
				$arr['title'] = 'Campo obrigatório';
				$arr['message'] = 'O e-mail do usuário é obrigatório.';			
				$response['toast'][] = $arr;};
		}

		// limpa pontos e formatação para inserir no banco de dados
		$prepare['user_postal_code'] 	= formatItem($prepare['user_postal_code'], 'clear');
		$prepare['user_phone'] 			= formatItem($prepare['user_phone'], 'clear');
		$prepare['user_celphone'] 		= formatItem($prepare['user_celphone'], 'clear');
		$prepare['user_state']			= strtoupper($prepare['user_state']); 

		// se o array response é vazio a validação está ok, se não, há erros!
		if (!$response) {
			$this->postForm = $prepare;
			$response['validateOk']=true;
		} else {
			$response['validateError']=true;
		}

		$response['crono'] = $crono->getTime(microtime(true), memory_get_usage());
		return $response;

	} // validateForm



		/**
	 * Função que valida as senhas enviadas do usuário
	 *
	 * @since 0.3
	 * @access public
	 * @return array Os dados da base de dados
	 */
	public function validatePassword () {

		// temporizador para debug
		$crono = new ClockTimer;
		$crono->setTime(microtime(true), memory_get_usage());
		
		$post = filter_input_array(INPUT_POST, array(
			'user_id'			=> FILTER_SANITIZE_NUMBER_INT,
			'user_group'		=> FILTER_SANITIZE_NUMBER_INT,
			
			'old_password'		=> FILTER_SANITIZE_STRING,
			'new_password_1'	=> FILTER_SANITIZE_STRING,
			'new_password_2'	=> FILTER_SANITIZE_STRING,
		));


		$prepare = array_map("strip_tags", $post);
		$response = array();

		// verifica se os campos foram preenchidos
		if ($prepare['old_password'] == '') {
			$arr['type'] = 'error'; $arr['from'] = 'old_password';
			$arr['title'] = 'Campo obrigatório';
			$arr['message'] = 'A senha atual do usuário é obrigatória.';			
			$response['toast'][] = $arr;};

		if ($prepare['new_password_1'] == '' || $prepare['new_password_2'] == '') {
			$arr['type'] = 'error'; $arr['from'] = 'new_password_1';
			$arr['title'] = 'Campo obrigatório';
			$arr['message'] = 'A nova senha de usuário é obrigatória.';			
			$response['toast'][] = $arr;};

		if ($prepare['new_password_1'] != $prepare['new_password_2']) {
			$arr['type'] = 'error'; $arr['from'] = 'new_password_1';
			$arr['title'] = 'Senhas Diferentes';
			$arr['message'] = 'As novas senhas digitadas são diferentes.';			
			$response['toast'][] = $arr;};

		// se o array response é vazio a validação está ok, se não, há erros!
		if (!$response) {
			$this->postForm['user_id'] = $prepare['user_id'];
			$this->postForm['user_group'] = $prepare['user_group'];
			$this->postForm['old_password'] = $prepare['old_password'];
			
			// criptografa e prepara a nova senha para o postForm
			$ph = new PasswordHash(8, FALSE);
			$this->postForm['user_password'] = $ph->HashPassword($prepare['new_password_1']);
			
			$response['validateOk']=true;
		} else {
			$response['validateError']=true;
		}

		$response['crono'] = $crono->getTime(microtime(true), memory_get_usage());
		return $response;

	} // validatePassword



	/**
	 * Método que válida a duplicação de dados
	 * Verifica se o nome ou short_name existe na lista de usuários e bloqueia a duplicidade
	 *
	 * @since 0.1
	 * @access public
	 * @return array Os dados da base de dados
	 */
	public function checkDuplicate () {

		// temporizador para debug
		$crono = new ClockTimer;
		$crono->setTime(microtime(true), memory_get_usage());

		$response = array();

		$str = 'SELECT * FROM users WHERE (user = ? OR user_name = ?)';		

		// se update o indice user_id existe e adiciona à exclusão na pesquisa
		if (array_key_exists('user_id', $this->postForm))
			$str .= ' AND (user_id <> ' . $this->postForm['user_id'] . ')';

		$query = $this->db->query($str, array($this->postForm['user'], $this->postForm['user_name'] ));
		$result = $query->fetchAll();
		
		foreach ($result as $key => $value) {

			if ($value['user'] == $this->postForm['user']){
				$arr['type'] = 'warning'; $arr['from'] = 'user';
				$arr['title'] = 'Duplicidade de informação';
				$arr['message'] = 'Já existe um usuário <strong>' . $this->postForm['user'] . '</strong> no sistema.';			
				$response['toast'][] = $arr;
			}

			if ($value['user_name'] == $this->postForm['user_name']){
				$arr['type'] = 'warning'; $arr['from'] = 'user_name';
				$arr['title'] = 'Duplicidade de informação';
				$arr['message'] = 'Já existe um usuário de nome <strong>' . $this->postForm['user_name'] . '</strong> no sistema.';			
				$response['toast'][] = $arr;
			}
			
			$response['duplicateError']=true;
			$response['crono'] = $crono->getTime(microtime(true), memory_get_usage());
		 	return $response;

		}

		$response['duplicateOk']=true;
		$response['crono'] = $crono->getTime(microtime(true), memory_get_usage());
	 	return $response;

	} // checkDuplicate



	/**
	 * Método que válida a senha atual do usuario para alteração
	 * Verifica se old_password é o mesmo do banco de dados
	 *
	 * @since 0.3
	 * @access public
	 * @return array Os dados do processo
	 */
	public function checkPassword () {

		// temporizador para debug
		$crono = new ClockTimer;
		$crono->setTime(microtime(true), memory_get_usage());

		$response = array();

		// define a pesquisa
		$str = 'SELECT user_password FROM users WHERE (user_id = ?)';

		// executa a pesquisa
		$query = $this->db->query($str, array($this->postForm['user_id']) );
		$result = $query->fetch();

		// encontrando a senha do usuario
		if ($result){

			// instancia um novo objeto da class PasswordHash
			$ps = new PasswordHash(8, false);
			
			// Verifica o password, se verdadeiro
			if ($ps->CheckPassword( $this->postForm['old_password'], $result['user_password'])){
				
				$response['passwordOk']=true;

				// se não
			} else {

				$arr['type'] = 'error'; $arr['from'] = 'old_password';
				$arr['title'] = 'Senha Inválida';
				$arr['message'] = 'A senha atual informada é inválida.';			
				$response['toast'][] = $arr;
				$response['passwordError']=true;

			}

		} else {

			$arr['type'] = 'error'; $arr['from'] = 'old_password';
			$arr['title'] = 'Usuário não encontrado';
			$arr['message'] = 'Atualize a página e tente novamente!';			
			$response['toast'][] = $arr;
			$response['passwordError']=true;

		}

		$response['crono'] = $crono->getTime(microtime(true), memory_get_usage());
		return $response;

	} // checkPassword



	/**
	 * Método que válida a autoridade para alteração
	 * Verifica se o usuário logado possuí autoridade para alterar o
	 * usuário solicitado ou se tem permissão para inserção de usuário
	 *
	 * @since 0.1
	 * @access public
	 * @return array Os dados da base de dados
	 */
	public function checkHierarchy ($profile = true) {

		// temporizador para debug
		$crono = new ClockTimer;
		$crono->setTime(microtime(true), memory_get_usage());

		$response = array();

		// se a checagem é profile, então a atualização deve ser do usuario logado
		if (true == $profile){

			// verifica se o usuário do form é o mesmo logado
			if ($this->postForm['user_id'] == $_SESSION['userdata']['user_id']){

				// verifica se existe a key user no array, ou seja, é atualização de dados
				if (array_key_exists("user", $this->postForm) ) {

					// não permite alteração do nome de usuario
					if ($this->postForm['user'] <> $_SESSION['userdata']['user']){
						$arr['type'] = 'critical'; $arr['from'] = 'user';
						$arr['title'] = 'Ação não permitida';
						$arr['message'] = 'Você não tem permissão para alterar o seu nome de usuário.';			
						$response['toast'][] = $arr;
					}

					// não permite alteração do grupo de usuario
					if ($this->postForm['user_group'] <> $_SESSION['userdata']['user_group']){
						$arr['type'] = 'critical'; $arr['from'] = 'user';
						$arr['title'] = 'Ação não permitida';
						$arr['message'] = 'Você não tem permissão para alterar o seu grupo de usuário.';			
						$response['toast'][] = $arr;
					}

					// elimino as variaveis user e user_group do sistema para não passar no update
					unset($this->postForm['user']);
					unset($this->postForm['user_group']);

				// se não possuí o user, verifica se possuí a key de senha
				} else if (array_key_exists("old_password", $this->postForm) ) {
					// remove os indices não necessários na atualização
					unset($this->postForm['user_group']);
					unset($this->postForm['old_password']);

				// se não possuí as keys de verificação
				} else {
					$arr['type'] = 'critical'; $arr['from'] = 'user';
					$arr['title'] = 'Ação não permitida';
					$arr['message'] = 'Você não tem permissão para executar esta ação. nada';			
					$response['toast'][] = $arr;
					print_r($this->postForm);
				}	

			// não é o usuario logado
			} else {
				$arr['type'] = 'critical'; $arr['from'] = 'user';
				$arr['title'] = 'Ação não permitida';
				$arr['message'] = 'Você não tem permissão para executar esta ação.';			
				$response['toast'][] = $arr;
			}

		} else {
			// caso não seja atualização de profile 
		}// if $profile


		// se tiver algum erro, retorno o erro
		if ($response) {
			$response['hierarchyError']=true;
		}else{
			$response['hierarchyOk']=true;
		}
		
		$response['crono'] = $crono->getTime(microtime(true), memory_get_usage());
	 	return $response;

	} // checkHierarchy

	
	/**
	 * Método de atualização dos dados do usuário
	 * Atualiza os dados após todos os processos de validação
	 *
	 * @since 0.1
	 * @access public
	 * @return array Os dados da base de dados
	 */
	public function update () {

		// temporizador para debug
		$crono = new ClockTimer;
		$crono->setTime(microtime(true), memory_get_usage());

		$response = array();

		$ret = $this->db->update('users', 'user_id', $this->postForm['user_id'], $this->postForm);
		
		// se o retorno é false, então houve algum erro
		if ($ret == false){
			$arr['type'] = 'critical'; $arr['from'] = '';
			$arr['title'] = 'Erro inesperado';
			$arr['message'] = 'Contate o suporte primenote para verificação.';			
			$response['toast'][] = $arr;
			$response['updateError']=true;
		} else {
			$arr['type'] = 'success'; $arr['from'] = '';
			$arr['title'] = 'Atualizado';
			$arr['message'] = 'Os dados foram atualizados com sucesso.';			
			$response['toast'][] = $arr;
			$response['updateOk']=true;
		}

		$response['crono'] = $crono->getTime(microtime(true), memory_get_usage());
	 	return $response;

	} // update
	
	
} // ProfileModel