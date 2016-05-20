<?php 
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

	# diretorio de paginas
	$settings['dir']['php'] = $settings['wwwroot'].'/php'; // Local base de todos os dados

	# diretorio de aplicações e estilos
	$settings['dir']['app-style'] = $settings['wwwroot'].'/style'; // Configura seleção do servidor mais pasta local
	$settings['dir']['app-script'] = $settings['wwwroot'].'/script'; // Configura seleção do servidor mais pasta local

	# Diretorios de paginas
	$settings['dir']['contents'] = $settings['wwwroot'].'/contents'; // Local base de todos os dados
	$settings['dir']['form'] = $settings['dir']['contents'].'/form'; // Conjunto de  formuláros
	$settings['dir']['home'] = $settings['dir']['contents'].'/home'; // Conjunto de  formuláros

	# Diretorios de arquivos do livro
	$settings['dir']['books'] = $settings['wwwroot'].'/books'; // Local de XML

	# Diretorios de aplicativos
	$settings['dir']['app'] = $settings['wwwroot'].'/aplicativos'; // Local das aplicações rodando
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
	# # # # # # # # # / CONFIGURA PATH DE TODOS OS ELEMENTOS / # # # # # # # # #
?>
