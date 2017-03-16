<?php 
/**
 * Modelo de Controle do Perfil do Usuário (Profile)
 *
 * @package primenote
 * @since 4.0 | 14/02/2017
 */

class ProfileModel extends MainModel{

		/**
	 * Construtor para essa classe
	 *
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
	 * Pega os dados do usuário logado
	 *
	 * @since 0.1
	 * @access public
	 * @return array Os dados da base de dados
	 */
	public function getMyData () {
			
		// Faz a consulta
		$query = $this->db->query('SELECT * FROM users WHERE user_id = ' . $this->userdata['user_id']);
		
		// Retorna
		return $query->fetch();

	} // getMyData
	

	/**
	 * Pega os dados dos últimos 10 logins do usuário logado
	 *
	 * @since 0.1
	 * @access public
	 * @return array Os dados da base de dados
	 */
	public function getMyLogIns () {
			
		// Faz a consulta
		$query = $this->db->query('SELECT * FROM logins WHERE login_user_id = ' . $this->userdata['user_id'] . ' ORDER BY login_id DESC LIMIT 10');
		
		// Retorna
		return $query->fetchAll();
	} // getMyLogIns
	
	
} // ProfileModel