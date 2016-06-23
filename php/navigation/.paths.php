<?php 
	# # # # # # # # # / CONFIGURA PATH DE TODOS OS ELEMENTOS / # # # # # # # # #
	# # # Configura localhost
	$settings['wwwproj'] = '/livrodigital'; // pasta atual do projeto
	$settings['wwwroot'] = 'http://'.$_SERVER['SERVER_NAME'].$settings['wwwproj']; // Configura seleção do servidor mais pasta local

	# # # Configura path de diretórios gerais

	# diretorio de vendors
	$settings['dir']['vendor'] = $settings['wwwroot'].'/vendor'; // Configura seleção do servidor mais pasta local
	$settings['dir']['vendor-scripts'] = $settings['dir']['vendor'].'/scripts'; // Configura local dos frameworks scripts
	$settings['dir']['vendor-bootstrap'] = $settings['dir']['vendor'].'/bootstrap'; // Configura local dos frameworks scripts
	$settings['dir']['vendor-materialize'] = $settings['dir']['vendor'].'/materialize'; // Configura local dos frameworks scripts
	$settings['dir']['vendor-fontawesome'] = $settings['dir']['vendor'].'/FontAwesome'; // Configura local dos frameworks scripts

	# diretorio de paginas
	$settings['dir']['php'] = $settings['wwwroot'].'/php'; // Local base de todos os dados

	# diretorio de aplicações e estilos
	$settings['dir']['app-style'] = $settings['wwwroot'].'/style'; // Configura seleção do servidor mais pasta local
	$settings['dir']['app-script'] = $settings['wwwroot'].'/script'; // Configura seleção do servidor mais pasta local

	# Diretorios de paginas
	$settings['dir']['contents'] = $settings['wwwroot'].'/contents'; // Local base de todos os dados
	$settings['dir']['app'] = $settings['dir']['contents'].'/app'; // Conjunto de dados dos arquivos

	# # Contents de app
	$settings['dir']['app-basic'] = $settings['dir']['app'].'/basic'; // Arquivos basicos
	$settings['dir']['app-blocks'] = $settings['dir']['app'].'/blocks'; // Blocos das paginas
	$settings['dir']['app-headers'] = $settings['dir']['app'].'/headers'; // Cabeçarios

	# # Contents para o conversor de html-data
	$settings['dir']['app-htmldata'] = $settings['dir']['contents'].'/html-data'; // Contents para html-data
	$settings['dir']['app-htmldata-forms'] = $settings['dir']['app-htmldata'].'/forms'; // Formulários
	$settings['dir']['app-htmldata-headers'] = $settings['dir']['app-htmldata'].'/headers'; // Cabeçarios
	# # # #

	# # # # #
	# Diretorios de arquivos do livro
	$settings['dir']['books'] = $settings['wwwroot'].'/books'; // Local de XML
	# Diretorio dos aplicativos
	$settings['dir']['issue'] = $settings['wwwroot'].'/aplicativos'; // Local das aplicações rodando
	# # # # #


	# # # # #
	# Rota de pastas
	$settings['dir']['page-vg'] = $settings['wwwroot'].'/issues/vg'; // Local do aplicativo vg
	$settings['dir']['page-unipar'] = $settings['wwwroot'].'/issues/unipar'; // Local do aplicativo unipar
	$settings['dir']['page-uniube'] = $settings['wwwroot'].'/issues/uniube'; // Local do aplicativo uniube
	$settings['dir']['page-convert'] = $settings['wwwroot'].'/html-data'; // Local base de todos os dados
	// $settings['dir']['page-disciplinas'] = $settings['wwwroot'].'/disciplina'; // Local base de todos os dados
	# # # # #



	# # # Configura path arquivos e framework geral
	$settings['file'] = array(
		# VENDORS
		# # scripts
		'jquery' => $settings['dir']['vendor-scripts'].'/jquery.min.js',
		'coffee' => $settings['dir']['vendor-scripts'].'/coffee-script.js',
		'less' => $settings['dir']['vendor-scripts'].'/less.min.js',
		'phpjs' => $settings['dir']['vendor-scripts'].'/phpjs.js',
		'bootstrap-js' => $settings['dir']['vendor-bootstrap'].'/bootstrap.min.js',
		'materialize-js' => $settings['dir']['vendor-materialize'].'/js/materialize.min.js',

		# # scripts
		'bootstrap-css' => $settings['dir']['vendor-bootstrap'].'/bootstrap.min.css',
		'materialize-css' => $settings['dir']['vendor-materialize'].'/css/materialize.min.css',
		'fontawesome' => $settings['dir']['vendor-fontawesome'].'/font-awesome.min.css',
		# # # # # #

		# APLICAÇÕES
		# # aplicativo default
		'style-css' => $settings['dir']['app-style'].'/app.css',
		'style-less' => $settings['dir']['app-style'].'/app.less',

		'app-js' => $settings['dir']['app-script'].'/app.js',
		'app-coffee' => $settings['dir']['app-script'].'/app.coffee',
		'app-htmldata-coffee' => $settings['dir']['app-script'].'/app.html-data.coffee',
		# # # #
	);


	# # # APLICATIVO - VGCONSULTORIA # # #
	$settings['dir']['issue-vg'] = $settings['dir']['issue'].'/vgconsultoria'; // Local das aplicações rodando

	# # Arquivos do aplicativo VG
	$settings['file']['issue-vg-css'] = $settings['dir']['issue-vg'].'/style/app.css';
	$settings['file']['issue-vg-less'] = $settings['dir']['issue-vg'].'/style/app.less';
	$settings['file']['issue-vg-coffee'] = $settings['dir']['issue-vg'].'/scripts/app.coffee';
	# # # #



	# # # APLICATIVO - UNIPAR # # #
	$settings['dir']['issue-unipar'] = $settings['dir']['issue'].'/unipar'; // Local das aplicações rodando

	# # Arquivos do aplicativo unipar
	$settings['file']['issue-unipar-css'] = $settings['dir']['issue-unipar'].'/style/app.css';
	$settings['file']['issue-unipar-less'] = $settings['dir']['issue-unipar'].'/style/app.less';
	$settings['file']['issue-unipar-js'] = $settings['dir']['issue-unipar'].'/scripts/app.js';
	$settings['file']['issue-unipar-coffee'] = $settings['dir']['issue-unipar'].'/scripts/app.coffee';
	# # # #



	# # # APLICATIVO - UNIUBE-POS # # #
	$settings['dir']['issue-uniube'] = $settings['dir']['issue'].'/uniube'; // Local das aplicações rodando

	# # Arquivos do aplicativo uniube
	$settings['file']['issue-uniube-css'] = $settings['dir']['issue-uniube'].'/style/app.css';
	$settings['file']['issue-uniube-less'] = $settings['dir']['issue-uniube'].'/style/app.less';
	$settings['file']['issue-uniube-coffee'] = $settings['dir']['issue-uniube'].'/scripts/app.coffee';
	$settings['file']['issue-uniube-js'] = $settings['dir']['issue-uniube'].'/scripts/app.js';
	# # # #
	# # # # # # # # # / CONFIGURA PATH DE TODOS OS ELEMENTOS / # # # # # # # # #
?>
