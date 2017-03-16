
// cria o banco de dados
CREATE DATABASE IF NOT EXISTS `primenote` CHARACTER SET utf8;


// cria a tabela de logins
CREATE TABLE `logins` (

   `login_id` int(11) NOT NULL AUTO_INCREMENT,

   `login_user_id` int(11) NOT NULL,
  
   `login_date` datetime NOT NULL,
  
   `login_remote_addr` varchar(16) COLLATE utf8_bin NOT NULL,
 
  `login_remote_host_addr` varchar(255) COLLATE utf8_bin NOT NULL,

   `login_remote_port` varchar(16) COLLATE utf8_bin NOT NULL,
 
  `login_user_session_id` varchar(255) COLLATE utf8_bin NOT NULL,
  
   PRIMARY KEY (`login_id`)

) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


// cria a tabela de users

CREATE TABLE `users` (
  
   `user_id` int(11) NOT NULL AUTO_INCREMENT,
  
   `user` varchar(255) COLLATE utf8_bin NOT NULL,
  
   `user_password` varchar(255) COLLATE utf8_bin NOT NULL,
  
   `user_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  
   `user_short_name` varchar(16) COLLATE utf8_bin NOT NULL,
  
   `user_session_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  
   `user_permissions` longtext COLLATE utf8_bin,
  
   `user_group` tinyint(4) NOT NULL,
  
   `user_email` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  
   `user_address` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  
   `user_unit` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  
   `user_city` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  
   `user_postal_code` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  
   `user_state` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  
   `user_phone` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  
   `user_celphone` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  
   PRIMARY KEY (`user_id`)

) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


// insere o usuário admin na tabela users

INSERT INTO `users` (
   `user_id`, `user`, `user_password`, 
   `user_name`, `user_short_name`, `user_session_id`, 
   `user_permissions`, `user_group`, `user_email`, 
   `user_address`, `user_unit`, `user_city`, 
   `user_postal_code`, `user_state`, `user_phone`, 
   `user_celphone`) 
VALUES (
   1,'admin','$2a$08$h/gFd6QyHMxb8TO9kNq2bO7u8nMdj/w9toSkge4AjJOhNxl1Gz0PW',
   'Paulo Valle','Paulo','h68etorbe5qgibu26l6tnsa0c4',
   'a:2:{i:0;s:13:\"user-register\";i:1;s:18:\"gerenciar-noticias\";}',0,'paulortvalle@gmail.com',
   'Rua X, 99','Bairro','Cidade',
   '13806515','SP','1938064489',
   '');