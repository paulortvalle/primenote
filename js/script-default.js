/*
 * FUNÇÕES JS PADRÃO DO PRIMENOTE 4.0
 * Criado em 15 de fevereiro de 2017
 * Importado da versão 3.2
 * Versão 1 de 15 de fevereiro de 2017
 */

$(function(){
 	
	PREPARABARRA();
	$(window).resize(function(){ PREPARABARRA(); });
 	//BTNGROUP();
	//BTNMULTIGROUP();
	CREATEMASK();
	//LOADTOOLTIP();

});

// FUNÇÃO QUE ATIVA O ABRE E FECHA A BARRA DE ITENS
function PREPARABARRA(){
	
	$('#OPEN').click(function(){
		$('#BAR').addClass('opened');
	})
	
	$('#CLOSE').click(function(){
		$('#BAR').removeClass('opened');
	})
	
	$('#BAR').css({ 'minHeight': 0, 'maxHeight':0, 'height':0 });
	$('#BAR .bar-itens').css({ 'minHeight': 0, 'maxHeight':0, 'height':0 });
	//$('#CONTENT').css({ 'minHeight': 0, 'maxHeight':0, 'height':0 });

	var altura = $(window).height(); 
	var alturad = altura-50;
	var alturaheader = $('#BAR .bar-header').height();
	var alturaitens = alturad-alturaheader;

	var largura = $(document).width();
	if (largura > 500) largura = 500;
	var largurad = 50-largura;
	
	$('#BAR').css({ 'minWidth': largura, 'maxWidth':largura, 'left':largurad });
	$('#BAR').css({ 'minHeight': alturad, 'maxHeight':alturad, 'height':alturad });
	$('#BAR .bar-itens').css({ 'minHeight': alturaitens, 'maxHeight':alturaitens, 'height':alturaitens });
	//$('#CONTENT').css({ 'minHeight': alturad, 'maxHeight':alturad, 'height':alturad });

}
// FUNÇÃO QUE ATIVA O ABRE E FECHA A BARRA DE ITENS



// FUNÇÃO QUE ATIVA O SISTEMA DE SELEÇÃO DOS BOTOES
function BTNGROUP(){
	$('.bgroup button').on("mousedown", function(){
		var $meuid = $(this).data("id");
		$(this).parent().find('button').removeClass('active');
		$(this).addClass('active');
		$(this).parent().parent().find('input').val( $meuid );
	})
}
// FUNÇÃO QUE ATIVA O SISTEMA DE SELEÇÃO DOS BOTOES



// FUNÇÃO QUE ATIVA O SISTEMA DE SELEÇÃO DOS BOTOES MULTIPLOS
function BTNMULTIGROUP(){
	$('.bmultigroup button').on("mousedown", function(){
		if ($(this).hasClass('active')){
			$(this).removeClass('active');
			$(this).parent().parent().find('input[value='+$(this).data("id")+']').remove();
		} else {
			$(this).addClass('active');
			$(this).parent().parent().append('<input name="multi[]" type="hidden" value="'+$(this).data("id")+'" />');
		}
	})
}
// FUNÇÃO QUE ATIVA O SISTEMA DE SELEÇÃO DOS BOTOES MULTIPLOS



// FUNÇÃO DE CRIAÇÃO DE MASCARA PARA CAMPOS NUMERICOS
function CREATEMASK(){
	
	$('.maskphone').mask("(99) 9999-9999");
	$('.maskcelphone').mask("(99) 9 9999-9999");
	$('.maskstate').mask("aa");
	$('.maskpostalcode').mask("99999-999");
	$('.maskcpf').mask("999.999.999-99");
	
};
// FUNÇÃO DE CRIAÇÃO DE MASCARA PARA CAMPOS NUMERICOS



// FUNÇÃO QUE DESTACA ITENS NO MENU DE CONTEXTO
function DESTACA($obj, $classe){
	$('.barra-itens').animate({scrollTop : 0},800, 'swing');
	$obj.addClass($classe);
	setTimeout(function(){ $obj.removeClass($classe); }, 8000);
}
// FUNÇÃO QUE DESTACA ITENS NO MENU DE CONTEXTO



// FUNÇÃO QUE ATIVA O TOOLTIP DE TODO O FORM
function LOADTOOLTIP(){
	$('body').find('[data-toggle="tooltip"]').tooltip();
}
// FUNÇÃO QUE ATIVA O TOOLTIP DE TODO O FORM



// PNNOTITY: FUNÇÃO QUE CRIA AS MENSAGENS DO PNOTIFY
function TOAST($type, $title, $message){
	
	var opts = {
        title: $title,
        message: $message,
        layout: 2,
        timeout: 5000,
        position: 'center',
        drag: false,
        pauseOnHover: true,
	    resetOnHover: true,
	    transitionIn: 'bounceInDown',
	    transitionOut: 'flipOutX',
	    animateInside: false,
    };
	
	switch ($type) {
		case 'default':
			opts.backgroundColor = '#e2e2e2';
			opts.titleColor = '#333333';
			opts.iconColor = '#333333';
			opts.messageColor = '#666666';
			opts.icon = 'fa fa-coffee';
			opts.onOpen = function () {};
			break;
		case 'info':
			opts.backgroundColor = '#9198A8';
			opts.titleColor = '#212E4D';
			opts.iconColor = '#212E4D';
			opts.messageColor = '#36425D';
			opts.icon = 'fa fa-info-circle faa-vertical animated';
			break;
		case 'warning':
			opts.backgroundColor = '#FBEED4';
			opts.titleColor = '#725A29';
			opts.iconColor = '#725A29';
			opts.messageColor = '#8A754A';
			opts.icon = 'fa fa-exclamation-triangle faa-flash animated';
			break;
		case 'error':
			opts.backgroundColor = '#FBD4D4';
			opts.titleColor = '#722929';
			opts.iconColor = '#722929';
			opts.messageColor = '#8A4A4A';
			opts.icon = 'fa fa-times-circle-o faa-ring animated';
			break;
		case 'success':
			opts.backgroundColor = '#AAC9AA';
			opts.titleColor = '#215C21';
			opts.iconColor = '#215C21';
			opts.messageColor = '#3B6F3B';
			opts.icon = 'fa fa-check-circle-o faa-pulse animated';
			break;
		case 'loading':
			opts.backgroundColor = '#FBEED4';
			opts.titleColor = '#725A29';
			opts.iconColor = '#725A29';
			opts.messageColor = '#8A754A';
			opts.icon = 'fa fa-spinner fa-spin';
			break;
		case 'critical':
			opts.backgroundColor = '#FBD4D4';
			opts.titleColor = '#722929';
			opts.iconColor = '#722929';
			opts.messageColor = '#8A4A4A';
			opts.timeout = false;
			opts.icon = 'fa fa-times-circle-o faa-tada animated';
			break;
		break;
		case 'errorAjax':
			opts.title = 'Erro de Solicitação!';
        	opts.message = 'Não é possível realizar solitações ou enviar dados para a nuvem!<br/>Verifique sua conexão com a internet e tente novamente!';
			opts.backgroundColor = '#FBD4D4';
			opts.titleColor = '#722929';
			opts.iconColor = '#722929';
			opts.messageColor = '#8A4A4A';
			opts.icon = 'fa fa-times-circle-o faa-pulse animated';
			break;
		}
	
    iziToast.show(opts);

};
// PNNOTITY: FUNÇÃO QUE CRIA AS MENSAGENS DO PNOTIFY



// FUNÇÃO QUE EXIBE AS INFORMAÇÕES DE ERRO DE VALIDAÇÃO
function SHOWRETURN($value){
	$.each($value.toast, function(key, valor){
		TOAST(valor.type, valor.title, valor.message);
		if (valor.from)
			$('input[name='+valor.from+']').parent().addClass('has-error');
	});
}
// FUNÇÃO QUE EXIBE AS INFORMAÇÕES DE ERRO DE VALIDAÇÃO



// FUNÇÃO QUE CRIA A MENSAGEM DE CONFIRMAÇÃO DE EXCLUSÃO
function CONFDELNOTIFY ($tipo, $titulo, $areaID) {
	
	/*$type = default, info, error, success */
	var opts = {
        title: $titulo,
        text: $($areaID).html(),
        addclass: "stack-topright",
		shadow: false,
		width: '400px',
		styling: 'bootstrap2',
		hide: false,
   		buttons: {
        	closer: false,
        	sticker: false
    	},
    	insert_brs: false
    };
	
	switch ($tipo) {
		case 'default':
			opts.addclass = "btn-primary";
			opts.icon = "fa fa-check-circle fa-lg";
			break;
		case 'info':
			opts.addclass = "btn-primary";
			opts.icon = "fa fa-info-circle fa-lg";
			break;
		case 'error':
			opts.addclass = "btn-danger";
			opts.icon = "fa fa-times-circle fa-lg";
			break;
		case 'success':
			opts.addclass = "btn-success";
			opts.icon = "fa fa-check-circle fa-lg";
			break;
		case 'loading':
			opts.addclass = "btn-primary";
			opts.icon = "fa fa-refresh fa-lg fa-spin";
			break;
		}
	
    var loader = new PNotify(opts);
	return loader;
};
// FUNÇÃO QUE CRIA A MENSAGEM DE CONFIRMAÇÃO DE EXCLUSÃO



// FUNÇÃO QUE CARREGA OS DADOS DOS FORMS PARA ALTERAÇÃO
function loadInputs($dados){
	
	$.each($dados, function(key, valor){
		$('input[name='+key+']').val(valor);
	});
	
}
// FUNÇÃO QUE CARREGA OS DADOS DOS FORMS PARA ALTERAÇÃO




////////////////////////////////////////////////////////////////////////////////////////
//////////      - - - FUNÇÕES DE APOIO AO CORE - PRIMENOTE 3.1 - - -     ///////////////
////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////
///     - - -    BLOCO ESCOLAS    - - -     ///
///////////////////////////////////////////////



// FUNÇÃO PADRÃO QUE CARREGA LISTA DE ESCOLAS CADASTRADOS DO MENU DE ITENS
function defaultListaEscolas(){
	
	buscaEscolas();
	
	// executa a função do exibir mais
	$('.resultadopesquisa .exibirmais').on('click', function(){
		var $next = $('#next-item').val();
		buscaEscolas($next); 
	});
	
	// efetua a pesquisa de usuarios
	var formFIND = $('form[name="formFIND"]');
	formFIND.submit(function(){
		
		formFIND.find('input[name=query]').val(formFIND.find('input[name=Pesquisa]').val());
		buscaEscolas();
		
		return false;
		
	});
	
}
// FUNÇÃO PADRÃO QUE CARREGA LISTA DE ESCOLAS CADASTRADOS DO MENU DE ITENS



// FUNÇÃO COMPLEMENTAR QUE EFETUA O AJAX DAS ESCOLAS CADASTRADOS
function buscaEscolas($next, $single, $callback){
	
	//pega os dados do sistema de pesquisa
	var query 		= $('form[name=formFIND] input[name=query]').val();
	if (typeof $next == 'undefined'){ $next = 0 }
	if (typeof $single == 'undefined'){ $single = 0 }

	// solicita os dados por ajax 
	$.ajax({
		data: '&call=busca-escolas&query='+query+'&nextitem='+$next+'&escola_id='+$single,
		url: 'control/escola.php',
		type: 'POST',
		dataType: "json",
		beforeSend: '', error: function(){ PNNOTAJAX(); },
		success: function( resp ){
			
			if (typeof resp.error != 'undefined'){
				$.each(resp.error, function(key, valor){
					PNNOTIFY(valor.tipo, valor.titulo, valor.mensagem);
				});
			} else {
				
				if ($single == 0) { // verifica se está puxando apenas uma escola ou a lista
					if ($next == 0) { $('.lista-item').html(''); } // se o next for zero limpo a lista para listar novos resultados
					listaEscolas(resp, 'lista-geral', $callback ? $callback : null);
				} else {
					listaEscolas(resp, 'lista-single', $callback ? $callback : null);
				}
			}
			
		},
		complete: function(){
			
			// verifica se o usuário de alteração está na lista
			var $altini = $('form[name="formALT"] input[name=id]').val();
			if ($altini > 0) {
				var $enc = $('ul.lista-item').find('li[data-id="'+$altini+'"]').length;
				if ( $enc == 0) {
					var abrecall = function(){
						$('ul.lista-item li[data-id="'+$altini+'"]').addClass('active');
						$('.resultadopesquisa .info').html('Usuário aberto para alteração!');
					};
					buscaUsuarios(0,$altini,abrecall);
					
				} else {
					$('ul.lista-item li[data-id="'+$altini+'"]').addClass('active').prependTo('ul.lista-item');
				}
			}
				
		},
	});

	
	return false;	
	
}
// FUNÇÃO COMPLEMENTAR QUE EFETUA O AJAX DAS ESCOLAS CADASTRADOS



// FUNÇÃO QUE LISTA AS ESCOLAS DA BUSCA NO CONTROLE
function listaEscolas($dados, $action, $callback){
	
	if ($dados.info.counttot == 0) {
		$('.resultadopesquisa .info').html('nenhuma escola encontrada!');
		$('.resultadopesquisa .exibirmais').hide();
		$('.resultadopesquisa .carregando').hide();
		$('.barra-itens .empty').show('slow');
		$('.lista-item').html('');
		return false;
	}
	
	$('.barra-itens .empty').hide('slow');
	var $info = '';  // variavel para exibir no campo de informações do resultado
	
	// função que carrega dos dados na lista
	$.each($dados.dados, function(key, valor){
		
		// verifica se o item ja existe
		var $enc = $('ul.lista-item').find('li[data-id="'+valor.id+'"]').length;
		if ( $enc > 0) {
			return false;
		};
		
		// adiciona o novo item na lista
		$itt = $('#LIESCOLA').clone() 
		$itt.find('.titulo').html(valor.nome);
		$itt.find('.subtitulo').html('<i class="fa fa-compass"></i> '+valor.endereco+' - '+valor.bairro);
		$itt.find('.info').html('<i class="fa fa-phone"></i> '+valor.telefone);
		$itt.find('.info').append('  <i class="fa fa-envelope padding-sm-left"></i> '+valor.email);
		$itt.find('li').attr('data-id',valor.id);
		
		// executa as inserções de acordo com o action
		switch($action){
			case 'lista-geral':
				$('.lista-item').append($itt.html());
				$info = 'Exibindo ' + $dados.info.count + ' escolas de ' + $dados.info.counttot + ' encontradas!';
			break;
			
			case 'lista-single':
				$('.lista-item').prepend($itt.html());
			break;
		}
		
	});
	
	$('.resultadopesquisa .info').html($info);
	if (typeof $dados.info.nextitem != 'undefined'){
		$('.resultadopesquisa .exibirmais').attr('data-nextitem',$dados.info.nextitem).show();
		$('#next-item').val($dados.info.nextitem);
	} else {
		$('.resultadopesquisa .exibirmais').hide();
		$('#next-item').val(0);
	}
	
	$('.resultadopesquisa .carregando').hide();
	$callback ? $callback() : null 
	
}
// FUNÇÃO QUE LISTA AS ESCOLAS DA BUSCA NO CONTROLE



// FUNÇÃO QUE BUSCA DOS DADOS DA ESCOLA PARA PREENCHER NO FORM
function abreEscola($escolaID){
	// executa o ajax
	$.ajax({
		data: 'call=pega-escola-id&escolaid='+$escolaID,
		url: 'control/escola.php',
		type: 'POST',
		dataType: 'json',
		beforeSend: function(){
			$('#BTALT').attr("disabled", "disabled"); 
			$pntitulo = 'Carregando...';
			$pnmsg = 'Carregando dados da escola para alteração!';
			PNNOTIFY('loading', $pntitulo, $pnmsg);
		},
		error: function(){ PNNOTAJAX(); },	
		success: function( resp ){
			
			if (typeof resp.error != 'undefined'){
				$.each(resp.error, function(key, valor){
					PNNOTIFY(valor.tipo, valor.titulo, valor.mensagem);
					$('ul.lista-item li').removeClass('active');
				});
				$('.resultadopesquisa .info').html('Acesso Negado!');
			} else {
				
				loadInputs(resp.dados);
				
				$('#BLOCKALT').html('<footer>confirma alteração de dados da escola:</footer>')
					.append('<h4><span class="fa fa-check-square-o"></span> '+resp.dados.nome+'</h4>')
					.slideDown('slow');
				$('#BTALT').removeAttr("disabled", "disabled");	
				
				// verifica se o form está visualizado
				var disp = $('form[name="formALT"]').css('display');
				if( disp == 'none' ) {
					$('form[name="formALT"]').slideDown('slow');
					$('#InfoSel').slideUp('fast');
				}
				$('.resultadopesquisa .info').html('Escola aberta para alteração!');
				setTimeout(function(){ $('#BARRA').removeClass('aberto'); }, 800);
			}
			
		},
	});
}
// FUNÇÃO QUE BUSCA DOS DADOS DA ESCOLA PARA PREENCHER NO FORM


// FUNÇÃO QUE BUSCA DOS DADOS DA ESCOLA PARA PREENCHER NO FORM DE GESTORES
function abreGestores($escolaID){
	// executa o ajax
	$.ajax({
		data: 'call=lista-gestores&escolaid='+$escolaID,
		url: 'control/escola.php',
		type: 'POST',
		dataType: 'json',
		beforeSend: function(){
			$pntitulo = 'Carregando...';
			$pnmsg = 'Carregando dados de gestores da escola!';
			PNNOTIFY('loading', $pntitulo, $pnmsg);
			$('.carregandoitem').fadeIn('fast');
		},
		error: function(){ PNNOTAJAX(); },	
		success: function( resp ){
			
			if (typeof resp.error != 'undefined'){
				$.each(resp.error, function(key, valor){
					PNNOTIFY(valor.tipo, valor.titulo, valor.mensagem);
					$('ul.lista-item li').removeClass('active');
				});
				$('.resultadopesquisa .info').html('Acesso Negado!');
			} else {
				
				$('#BLOCKALT').html('<h4><span class="fa fa-check-square-o"></span> '+resp.escola[0].nome+'</h4>')
					.slideDown('slow');	

				// adiciona a lista de gestores do retorno
				$('#LISTA').html("");

				$ith = $('#LIHGESTORES').clone()
				$ith.find('.info').html(resp.info.title);
				$('#LISTA').append($ith.html());

				if (resp.info.count == 0){
					$('.nenhumitem').show('fast');
				} else {
					$.each(resp.dados, function(key, valor){
						
						$itt = $('#LIGESTORES').clone();
						$itt.find('.info').html(valor.nome);
						$itt.find('button').attr('data-rule',valor.rule);
						$itt.find('button').attr('data-id', valor.id);
						
						$('#LISTA').append($itt.html());
						
					})
					$('.nenhumitem').hide('slow');
				}

				// verifica se o form está visualizado
				var disp = $('form[name="formGestores"]').css('display');
				if( disp == 'none' ) {
					$('form[name="formGestores"]').slideDown('slow');
					$('#InfoSel').slideUp('fast');
				}
				$('.resultadopesquisa .info').html('Escola aberta para controle de gestores!');
				setTimeout(function(){ $('#BARRA').removeClass('aberto'); }, 800);
			}
			
		},

		complete: function(){
			LOADTOOLTIP();
			$('.carregandoitem').fadeOut('fast');
			BTRemoveGestores();
		} 
	});
}
// FUNÇÃO QUE BUSCA DOS DADOS DA ESCOLA PARA PREENCHER NO FORM



// FUNÇÃO DE EXCLUSÃO DE GESTORES HABILITADAS DEPOIS DA INCLUSÃO
function BTRemoveGestores(){

	$('#LISTA button').on('click', function(){
		
		PNotify.removeAll();
		
		//pega os dados de confirmação
		var rule = $(this).data('rule');
		var token = $('input[name=token]').val();
		var escolaid = $('input[name=id]').val();
		var userid = $(this).data('id');
		
				
		// cria o sistema de confirmação	
		msgCONFdel = CONFDELNOTIFY('default', 'Confirmar Exclusão de Gestor', '#confDELgestor');
		msgCONFdel.get().find('form.pf-form').on('click', '[name=cancelimg]', function() {
			msgCONFdel.remove(); // cria a função de cancelar
		}).on('click', '[name=submit]', function() {
							
			// cria a função de verificar
			var confDel = msgCONFdel.get().find('input[name=confirmaDel]').val();
			if (confDel == 'excluir gestor desta escola') {
								
				//executa a solicitação de exclusão por ajax
				$.ajax({
					data: '&call=remove-gestor&rule='+rule+'&escolaid='+escolaid+'&userid='+userid+'&token='+token,
					url: 'control/escola.php',
					type: 'POST',
					dataType: 'json',
					error: function() { msgCONFdel.remove(); PNNOTAJAX(); },	
					success: function( resp ){
										
						if (typeof resp.error != 'undefined'){
					
							$.each(resp.error, function(key, valor){
								PNNOTIFY(valor.tipo, valor.titulo, valor.mensagem);
							});
					
						} else {
							
							$.each(resp.success, function(key, valor){
								PNNOTIFY(valor.tipo, valor.titulo, valor.mensagem);
							});
							
						}
										
						msgCONFdel.remove();		
					},
					complete: function(){ abreGestores(escolaid); },
				});
								
			} else {
				
				// se a mensagem de confirmação for inválida
				msgCONFdel.remove();
				$pntitulo = 'Confirmação Inválida';
				$pnmsg = 'O gestor não pode ser excluído desta escola pois a mensagem de confirmação é inválida!';
				PNNOTIFY('error', $pntitulo, $pnmsg);

			}
							
		});
		
		
		
	})
	
}
// FUNÇÃO DE EXCLUSÃO DE GESTORES HABILITADAS DEPOIS DA INCLUSÃO



///////////////////////////////////////////////
///     - - -     BLOCO TURMAS    - - -     ///
///////////////////////////////////////////////


// FUNÇÃO QUE BUSCA DOS DADOS DA ESCOLA PARA PREENCHER NO FORM DE TURMAS-ADD
function abreTurmasAdd($escolaID){
	// executa o ajax
	$.ajax({
		data: 'call=lista-turmas&escolaid='+$escolaID,
		url: 'control/escola.php',
		type: 'POST',
		dataType: 'json',
		beforeSend: function(){
			$pntitulo = 'Carregando...';
			$pnmsg = 'Carregando dados de turmas da escola!';
			PNNOTIFY('loading', $pntitulo, $pnmsg);
			$('.carregandoitem').fadeIn('fast');
		},
		error: function(){ PNNOTAJAX(); },	
		success: function( resp ){
			
			if (typeof resp.error != 'undefined'){
				$.each(resp.error, function(key, valor){
					PNNOTIFY(valor.tipo, valor.titulo, valor.mensagem);
					$('ul.lista-item li').removeClass('active');
				});
				$('.resultadopesquisa .info').html('Acesso Negado!');
			} else {
				
				$('#BLOCKESCOLA').html('<h4><span class="fa fa-check-square-o"></span> '+resp.escola[0].nome+'</h4>')
					.slideDown('slow');	


				// lista as turmas de uma escola
				$('#BLOCKTURMAS .row').html('');

				if (resp.info.count == 0) {
					$('#BLOCKTURMAS .row').html('<div class="col-md-12" style="font-size:14px;">Nenhuma turma cadastrada para a escola no(s) ano(s) letivo(s) ativo(s)!</div>');
				}

				var iniA = true;
				$.each(resp.turmas, function(keyA, valueA){
					if (iniA == false) {
						$('#BLOCKTURMAS .row').append('<div class="space-md"></div>');
					} else {
						iniA = false;
					}
					$('#BLOCKTURMAS .row').append('<div class="col-md-12" style="font-size:14px;">Ano Letivo <b>'+keyA+'</b></div>');
					var iniB = true;
					$.each(valueA, function(keyB, valueB){
						if (iniB == false) {
							$('#BLOCKTURMAS .row').append('<div class="space-sm"></div>');
						} else {
							iniB = false;
						}
						$('#BLOCKTURMAS .row').append('<div class="col-md-12"><b>'+keyB+'</b></div>');

						$.each(valueB, function(keyC, valueC){
							$('#BLOCKTURMAS .row').append('<div class="col-md-3"><span class="fa fa-square"></span> '+valueC['tipo']+' '+valueC['letra']+'</div>');
						})

					})
				})
				$('#BLOCKTURMAS .row').append('<div class="space-xs"></div>').parent().slideDown('slow');
					
				// verifica se o form está visualizado
				var disp = $('form[name="formADD"]').css('display');
				if( disp == 'none' ) {
					$('form[name="formADD"]').slideDown('slow');
					$('#InfoSel').slideUp('fast');
				}
				$('.resultadopesquisa .info').html('Escola aberta para controle de turmas!');
				setTimeout(function(){ $('#BARRA').removeClass('aberto'); }, 800);
			}
			
		},

		complete: function(){
			LOADTOOLTIP();
		} 
	});
}
// FUNÇÃO QUE BUSCA DOS DADOS DA ESCOLA PARA PREENCHER NO FORM





///////////////////////////////////////////////
///     - - -     BLOCO ALUNOS    - - -     ///
///////////////////////////////////////////////



// FUNÇÃO PADRÃO QUE CARREGA LISTA DE ALUNOS CADASTRADOS DO MENU DE ITENS
function defaultListaAlunos(){
	
	buscaAlunos();
	
	// executa a função do exibir mais
	$('.resultadopesquisa .exibirmais').on('click', function(){
		var $next = $('#next-item').val();
		buscaAlunos($next); 
	});
	
	// efetua a pesquisa de alunos
	var formFIND = $('form[name="formFIND"], form[name="formFIND2"]');
	formFIND.submit(function(){
		
		$('form[name="formFIND"] input[name=query]').val( $('form[name="formFIND"] input[name=Pesquisa]').val());
		$('form[name="formFIND2"] input[name=query]').val( $('form[name="formFIND2"] input[name=Pesquisa]').val());
		buscaAlunos();
		
		return false;
		
	});
	
}
// FUNÇÃO PADRÃO QUE CARREGA LISTA DE ALUNOS CADASTRADOS DO MENU DE ITENS



// FUNÇÃO COMPLEMENTAR QUE EFETUA O AJAX DOS ALUNOS CADASTRADOS
function buscaAlunos($next, $single, $callback){
	
	//pega os dados do sistema de pesquisa
	var query1 		= $('form[name=formFIND] input[name=query]').val();
	var query2 		= $('form[name=formFIND2] input[name=query]').val();
	if (typeof $next == 'undefined'){ $next = 0 }
	if (typeof $single == 'undefined'){ $single = 0 }

	// solicita os dados por ajax 
	$.ajax({
		data: '&call=busca-alunos&query1='+query1+'&query2='+query2+'&nextitem='+$next+'&aluno_id='+$single,
		url: 'control/aluno.php',
		type: 'POST',
		dataType: "json",
		beforeSend: '', error: function(){ PNNOTAJAX(); },
		success: function( resp ){
			
			if (typeof resp.error != 'undefined'){
				$.each(resp.error, function(key, valor){
					PNNOTIFY(valor.tipo, valor.titulo, valor.mensagem);
				});
			} else {
				
				if ($single == 0) { // verifica se está puxando apenas um aluno ou a lista
					if ($next == 0) { $('.lista-item').html(''); } // se o next for zero limpo a lista para listar novos resultados
					listaAlunos(resp, 'lista-geral', $callback ? $callback : null);
				} else {
					listaAlunos(resp, 'lista-single', $callback ? $callback : null);
				}
			}
			
		},
		complete: function(){ //VOLTA AQUI
			
			// verifica se o usuário de alteração está na lista
			var $altini = $('form[name="formALT"] input[name=id]').val();
			if ($altini > 0) {
				var $enc = $('ul.lista-item').find('li[data-id="'+$altini+'"]').length;
				if ( $enc == 0) {
					var abrecall = function(){
						$('ul.lista-item li[data-id="'+$altini+'"]').addClass('active');
						$('.resultadopesquisa .info').html('Usuário aberto para alteração!');
					};
					buscaUsuarios(0,$altini,abrecall);
					
				} else {
					$('ul.lista-item li[data-id="'+$altini+'"]').addClass('active').prependTo('ul.lista-item');
				}
			}
				
		},
	});

	
	return false;	
	
}
// FUNÇÃO COMPLEMENTAR QUE EFETUA O AJAX DOS ALUNOS CADASTRADOS



// FUNÇÃO QUE LISTA OS ALUNOS DA BUSCA NO CONTROLE
function listaAlunos($dados, $action, $callback){
	
	if ($dados.info.counttot == 0) {
		$('.resultadopesquisa .info').html('nenhum aluno encontrado!');
		$('.resultadopesquisa .exibirmais').hide();
		$('.resultadopesquisa .carregando').hide();
		$('.barra-itens .empty').show('slow');
		$('.lista-item').html('');
		return false;
	}
	
	$('.barra-itens .empty').hide('slow');
	var $info = '';
	
	// função que carrega dos dados na lista
	$.each($dados.dados, function(key, valor){
		
		// verifica se o item ja existe
		var $enc = $('ul.lista-item').find('li[data-id="'+valor.id+'"]').length;
		if ( $enc > 0) {
			return false;
		};
		
		// adiciona o novo item na lista
		$itt = $('#LIALUNO').clone() 
		$itt.find('.titulo').html(valor.nome);
		$itt.find('.subtitulo').html('<i class="fa fa-list-alt"></i> '+valor.ra)
			.append('<i class="fa fa-asterisk padding-sm-left"></i> '+valor.nascimento);
		
		$itt.find('.info').html('<i class="fa fa-ticket"></i> '+valor.status);
		$itt.find('li').attr('data-id',valor.id);
		
		// executa as inserções de acordo com o action
		switch($action){
			case 'lista-geral':
				$('.lista-item').append($itt.html());
				$info = 'Exibindo ' + $dados.info.count + ' alunos de ' + $dados.info.counttot + ' encontrados!';
			break;
			
			case 'lista-single':
				$('.lista-item').prepend($itt.html());
			break;
		}
		
	});
	
	$('.resultadopesquisa .info').html($info);
	if (typeof $dados.info.nextitem != 'undefined'){
		$('.resultadopesquisa .exibirmais').attr('data-nextitem',$dados.info.nextitem).show();
		$('#next-item').val($dados.info.nextitem);
	} else {
		$('.resultadopesquisa .exibirmais').hide();
		$('#next-item').val(0);
	}
	
	$('.resultadopesquisa .carregando').hide();
	$callback ? $callback() : null 
	
}
// FUNÇÃO QUE LISTA OS ALUNOS DA BUSCA NO CONTROLE





///////////////////////////////////////////////
///     - - -    BLOCO USUARIOS    - - -    ///
///////////////////////////////////////////////


// FUNÇÃO PADRÃO QUE CARREGA LISTA DE USUARIOS CADASTRADOS DO MENU DE ITENS
function defaultListaUsuarios(){
	
	// função do autocomplete de grupos de usuário padrões do sistema
	$("#fil-grupo-usuario").autocomplete({
    	minLength: 0,
		source: "control/form.php?item=list-grupo-usuarios",
     	select: function( event, ui ) {
			
			$('#next-item').val(0);
			$("#fil-grupo-usuario").val( ui.item.nome );
			$("#grupo-usuario").val (ui.item.id);
			$("#form[name=formFIND] input[name=query]").val($("form[name=formFIND] input[name=Pesquisa]").val());
			buscaUsuarios();
			$("form[name=formFIND] input[name=Pesquisa]").focus();
			return false;
			
      	}
		
	})
	.focus(function() {
   		$(this).autocomplete('search', $(this).val());
	})
	.keydown(function(){
		return false;
	})
	.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li>" )
	  		.append("<a><div class='img fa "+item.img+" fa-2x'></div><div class='clearfix'><div class='usuario'>"+item.nome+"</div><p>"+item.descricao+"</p></div></a></li>")
			.append("<div class='clearfix linha'></div>")
        	.appendTo( ul );
	};
	
	buscaUsuarios();
	
	// executa a função do exibir mais
	$('.resultadopesquisa .exibirmais').on('click', function(){
		var $next = $('#next-item').val();
		buscaUsuarios($next); 
	});
	
	// efetua a pesquisa de usuarios
	var formFIND = $('form[name="formFIND"]');
	formFIND.submit(function(){
		
		formFIND.find('input[name=query]').val(formFIND.find('input[name=Pesquisa]').val());
		buscaUsuarios();
		
		return false;
		
	});
	
}
// FUNÇÃO PADRÃO QUE CARREGA LISTA DE USUARIOS CADASTRADOS DO MENU DE ITENS



// FUNÇÃO COMPLEMENTAR QUE EFETUA O AJAX DOS USUARIOS CADASTRADOS
function buscaUsuarios($next, $single, $callback){
	
	//pega os dados do sistema de pesquisa
	var grupo_id 	= $('#grupo-usuario').val();
	var query 		= $('form[name=formFIND] input[name=query]').val();
	if (typeof $next == 'undefined'){ $next = 0 }
	if (typeof $single == 'undefined'){ $single = 0 }

	// solicita os dados por ajax 
	$.ajax({
		data: '&call=busca-usuarios&grupo_id='+grupo_id+'&query='+query+'&nextitem='+$next+'&user_id='+$single,
		url: 'control/usuario.php',
		type: 'POST',
		dataType: "json",
		beforeSend: '', error: function(){ PNNOTAJAX(); },
		success: function( resp ){
			
			if (typeof resp.error != 'undefined'){
				$.each(resp.error, function(key, valor){
					PNNOTIFY(valor.tipo, valor.titulo, valor.mensagem);
				});
			} else {
				
				if ($single == 0) { // verifica se está puxando apenas um usuário ou a lista
					if ($next == 0) { $('.lista-item').html(''); } // se o next for zero limpo a lista para listar novos resultados
					listaUsuarios(resp, 'lista-geral', $callback ? $callback : null);
				} else {
					listaUsuarios(resp, 'lista-single', $callback ? $callback : null);
				}
			}
			
		},
		complete: function(){
			
			// verifica se o usuário de alteração está na lista
			var $altini = $('form[name="formALT"] input[name=id]').val();
			if ($altini > 0) {
				var $enc = $('ul.lista-item').find('li[data-id="'+$altini+'"]').length;
				if ( $enc == 0) {
					var abrecall = function(){
						$('ul.lista-item li[data-id="'+$altini+'"]').addClass('active');
						$('.resultadopesquisa .info').html('Usuário aberto para alteração!');
					};
					buscaUsuarios(0,$altini,abrecall);
					
				} else {
					$('ul.lista-item li[data-id="'+$altini+'"]').addClass('active').prependTo('ul.lista-item');
				}
			}
				
		},
	});

	
	return false;	
	
}
// FUNÇÃO COMPLEMENTAR QUE EFETUA O AJAX DOS USUARIOS CADASTRADOS



// FUNÇÃO QUE LISTA OS USUARIOS DA BUSCA NO CONTROLE
function listaUsuarios($dados, $action, $callback){
	
	if ($dados.info.counttot == 0) {
		$('.resultadopesquisa .info').html('nenhum usuário encontrado!');
		$('.resultadopesquisa .exibirmais').hide();
		$('.resultadopesquisa .carregando').hide();
		$('.barra-itens .empty').show('slow');
		$('.lista-item').html('');
		return false;
	}
	
	$('.barra-itens .empty').hide('slow');
	var $info = '';
	
	// função que carrega dos dados na lista
	$.each($dados.dados, function(key, valor){
		
		// verifica se o item ja existe
		var $enc = $('ul.lista-item').find('li[data-id="'+valor.id+'"]').length;
		if ( $enc > 0) {
			return false;
		};
		
		// adiciona o novo item na lista
		$itt = $('#LIUSUARIO').clone() 
		$itt.find('.titulo').html(valor.nome);
		$itt.find('.subtitulo').html('<i class="fa fa-envelope-o"></i> '+valor.email);
		
		if (valor.ativo == 1) {
			$itt.find('.info').html('<i class="fa fa-check-circle"></i> Usuário Ativo');
		} else {
			$itt.find('.info').html('<i class="fa fa-times-circle"></i> Usuário Inativo');
		}
		
		$itt.find('.info').append('  <i class="fa '+valor.grupo_img+' padding-sm-left"></i> '+valor.grupo_nome);
		$itt.find('li').attr('data-id',valor.id);
		
		// executa as inserções de acordo com o action
		switch($action){
			case 'lista-geral':
				$('.lista-item').append($itt.html());
				$info = 'Exibindo ' + $dados.info.count + ' usuários de ' + $dados.info.counttot + ' encontrados!';
			break;
			
			case 'lista-single':
				$('.lista-item').prepend($itt.html());
			break;
		}
		
	});
	
	$('.resultadopesquisa .info').html($info);
	if (typeof $dados.info.nextitem != 'undefined'){
		$('.resultadopesquisa .exibirmais').attr('data-nextitem',$dados.info.nextitem).show();
		$('#next-item').val($dados.info.nextitem);
	} else {
		$('.resultadopesquisa .exibirmais').hide();
		$('#next-item').val(0);
	}
	
	$('.resultadopesquisa .carregando').hide();
	$callback ? $callback() : null 
	
}
// FUNÇÃO QUE LISTA OS USUARIOS DA BUSCA NO CONTROLE



// FUNÇÃO QUE BUSCA DOS DADOS DO USUÁRIO PARA PREENCHER NO FORM
function abreUsuario($userID){
	$.ajax({
		data: 'call=pega-usuario-id&userid='+$userID,
		url: 'control/usuario.php',
		type: 'POST',
		dataType: 'json',
		beforeSend: function(){
			$('#BTALT').attr("disabled", "disabled"); 
			$pntitulo = 'Carregando...';
			$pnmsg = 'Carregando dados do usuário para alteração!';
			PNNOTIFY('loading', $pntitulo, $pnmsg);
		},
		error: function(){ PNNOTAJAX(); },	
		success: function( resp ){
			
			if (typeof resp.error != 'undefined'){
				$.each(resp.error, function(key, valor){
					PNNOTIFY(valor.tipo, valor.titulo, valor.mensagem);
					$('ul.lista-item li').removeClass('active');
				});
				$('.resultadopesquisa .info').html('Acesso Negado!');
			} else {
				
				loadInputs(resp.dados);
				
				$('#BLOCKALT').html('<footer>confirma alteração de dados do usuário:</footer>')
					.append('<h4><span class="fa fa-check-square-o"></span> '+resp.dados.nome+'</h4>')
					.slideDown('slow');
				$('#BTALT').removeAttr("disabled", "disabled");	
				
				// verifica se o form está visualizado
				var disp = $('form[name="formALT"]').css('display');
				if( disp == 'none' ) {
					$('form[name="formALT"]').slideDown('slow');
					$('#InfoSel').slideUp('fast');
				}
				$('.resultadopesquisa .info').html('Usuário aberto para alteração!');
				setTimeout(function(){ $('#BARRA').removeClass('aberto'); }, 800);
			}
			
		},
	});
}
// FUNÇÃO QUE BUSCA DOS DADOS DO USUÁRIO PARA PREENCHER NO FORM