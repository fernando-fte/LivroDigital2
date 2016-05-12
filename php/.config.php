<?php

	// Move post e get para array separada
	$post = $_POST;
	$get = $_GET;

	// Oculta todos os erros do php
	// error_reporting(0);

	// Config page default
	if (array_key_exists('page', $get)) { $get['page'] = 'home'; }
	if (!array_key_exists('page', $get)) { $get['page'] = 'home'; }


	# # # # # # # # # / CONFIGURA PATH DE TODOS OS ELEMENTOS / # # # # # # # # #
	# # # Configura localhost
	$settings['wwwproj'] = '/livrodigital'; // pasta atual do projeto
	$settings['wwwroot'] = 'http://'.$_SERVER['SERVER_NAME'].$settings['wwwproj']; // Configura seleção do servidor mais pasta local


	# # # Configura path de diretórios

	# diretorio de vendors
	$settings['dir']['vendor'] = $settings['wwwroot'].'/vendor'; // Configura seleção do servidor mais pasta local
	$settings['dir']['vendor-scripts'] = $settings['dir']['vendor'].'/scripts'; // Configura local dos frameworks scripts
	$settings['dir']['vendor-bootstrap'] = $settings['dir']['vendor'].'/bootstrap'; // Configura local dos frameworks scripts
	$settings['dir']['vendor-fontawesome'] = $settings['dir']['vendor'].'/FontAwesome'; // Configura local dos frameworks scripts

	# diretorio de aplicações e estilos
	$settings['dir']['app-style'] = $settings['wwwroot'].'/style'; // Configura seleção do servidor mais pasta local
	$settings['dir']['app-script'] = $settings['wwwroot'].'/script'; // Configura seleção do servidor mais pasta local

	# diretorio de paginas
	$settings['dir']['contents'] = $settings['wwwroot'].'/contents'; // Local base de todos os dados
	$settings['dir']['form'] = $settings['dir']['contents'].'/form'; // Conjunto de  formuláros
	$settings['dir']['books'] = $settings['wwwroot'].'/books'; // Local de XML
	$settings['dir']['app'] = $settings['wwwroot'].'/aplicativos'; // Local das aplicações rodando

	# diretorio das aplicações
	$settings['dir']['app-vg'] = $settings['dir']['app'].'/vgconsultoria'; // Local das aplicações rodando


	# # # Configura path arquivos e framework
	$settings['file']['jquery'] = $settings['dir']['vendor-scripts'].'/jquery.min.js'; 
	$settings['file']['coffee'] = $settings['dir']['vendor-scripts'].'/coffee-script.js'; 
	$settings['file']['less'] = $settings['dir']['vendor-scripts'].'/less.min.js'; 
	$settings['file']['less'] = $settings['dir']['vendor-scripts'].'/less.min.js'; 

	$settings['file']['bootstrap-css'] = $settings['dir']['vendor-bootstrap'].'/bootstrap.min.css'; 
	$settings['file']['bootstrap-js'] = $settings['dir']['vendor-bootstrap'].'/bootstrap.min.js'; 

	$settings['file']['fontawesome'] = $settings['dir']['vendor-fontawesome'].'/font-awesome.min.css'; 

	// $settings['file']['style-css'] = $settings['dir']['app-style'].'/app.css';
	// $settings['file']['style-less'] = $settings['dir']['app-style'].'/app.less';
	$settings['file']['style-less'] = $settings['dir']['app-vg'].'/style/app.less';

	// $settings['file']['app-js'] = $settings['dir']['app-script'].'/app.js'; 
	// $settings['file']['app-coffee'] = $settings['dir']['app-script'].'/app.coffee';
	$settings['file']['app-coffee'] = $settings['dir']['app-vg'].'/scripts/app.coffee';


	// -- TODO: FAZER APLICATIVO PARA PAGES CARREGAR O HEADER DINAMICO


	# # # Configura conjunto de páginas
	$settings['page']['home']['title'] = 'Home';

	$settings['page']['xml'] = array(

		'title' => 'Teste de leitura de xml',

		'description' => 'A pagina deve importar e ler xml',

		'include' => array(
			$settings['dir']['form'].'/form.basic.html'
		)
	);


	$settings['page']['app-vg'] = array(

		'title' => 'Educação e Novas Tecnologias para o Ensino',

		'description' => 'Aplicativo modelo da VG',

		'include' => array(
			$settings['dir']['app-vg'].'/index.html'
		)
	);


?>
