<?php if ( ! defined('ABSPATH')) exit; ?>

<?php
	
	// carrega os dados do usuário
	$dataProfile = $profile->getMyData();

?>

<div class="container">

	<div id="CONTENT" class="col-xs-11 col-xs-push-1">
		<div class="pageform">
			
	        <h1><span class="fa fa-user"></span> Meus Dados Pessoais</h1>
	        <h3 class="text-muted">Atualize seus dados na rede Primenote</h3>
	        
	        <div class="space-sm"></div>
	        
	        <form name="formProfile" class="form-horizontal" role="form" method="post">
	        
	            <div class="page-header">
	                <h4>Identificação <small><i class="fa fa-angle-double-right"></i> meus dados de acesso</small></h4>
	            </div>

	            <div class="form-group">
	                <label for="input_nome" class="col-md-2 control-label">Usuário:</label>
	                <div class="col-md-4">
	                	<input type="text" class="form-control" readonly 
	                    	name="user" value="<?php echo $dataProfile['user']; ?>" >
	                </div>
	                <div class="col-md-6 infoform"><small><span class="fa fa-info-circle"></span> Este é seu usuário para logar no Primenote.</small></div>
	            </div>
	            
	            <div class="form-group">
	                <label for="input_nome" class="col-md-2 control-label">Nome ou Apelido</label>
	                <div class="col-md-6">
	                    <input type="text" class="form-control" maxlength="16" placeholder="" 
	                    	name="user_short_name" value="<?php echo $dataProfile['user_short_name']; ?>" >
	                </div>
	            </div>
	            
	            <div class="form-group">
	                <label for="input_nome_full" class="col-md-2 control-label">Nome Completo</label>
	                <div class="col-md-9">
	                    <input type="text" class="form-control" maxlength="255" placeholder=""
	                    	name="user_name" value="<?php echo $dataProfile['user_name']; ?>" >
	                </div>
	            </div>
	            
	       
	            
	            
	            <div class="page-header">
	                <h4>Endereço <small><i class="fa fa-angle-double-right"></i> minha residência</small></h4>
	            </div>
	            
	            <div class="form-group">
	                <label for="input_endereco" class="col-md-2 control-label">Endereço</label>
	                <div class="col-md-8">
	                    <input type="text" class="form-control" maxlength="255" placeholder=""
	                    	name="user_address" value="<?php echo $dataProfile['user_address']; ?>">
	                </div>
	            </div>
	            
	            <div class="form-group">
	                <label for="input_bairro" class="col-md-2 control-label">Bairro</label>
	                <div class="col-md-5">
	                    <input type="text" class="form-control" maxlength="64" placeholder=""
	                    	name="user_unit" value="<?php echo $dataProfile['user_unit']; ?>">
	                </div>
	            </div>
	            
	            <div class="form-group">
	                <label for="input_cidade" class="col-md-2 control-label">Cidade</label>
	                <div class="col-md-5">
	                    <input type="text" class="form-control" maxlength="32" placeholder=""
	                    	name="user_city" value="<?php echo $dataProfile['user_city']; ?>">
	                </div>
	            </div>
	            
	            <div class="form-group">
	                <label for="input_cep" class="col-md-2 control-label">CEP</label>
	                <div class="col-md-4">
	                    <input type="text" class="form-control maskpostalcode" maxlength="9" placeholder="xxxxx-xxx"
	                    	name="user_postal_code" value="<?php echo $dataProfile['user_postal_code']; ?>">
	                </div>
	            </div>
	            
	            <div class="form-group">
	                <label for="input_uf" class="col-md-2 control-label">UF</label>
	                <div class="col-md-2">
	                    <input type="text" class="form-control maskstate" maxlength="2" placeholder=""
	                    	name="user_state" value="<?php echo $dataProfile['user_state']; ?>">
	                </div>
	            </div>
	            
	            
	            <div class="page-header">
	                <h4>Contatos <small><i class="fa fa-angle-double-right"></i> telefone, celular e e-mail alternativo</small></h4>
	            </div>
	            
	            <div class="form-group">
	                <label for="input_telefone" class="col-md-2 control-label">Telefone</label>
	                <div class="col-md-3">
	                    <input type="text" class="form-control no-radius maskphone" maxlength="16" placeholder=""
	                    	name="user_phone" value="<?php echo $dataProfile['user_phone']; ?>">
	                </div>
	            </div>
	            
	            <div class="form-group">
	                <label for="input_celular" class="col-md-2 control-label">Celular</label>
	                <div class="col-md-4">
	                    <input type="text" class="form-control no-radius maskcelphone" maxlength="16" placeholder="" 
	                    	name="user_celphone" value="<?php echo $dataProfile['user_celphone']; ?>" >
	                </div>
	            </div>
	            
	            <div class="form-group">
	                <label for="input_email" class="col-md-2 control-label">E-mail</label>
	                <div class="col-md-6">
	                    <input type="text" class="form-control" maxlength="64" placeholder=""
	                    	name="user_email" value="<?php echo $dataProfile['user_email']; ?>" >
	                </div>
	            </div>
	            
	   
	            
	            <input type="hidden" name="user_group" value="<?php echo $dataProfile['user_group']; ?>" />
	            <input type="hidden" name="user_id" value="<?php echo $dataProfile['user_id']; ?>" />
	            <div class="space-lg"></div>
	            
	            <div class="form-group">
	                <div class="col-md-offset-2 col-md-8">
	                    <button id="BtnUpdate" type="button" class="btn btn-primary no-radius">Alterar meus dados</button>
	                </div>
	            </div>
	            <div class="space-lg"></div>
	        </form>
	        
	    </div><!-- .pageform -->
	</div><!-- #CONTENT -->

	<div class="col-xs-1 col-xs-pull-11">
		<?php require ABSPATH . '/includes/bar-profile.php'; ?>
	</div>

	<script language="javascript">
		
		$(function(){
			
			// TOAST('loading', '', 'Carregando...');

			// Clicar para atualizar
			$('#BtnUpdate').on('click', function(){
				$.ajax({
					data: $('form[name="formProfile"]').serialize(), // + '&name=John&location=Boston',
					url: 'profile/update',
					type: 'POST',
					dataType: 'json',
					beforeSend: function(){
						$('input').parent().removeClass('has-error');
						TOAST('info', '', 'Enviando seus dados para a rede Primenote...');
					},
					error: function(){ TOAST('errorAjax', '', ''); },	
					fail: function(){ TOAST('errorAjax', '', ''); },
					success: function( $ret ){

						SHOWRETURN($ret);

						// TOAST('loading', '', 'foi...');
						
					},

					complete: function(){
						// TOAST('loading', '', 'complete...');
					} 
				}); // $.ajax
			}) //$('#BtnUpdate')
		})

	</script>

</div><!-- .container -->