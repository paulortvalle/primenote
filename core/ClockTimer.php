<?php
/**
 * Gerencia o tempo de execução dos processos
 *
 * Inicia um contador de uso de memória e tempo de execução
 * de numa determinada rotina ou processo
 *
 * @package primenote
 * @since 4.0.1 | 22/02/2017
 */

class ClockTimer {
	
	/**
	 * Tempo inicial do controle
	 *
	 * @public
	 * @access public
	 * @var timestamp
	 */
	public $timeIni;
	
	/**
	 * Memória inicial do controle
	 *
	 * @public
	 * @access public
	 * @var boolean
	 */
	public $memoIni;
	

	/**
	 * Inicia o contador
	 *
	 * @param timestamp $tini Tempo inicial do marcador
	 * @param boolean $mini Memória inicial do marcador
	 */
	public function setTime($tini, $mini) {
		$this->timeIni = $tini;
		$this->memoIni = $mini;
	}
	
	
	/**
	 * Retorna o tempo do marcador
	 *
	 * @param timestamp $tini Tempo inicial do marcador
	 * @param boolean $mini Memória inicial do marcador
	 * @return array Resultado do processo
	 */
	public function getTime($tend, $mend) {

		$arr = array();
		$arr['timeProccess']=(1000 * ($tend - $this->timeIni)) . ' ms';
		$arr['memoProccess']=(($mend - $this->memoIni) / (1024)) . ' kb';
		return $arr;

	}


}