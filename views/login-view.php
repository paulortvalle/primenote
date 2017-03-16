<?php if ( ! defined('ABSPATH')) exit; ?>

<div class="space-lg"></div>
<div class="space-lg"></div>

<div class="container">
	<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4 col-md-2 col-md-offset-5 text-center">
		<img src="<?php echo HOME_URI; ?>/img/primenote.png" style="width:100%; max-width:200px;" />
	</div>
	<div class="col-xs-10 col-xs-offset-1 text-center">
		<p>EFETUAR ACESSO AO SISTEMA</p>
	</div>
</div><!-- /.container -->

<div class="space-md"></div>

<div class="container">

	<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
		<div class="jumbotron">
			
			<form method="post">

				<h5 class="text-center">Informe seu usuário e senha de acesso</h5>
				<div class="space-sm"></div>
				
				<div class="form-group">
					<input type="text" class="form-control" name="userdata[user]" placeholder="Usuário">
				</div>

				<div class="form-group">
					<input type="password" class="form-control" name="userdata[user_password]" placeholder="Senha">
				</div>

				<div class="col-xs-12 col-sm-3 col-lg-2"><div class="row">
					<input type="submit" class="btn btn-primary" value="Entrar"> 
				</div></div>

				<div class="col-xs-12 col-sm-9 col-lg-10">
					<?php
						if ( $this->login_error ) {
							echo '<div class="text-danger error">';
							echo '<i class="fa fa-exclamation-circle faa-flash animated" aria-hidden="true"></i> ';
							echo $this->login_error;
							echo '</div>';
						}
					?>
				</div>

			</form>

			<div class="space-sm"></div>

		</div><!-- .jumbotron -->
	</div>

</div><!-- .container -->


<div class="space-md"></div>


<div class="container">

	<div class="col-xs-8 col-xs-offset-2 col-sm-3 col-md-3 col-md-offset-2 logo-client text-right">
		<img src="<?php echo HOME_URI; ?>/img/logo-client.png" style="width:100%; max-width:150px;" />
	</div>
	
	<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-5">
		<p class="copyright">
			Copyright © 2010-<?php echo date("Y"); ?> Mundo Percepção. Todos os direitos reservados.<br/>
			Licenciado para uso exclusivo do Colégio Delta Nobre<br/>
			Rua José Matias, 499 - Tucura Mogi Mirim-SP CEP: 13.807-020<br/>
			Telefone: (19) 3806 2297 mail: contato@deltanobre.com.br
		</p>
	</div>

</div><!-- .container -->


<style>
	body {background-color: #fff;}
	.error {margin-top:7px;}
	.copyright {font-size:8px; margin-top:25px; color:#666;}
	@media (max-width: 767px) {
		.copyright {text-align:center;}
		.logo-client {text-align:center;}
	}
</style>

<!-- Não foi fechado porque o footer não é incluido neste controler -->
</body>
</html>