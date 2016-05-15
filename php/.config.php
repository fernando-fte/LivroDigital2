<?php

	// Move post e get para array separada
	$post = $_POST;
	$get = $_GET;

	// Oculta todos os erros do php
	error_reporting(0);

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
	$settings['file'] = array(
		# VENDORS
		# # scripts
		'jquery' => $settings['dir']['vendor-scripts'].'/jquery.min.js',
		'coffee' => $settings['dir']['vendor-scripts'].'/coffee-script.js',
		'less' => $settings['dir']['vendor-scripts'].'/less.min.js',
		'bootstrap-js' => $settings['dir']['vendor-bootstrap'].'/bootstrap.min.js',

		# # scripts
		'bootstrap-css' => $settings['dir']['vendor-bootstrap'].'/bootstrap.min.css',
		'fontawesome' => $settings['dir']['vendor-fontawesome'].'/font-awesome.min.css',
		# # # # # #

		# APLICAÇÕES
		# # aplicativo default
		'style-css' => $settings['dir']['app-style'].'/app.css',
		'style-less' => $settings['dir']['app-style'].'/app.less',

		'app-js' => $settings['dir']['app-script'].'/app.js',
		'app-coffee' => $settings['dir']['app-script'].'/app.coffee',
		# # # #

		# # aplicativo "livro digital"
		'app-vg-style-css' => $settings['dir']['app-vg'].'/style/app.css',
		'app-vg-style-less' => $settings['dir']['app-vg'].'/style/app.less',
		'app-vg-app-coffee' => $settings['dir']['app-vg'].'/scripts/app.coffee'
		# # # #
	);

	// -- TODO: FAZER APLICATIVO PARA PAGES CARREGAR O HEADER DINAMICO

	# # Define falores default do html
	$settings['default']['html'] = array(
		'head' => array(
			'meta' => array(
				'@config' => array(
					array('charset'=>'utf-8'),
					array('http-equiv'=>'X-UA-Compatible', 'content'=>'IE=edge'),
					array('name'=>'viewport', 'content'=>'width=device-width, initial-scale=1')
				),
				'description' => null,
				'keywords' => null,
				'author' => 'FTE Developer by VG Consultoria'
			),

			'title' => null,

			'style' => array(
				// name-path-file => type-file-include
				'bootstrap-css' => 'css',
				'fontawesome' => 'css',
				'style-css'  => 'css'
			),
		),

		'body_end' => array(

			'script' => array( 
				'jquery' => 'script',
				'bootstrap-js' => 'script',
				'coffee' => 'script',
				'less' => 'script',
				'app-coffee' => 'script-coffee'
			)
		)
	);

	# CONFIGURA CONJUNTO DE PÁGINAS

	# # # # # /APP NATIVO/ # # # # #
	# # Configura pagina de tratamento
	$settings['page']['livros'] = $settings['default']['html'];

	# # # Adiciona configurações extras
	$settings['page']['livros']['head']['title'] = 'Teste de leitura de xml';
	$settings['page']['livros']['head']['meta']['description'] = 'Pagina para teste';
	$settings['page']['livros']['head']['style']['style-less'] = 'less';
	$settings['page']['livros']['include'] = array(
		$settings['dir']['form'].'/menu.html',
		$settings['dir']['form'].'/list.livro.html'
	);

	# # # Remove configurações desnecessarias
	unset($settings['page']['livros']['head']['style']['style-css']);
	# # # # # /APP NATIVO/ # # # # #


	# # # # # / APP VG / # # # # #
	$settings['page']['app-vg'] = $settings['default']['html'];

	# # # Adiciona configurações extras
	$settings['page']['app-vg']['head']['title'] = 'Educação e Novas Tecnologias para o Ensino';
	$settings['page']['app-vg']['head']['meta']['description'] = 'Aplicativo modelo da VG';
	$settings['page']['app-vg']['head']['style']['app-vg-style-css'] = 'css';
	$settings['page']['app-vg']['body_end']['script']['app-vg-app-coffee'] = 'css';
	$settings['page']['app-vg']['include'] = array(
		$settings['dir']['app-vg'].'/index.html'
	);

	# # # Remove configurações desnecessarias
	unset($settings['page']['app-vg']['head']['style']['style-css'], $settings['page']['app-vg']['body_end']['script']['app-js'], $settings['page']['app-vg']['body_end']['script']['less']);
	# # # # # / APP VG / # # # # #
?>
