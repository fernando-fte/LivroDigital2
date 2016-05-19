<?php
	# # # / DEFINE PAGINAS DA APLICAÇÃO / # # # 
	$settings['pages'] = array(

		// Aparametros padrão que todos os elemento herdarão
		'@default' => array(

			'@head' => array(
				'@meta' => array(
					'@config' => array(
						array('charset'=>'utf-8'),
						array('http-equiv'=>'X-UA-Compatible', 'content'=>'IE=edge'),
						array('name'=>'viewport', 'content'=>'width=device-width, initial-scale=1')
					),
					'description' => null,
					'keywords' => null,
					'author' => 'FTE Developer by VG Consultoria'
				),

				'@title' => 'Home',

				'@style' => array(
					'bootstrap-css' => 'css',
					'fontawesome' => 'css',
					'style-less'  => 'less'
				),
			),

			'@body_end' => array(

				'@script' => array( 
					'jquery' => 'script',
					'bootstrap-js' => 'script',
					'coffee' => 'script',
					'less' => 'script',
					'app-coffee' => 'script-coffee'
				)
			),

			'@include' => array(
				$settings['dir']['home'].'abertura.php'
			)
		),

		// Pagina de edição de livro
		'editor' => array(
			'@no_default' => array('@include'),
			'@default' => array(
				'@include' => array( $settings['dir']['form'].'/menu.html' )
			),

			'list' => array (

				'livros' => array(

					'@head' => array(
						'@title' => 'Lista de livros'
					),

					'@include' => array( $settings['dir']['form'].'/list.livro.html' )
				),

				'autores' => array(

					'@head' => array(
						'@title' => 'Lista de autores'
					),

					'@include' => array( $settings['dir']['form'].'/list.livro.html' )
				)
			)
		),

		// Paginas de teste
		'teste' => array(
			'@no_default' => array('@include'),
			'@head' => array(
				'@title' => 'Testes'
			),
			'@include' => array( $settings['dir']['php'].'/teste/index.php' )
		),

		// Paginas de aplicativos
		'apps' => array(

			'vg' => array(
				'@no_default' => array('@head->style', '@body_end->script'),

				'@head' => array(
					'@title' => 'Educação e Novas Tecnologias para o Ensino',
					'@meta' => array(
						'@description' => 'Aplicativo modelo da VG'
					),

					'@style' => array(
						'bootstrap-css' => 'css',
						'fontawesome' => 'css',
						'app-vg-style-css'  => 'css'
					)
				),

				'@body_end' => array(

					'@script' => array( 
						'jquery' => 'script',
						'bootstrap-js' => 'script',
						'coffee' => 'script',
						'less' => 'script',
						'app-vg-app-coffee' => 'script-coffee'
					)
				),

				'@include' => array( $settings['dir']['app-vg'].'/index.html' )
			)
		)
	)
?>
