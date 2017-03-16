<?php
/**
 * Controle do Sistema de Login de Usuários
 *
 * @package primenote
 * @since 4.0 | 03/02/2017
 */

class LoginController extends MainController{


	/** Método Index http://dominio/LOGIN **/ 
    public function index() {
		// Título da página
		$this->title = 'Acessar o Primenote';

		// Verifica se o usuário está logado e direciona pra dashboard
		if ( $this->logged_in ) {
			$this->goto_page(HOME_URI . '/dashboard/');
			return;
		}
		
		// Parametros da função
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
		// Login não tem Model

		/** Carrega os arquivos do view **/
		// Incluí o header da página
        require ABSPATH . '/includes/header.php';
		
		// /views/home/login-view.php
        require ABSPATH . '/views/login-view.php';
		
    } // index



    /** Método Index http://dominio/LOGIN/LOGOUT **/ 
    public function exiting() {
		// Título da página
		$this->title = 'Saindo do Primenote';

		$this->logout();
		$this->goto_login();
		return;
		
    }


    public function adm() {
		// Page title
		$this->title = 'Gerenciar notícias';
		$this->permission_required = 'gerenciar-noticias1';
		
		// Verifica se o usuário tem a permissão para acessar essa página
		if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
			$this->logout();
			$this->goto_login();
			return;
		}
		
		echo 'entrou';
		
    } // adm
	

} // class LoginController