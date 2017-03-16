<?php
/**
 * Abre as configurações de dados, senha e informações do usuário logado
 *
 * @package primenote
 * @since 4.0.2 | 16/03/2017
 */

class ProfileController extends MainController{

	// obriga o login
	public $login_required = false;

	// exige uma permissão para acesso
	public $permission_required;


	/** Método Index http://dominio/profile **/ 
	public function index() {

		// Verifica se o usuário está logado, senão direciona para o login
		if ( ! $this->logged_in ) {
			$this->logout();
			$this->goto_login();
			return;
		}

		// Título da página
		$this->title = 'Meus dados de acesso';
		$this->nav = 'profile';
		$this->nav_item = 'profile-about';
		
		// Parametros da função
		// $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
		/** Carrega o arquivo do model **/
		$profile = $this->load_model('profile-model');
		
		/** Carrega os arquivos do view **/
		// Incluí o header da página
        require ABSPATH . '/includes/header.php';

        // Incluí o menu principal da página
        require ABSPATH . '/includes/navbar.php';
		
		// /views/home/home-view.php
        require ABSPATH . '/views/profile-about-view.php';

        // /views/home/home-view.php
        //require ABSPATH . '/includes/bar-profile.php';
		
		// Incluí o footer da página
        require ABSPATH . '/includes/footer.php';

	} // index()


	/** Método ADM http://dominio/profile/update **/ 
	public function update() {

		// Verifica se o usuário está logado, senão direciona para o login
		if ( ! $this->logged_in ) {
			$this->logout();
			$this->goto_login();
			return;
		}

		// Parametros da função
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
		/** Carrega o arquivo do model **/
		$user = $this->load_model('users-model'); 

		//valida os dados do form
		$validate = $user->validateForm(false);
		if (array_key_exists('validateError',$validate)){
			RetornaJSON($validate);
			return;
		}

		// valida se tem nomes duplicados
		$duplicate = $user->checkDuplicate();
		if (array_key_exists('duplicateError',$duplicate)){
			RetornaJSON($duplicate);
			return;
		}
		
		// verifica se tem permissão para atualizar
		$hierarchy = $user->checkHierarchy();
		if (array_key_exists('hierarchyError', $hierarchy)){
			RetornaJSON($hierarchy);
			return;
		}

		// atualiza os dados
		$update = $user->update();

		// atualiza os dados da Session
		$_SESSION['userdata']['user_name'] = $user->postForm['user_name'];
		$_SESSION['userdata']['user_short_name'] = $user->postForm['user_short_name'];

		// retorna o tempo de execução com o debug
		if (DEBUG == true){
			$update['validadeStatus'] = $validate['crono'];
			$update['checkDuplicateStatus'] = $duplicate['crono'];
			$update['checkHierarchyStatus'] = $hierarchy['crono'];
			$update['updateStatus'] = $update['crono'];
			unset($update['crono']);
		}
		
		echo RetornaJSON($update);
		return;

	} // update
	

	/** Método PASSWORD http://dominio/profile/password **/ 
	public function password() {
		
		// Verifica se o usuário está logado, senão direciona para o login
		if ( ! $this->logged_in ) {
			$this->logout();
			$this->goto_login();
			return;
		}

		// Título da página
		$this->title = 'Minha senha de acesso';
		$this->nav = 'profile';
		$this->nav_item = 'profile-password';
		
		// Parametros da função
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

		// Sem parametros mostra a view de alteração de senha
		if (null == $parametros){

			/** Carrega o arquivo do model **/
			$profile = $this->load_model('profile-model');
		
			/** Carrega os arquivos do view **/
			// Incluí o header da página
	        require ABSPATH . '/includes/header.php';

	        // Incluí o menu principal da página
	        require ABSPATH . '/includes/navbar.php';
			
			// /views/home/home-view.php
	        require ABSPATH . '/views/profile-password-view.php';

	        // /views/home/home-view.php
	        //require ABSPATH . '/includes/bar-profile.php';
			
			// Incluí o footer da página
	        require ABSPATH . '/includes/footer.php';

	    // se tiver o parametro, verifica e executa as suas ações
	    }else{

	    	// Executa apenas se existir o parametro update
			if (!chk_array( $parametros, 0 ) == 'update' ) {
				return;
			}

	    	/** Carrega o arquivo do model **/
			$user = $this->load_model('users-model'); 

			//valida os dados da senha
			$validate = $user->validatePassword();
			if (array_key_exists('validateError',$validate)){
				RetornaJSON($validate);
				return;
			}

			// valida a senha atual
			$checkpass = $user->checkPassword();
			if (array_key_exists('passwordError',$checkpass)){
				RetornaJSON($checkpass);
				return;
			}
			
			// verifica se tem permissão para atualizar
			$hierarchy = $user->checkHierarchy();
			if (array_key_exists('hierarchyError', $hierarchy)){
				RetornaJSON($hierarchy);
				return;
			}

			// atualiza os dados
			$update = $user->update();

			// retorna o tempo de execução com o debug
			if (DEBUG == true){
				$update['validadePasswordStatus'] = $validate['crono'];
				$update['checkPasswordStatus'] = $checkpass['crono'];
				$update['checkHierarchyStatus'] = $hierarchy['crono'];
				$update['updateStatus'] = $update['crono'];
				unset($update['crono']);
			}
			
			echo RetornaJSON($update);
			return;

	    }

	} // password


} // CONTROLEController