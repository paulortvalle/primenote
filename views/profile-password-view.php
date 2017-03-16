<?php if ( ! defined('ABSPATH')) exit; ?>

<?php
	
	// carrega os dados do usuário
	$dataProfile = $profile->getMyData();

?>

<div class="container">

	<div id="CONTENT" class="col-xs-11 col-xs-push-1">
		<div class="pageform">
			
	        <h1><span class="fa fa-user"></span> Minha Senha</h1>
	        <h3 class="text-muted">Atualize sua senha na rede Primenote</h3>
	        
	        <div class="space-sm"></div>
	        
	        <form name="formSenha" class="form-horizontal" role="form" method="post">
	        
	            <div class="page-header">
	                <h4>Senha Atual <small><i class="fa fa-angle-double-right"></i> informe sua senha atual de acesso</small></h4>
	            </div>

	            <div class="form-group">
	                <label for="input_nome" class="col-md-2 control-label">Senha Atual:</label>
	                <div class="col-md-4">
	                	<input type="password" class="form-control" maxlength="16" placeholder=""
	                    	name="old_password" value="" >
	                </div>
	            </div>
	            
	            

	            <div class="page-header">
	                <h4>Nova Senha <small><i class="fa fa-angle-double-right"></i> informe duas vezes a sua nova senha</small></h4>
	            </div>

	            <div class="form-group">
	                <label for="input_nome" class="col-md-2 control-label">Nova Senha:</label>
	                <div class="col-md-4">
	                	<input type="password" class="form-control" maxlength="16" placeholder=""
	                    	name="new_password_1" value="" >
	                </div>
	            </div>

	            <div class="form-group">
	                <label for="input_nome" class="col-md-2 control-label">Redigite:</label>
	                <div class="col-md-4">
	                	<input type="password" class="form-control" maxlength="16" placeholder=""
	                    	name="new_password_2" value="" >
	                </div>
	            </div>
	            
	            
	            <input type="hidden" name="user_group" value="<?php echo $dataProfile['user_group']; ?>" />
	            <input type="hidden" name="user_id" value="<?php echo $dataProfile['user_id']; ?>" />
	            <div class="space-lg"></div>
	            
	            <div class="form-group">
	                <div class="col-md-offset-2 col-md-8">
	                    <button id="BtnUpdate" type="button" class="btn btn-primary no-radius">Alterar minha senha</button>
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
					data: $('form[name="formSenha"]').serialize(), // + '&name=John&location=Boston',
					url: 'password/update',
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

						if (typeof $ret.updateOk != 'undefined'){

							// Executa a notificação de refresh da página pois o sistema fez logout
							iziToast.show({
								title: 'Atualização necessária',
								message : 'A sessão foi finalizada e você precisa realizar um novo login na rede.',
								layout: 1,
	        					timeout: 10000,
	        					position: 'center',
	        					drag: false,
	        					pauseOnHover: true,
		    					resetOnHover: true,
		    					transitionIn: 'bounceInDown',
		    					transitionOut: 'flipOutX',
		    					animateInside: false,
		    					backgroundColor: '#9198A8',
								titleColor: '#212E4D',
								iconColor: '#212E4D',
								messageColor: '#36425D',
								icon: 'fa fa-info-circle faa-vertical animated',

							    buttons: [
							        ['<button>Efetuar login</button>', function (instance, toast) {
							            instance.hide({
							                transitionOut: 'flipOutX',
							                onClose: function(instance, toast, closedBy){
							                    location.reload();
							                }
							            }, toast, 'close', 'btn2');
							        }]
							    ],
							    onOpen: function(instance, toast){
							        // open
							    },
							    onClose: function(instance, toast, closedBy){
							        location.reload(); // tells if it was closed by 'drag' or 'button'
							    }
							});

						} // $ret.updateOk
						
					},

					complete: function(){} // complete 

				}); // $.ajax
			}) //$('#BtnUpdate')
		})

	</script>

</div><!-- .container -->