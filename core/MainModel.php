<?php
/**
 * Classe Main com propriedades e funções utilizadas
 * constantemente por objetos Models e Views
 *
 * @package primenote
 * @since 4.0 | 03/02/2017
 */

class MainModel {
	/**
	 * $form_data
	 *
	 * Os dados de formulários de envio.
	 *
	 * @access public
	 */	
	public $form_data;

	/**
	 * $form_msg
	 *
	 * As mensagens de feedback para formulários.
	 *
	 * @access public
	 */	
	public $form_msg;

	/**
	 * $form_confirma
	 *
	 * Mensagem de confirmação para apagar dados de formulários
	 *
	 * @access public
	 */
	public $form_confirma;

	/**
	 * $db
	 *
	 * O objeto da nossa conexão PDO
	 *
	 * @access public
	 */
	public $db;

	/**
	 * $controller
	 *
	 * O controller que gerou esse modelo
	 *
	 * @access public
	 */
	public $controller;

	/**
	 * $parametros
	 *
	 * Parâmetros da URL
	 *
	 * @access public
	 */
	public $parametros;

	/**
	 * $userdata
	 *
	 * Dados do usuário
	 *
	 * @access public
	 */
	public $userdata;
	
	/**
	 * Change datas 
	 *
	 * Obtém a data e inverte seu valor.
	 * De: d-m-Y H:i:s para Y-m-d H:i:s ou vice-versa.
	 *
	 * @since 0.1
	 * @access public
	 * @param string $data A data
	 */
	public function change_data( $data = null ) {
	
		// Configura uma variável para receber a nova data
		$nova_data = null;
		
		// Se a data for enviada
		if ( $data ) {
		
			// Explode a data por -, /, : ou espaço
			$data = preg_split('/\-|\/|\s|:/', $data);
			
			// Remove os espaços do começo e do fim dos valores
			$data = array_map( 'trim', $data );
			
			// Cria a data invertida
			$nova_data .= chk_array( $data, 2 ) . '-';
			$nova_data .= chk_array( $data, 1 ) . '-';
			$nova_data .= chk_array( $data, 0 );
			
			// Configura a hora
			if ( chk_array( $data, 3 ) ) {
				$nova_data .= ' ' . chk_array( $data, 3 );
			}
			
			// Configura os minutos
			if ( chk_array( $data, 4 ) ) {
				$nova_data .= ':' . chk_array( $data, 4 );
			}
			
			// Configura os segundos
			if ( chk_array( $data, 5 ) ) {
				$nova_data .= ':' . chk_array( $data, 5 );
			}
		}
		
		// Retorna a nova data
		return $nova_data;
	
	} // change_data


	/**
	 * Formata data
	 * Obtém a data em formato Y-m-d H:i:s e converte seu valor para o padrão de exibição.
	 *
	 * @since 0.1
	 * @access public
	 * @param string $dateMYSQL A data para alteração
	 * @param integer $formato O formato que desejo retornar
	 * @return string a data pronta para exibição
	 */
	function formatDate($dateMYSQL, $format){

		// verifica se a data é valida
		if (($timestamp = strtotime($dateMYSQL)) === false) {
	    	return "data inválida";
		} 
		
		$timestamp = strtotime($dateMYSQL); // Gera o timestamp de $data_mysql

		switch ($format) {
			case 1: return date('d/m/Y', $timestamp); // Resultado: 12/03/2009
			case 2: return date('d/m/Y H:i:s', $timestamp); // Resultado: 12/03/2009 15:12:14
			case 3: // Resultado:  12 de agosto de 2013, às 15:12:14 \n 2 anos atras
				$data1 = new DateTime( $dateMYSQL );
				$data2 = new DateTime( date('Y-m-d H:i:s') );
				$intervalo = $data1->diff( $data2 );
				$dataP = '<strong>' . date('d/m/Y H:i:s', $timestamp) . '</strong>';
				if ($intervalo->y >= 1){
					return $dataP . '<br/><small>' . $intervalo->y . ' ano(s) atrás</small>';
				} elseif ($intervalo->m >= 1){
					return $dataP . '<br/><small>' . $intervalo->m . ' mês(es) atrás</small>';
				}elseif ($intervalo->d >= 1){
					return $dataP . '<br/><small>' . $intervalo->d . ' dia(s) atrás</small>';
				}elseif ($intervalo->h >= 1){
					return $dataP . '<br/><small>' . $intervalo->h . ' hora(s) atrás</small>';
				}elseif ($intervalo->i >= 1){
					return $dataP . '<br/><small>' . $intervalo->i . ' minuto(s) atrás</small>';
				}elseif ($intervalo->s >= 1){
					return $dataP . '<br/><small>' . $intervalo->s . ' segundo(s) atrás</small>';
				}
		}
		
	}// formatDate

} // MainModel