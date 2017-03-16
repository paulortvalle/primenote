<?php
/**
 * Controle da área de Dashboard
 *
 * @package primenote
 * @since 4.0.2 | 07/02/2017
 */

class DashboardController extends MainController {

	/** Método Index http://dominio/CONTROLE **/ 
    public function index() {
		// Título da página
		$this->title = 'Bem-vindo ao painel Dashboard';
		$this->nav = 'dasboard';
		$this->nav_item = 'dashboard';
		
		// Parametros da função
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
		// Essa página não precisa de modelo (model)
		
		/** Carrega os arquivos do view **/
		
		// Incluí o header da página
        require ABSPATH . '/includes/header.php';

        // Incluí o menu principal da página
        require ABSPATH . '/includes/navbar.php';
		
		// /views/home/home-view.php
        require ABSPATH . '/views/dashboard-view.php';
		
		// Incluí o footer da página
        require ABSPATH . '/includes/footer.php';
		
    } // index()
	
} // class HomeController