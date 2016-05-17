<?php
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

	# # # # # /HOME / # # # # #
	$settings['page']['home'] = $settings['default']['html'];
	# # # # # /HOME / # # # # #

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

	$settings['page']['autor'] = $settings['page']['livros'];
	$settings['page']['autor']['include'] = array(
		$settings['dir']['form'].'/menu.html',
		$settings['dir']['form'].'/list.autor.html'
	);

	# # # # # /APP NATIVO/ # # # # #

	# # # # # / TESTES / # # # # #
	# # Configura pagina de tratamento
	$settings['page']['teste'] = $settings['default']['html'];

	# # # Adiciona configurações extras
	$settings['page']['teste']['head']['title'] = 'Teste de leitura de xml';
	$settings['page']['teste']['head']['meta']['description'] = 'Pagina para teste';
	$settings['page']['teste']['head']['style']['style-less'] = 'less';
	$settings['page']['teste']['include'] = array(
		$settings['dir']['php'].'/teste/index.php'
	);

	# # # Remove configurações desnecessarias
	unset($settings['page']['teste']['head']['style']['style-css']);
	# # # # # / TESTES / # # # # #


	# # # # # / APP VG / # # # # #
	$settings['page']['app-vg'] = $settings['default']['html'];

	# # # Adiciona configurações extras
	$settings['page']['app-vg']['head']['title'] = 'Educação e Novas Tecnologias para o Ensino';
	$settings['page']['app-vg']['head']['meta']['description'] = 'Aplicativo modelo da VG';
	$settings['page']['app-vg']['head']['style']['app-vg-style-css'] = 'css';
	$settings['page']['app-vg']['body_end']['script']['app-vg-app-coffee'] = 'script-coffee';
	$settings['page']['app-vg']['include'] = array(
		$settings['dir']['app-vg'].'/index.html'
	);

	# # # Remove configurações desnecessarias
	unset(
		$settings['page']['app-vg']['head']['style']['style-css'],
		$settings['page']['app-vg']['body_end']['script']['app-coffee'],
		$settings['page']['app-vg']['body_end']['script']['less']
	);
	# # # # # / APP VG / # # # # #


?>
