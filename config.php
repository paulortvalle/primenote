<?php
/**
 * Arquivo de Configurações do Sistema
 * Contém as configurações básicas do sistema e carrega o arquivo
 * responsável por carregar todo o sistema @loader.php
 *
 * @package primenote
 * @since 4.0 | 03/02/2017
 */

// Caminho para a raiz
define( 'ABSPATH', dirname( __FILE__ ) );

// Caminho para a pasta de uploads
define( 'UP_ABSPATH', ABSPATH . '/uploads' );

// URL da home
define( 'HOME_URI', '' );

// Nome do host da base de dados
define( 'HOSTNAME', 'localhost' );

// Nome do DB
define( 'DB_NAME', '' );

// Usuário do DB
define( 'DB_USER', '' );

// Senha do DB
define( 'DB_PASSWORD', '' );

// Charset da conexão PDO
define( 'DB_CHARSET', 'utf8' );

// Se você estiver desenvolvendo, modifique o valor para true
define( 'DEBUG', true );

// Define o fuso horário para as datas do sistema
date_default_timezone_set('America/Sao_Paulo');

/**
 * Não edite daqui em diante
 */

// Carrega o loader, que vai carregar a aplicação inteira
require_once ABSPATH . '/loader.php';
?>