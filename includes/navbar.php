<div class="navbar navbar-inverse navbar-fixed-top container-fluid" role="navigation">
    <div class="navbar-container">
        
        <div class="nav navbar-header">
            <a href="<?php echo HOME_URI; ?>" class="navbar-brand">
                <img src="<?php echo HOME_URI; ?>/img/primenote-inverse.png" style="height:25px;" />
            </a>
            <button type="button" class="navbar-toggle btn-primary" data-toggle="collapse" data-target=".menu">
                <span class="sr-only">Menu</span>
                <span class="fa fa-bars fa-lg"></span>
            </button>
        </div>
        

        <div class="navbar-right" role="navigation">

            <div class="navbar-collapse menu collapse">
                <ul class="nav navbar-nav">

                    <li <?php echo $this->nav == 'dashboard' ? 'class="active"' : ''; ?>>
                        <a href="<?php echo HOME_URI; ?>/dashboard" 
                            class="dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-home"></span> Home</a>
                    </li>

                    
                    <li <?php echo $this->nav == 'usuario' ? 'class="active"' : ''; ?>><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-user"></span> Usuários</a>
                    	<ul class="dropdown-menu">
                        	<li class="dropdown-header">Cadastro</li>
                            <li <?php echo $this->nav_item == 'usuario-add' ? 'class="active"' : ''; ?>><a href="usuario-add.php">Adicionar Usuários</a></li>
                            <li <?php echo $this->nav_item == 'usuario-alt' ? 'class="active"' : ''; ?>><a href="usuario-alt.php">Alterar Usuários</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                    
            
                    
                    <?php // pegar o ícone do usuário para o sistema
						$iconUser = '';
						switch($_SESSION['userdata']['user_group']){
							case 0: $iconUser = 'fa-qq'; break;
							case 2: $iconUser = 'fa-paper-plane'; break;
							case 3: $iconUser = 'fa-briefcase'; break;
							case 4: $iconUser = 'fa-graduation-cap'; break;
						}
					?>
                    <li <?php echo $this->nav == 'profile' ? 'class="active"' : ''; ?>><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa <?php echo $iconUser; ?>"></span> <span id="MEUNOME"><?php echo $_SESSION['userdata']['user_short_name']; ?></span></a>
                    	<ul class="dropdown-menu">
                        	<li class="dropdown-header">Meu Perfil</li>
                            <li <?php echo $this->nav_item == 'profile-about' ? 'class="active"' : ''; ?>><a href="<?php echo HOME_URI; ?>/profile">Meus Dados</a></li>
                            <li <?php echo $this->nav_item == 'profile-password' ? 'class="active"' : ''; ?>><a href="<?php echo HOME_URI; ?>/profile/password">Minha Senha</a></li>
                            <li class="divider"></li>
                            
                            <li><a href="<?php echo HOME_URI . '/login/exiting' ?>">Sair</a></li>
                        </ul>
                    </li>
                    

                </ul>
            </div>
            
        </div>
        
    </div>
</div>