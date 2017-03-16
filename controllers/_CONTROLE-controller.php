<?php
/**
 * FUNCAO
 *
 * @package primenote
 * @since 4.0 | DATA
 */

class CONTROLEController extends MainController{

	// obriga o login
	public $login_required = false;

	// exige uma permissão para acesso
	public $permission_required;


	/** Método Index http://dominio/CONTROLE **/ 
	public function index() {

		// Título da página
		$this->title = 'NOME';
		$this->nav = 'dasboard';
		$this->nav_item = 'dashboard';
		
		// Parametros da função
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
		/** Carrega o arquivo do model **/
		$modelo = $this->load_model('CONTROLE-model');
		
		/** Carrega os arquivos do view **/
		// Incluí o header da página
        require ABSPATH . '/includes/header.php';

        // Incluí o menu principal da página
        require ABSPATH . '/includes/navbar.php';
		
		// /views/home/home-view.php
        require ABSPATH . '/views/CONTROLE-view.php';
		
		// Incluí o footer da página
        require ABSPATH . '/includes/footer.php';

	} // index()


	/** Método ADM http://dominio/CONTROLE **/ 
	public function adm() {

		// Título da página
		$this->title = 'NOME';
		$this->nav = 'dasboard';
		$this->nav_item = 'dashboard';
		$this->permission_required = 'atributoAdm';

		// Verifica se o usuário está logado, senão direciona para o login
		if ( ! $this->logged_in ) {
			$this->logout();
			$this->goto_login();
			return;
		}

		// Verifica se o usuário tem a permissão para acessar essa página
		if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
			$this->logout();
			$this->goto_login();
			return;
		}
		
		// Parametros da função
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
		/** Carrega o arquivo do model **/
		$modelo = $this->load_model('CONTROLE-model');
		
		/** Carrega os arquivos do view **/
		// Incluí o header da página
        require ABSPATH . '/includes/header.php';

        // Incluí o menu principal da página
        require ABSPATH . '/includes/navbar.php';
		
		// /views/home/home-view.php
        require ABSPATH . '/views/CONTROLE-view.php';
		
		// Incluí o footer da página
        require ABSPATH . '/includes/footer.php';

	} // adm()
	

	/** Método OUTRAACAO http://dominio/CONTROLE/OUTRAACAO **/ 
	public function OUTRAACAO() {
		// código aqui
	}


} // CONTROLEController