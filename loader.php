<?php
/**
 * Arquivo que carrega todas as classes do sistema
 * Carrega as funções globais e instancia a classe @primenote()
 *
 * @package primenote
 * @since 4.0 | 03/02/2017
 */

// Evita que usuários acesse este arquivo diretamente
if ( ! defined('ABSPATH')) exit;
 
// Inicia a sessão
session_start();

// Verifica o modo para debugar
if ( ! defined('DEBUG') || DEBUG === false ) {

	// Esconde todos os erros
	error_reporting(0);
	ini_set("display_errors", 0); 
	
} else {

	// Mostra todos os erros
	error_reporting(E_ALL);
	ini_set("display_errors", 1); 
	
}

// Funções globais
require_once ABSPATH . '/functions.php';

// Carrega a aplicação
$primenote = new Primenote();

