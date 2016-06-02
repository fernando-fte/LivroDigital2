<?php
	# # # # # # # # # /  DEFINE PAGINAS DA APLICAÇÃO / # # # # # # # # #
	// Syntax = '@query' => array( '@group' => array( 1 => 2 ), '@double' => true '@next' => array( 'id', 'sku'))
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
				$settings['dir']['app-basic'].'/menu.html'
			)
		),

		// Pagina de boas vindas
		'home' => array(

		),

		'livro' => array(
			'@head' => array(
				'@title' => 'Todos os livros'
			),
			'@include' => array(
				$settings['dir']['app-blocks'].'/livro.lista.html'
			),

			'novo' => array(
				'@include' => array(
					$settings['dir']['app-headers'].'/livro.novo.html',
					$settings['dir']['app-blocks'].'/livro.form.html'
				)
			),

			'novo' => array(
				'@include' => array(
					$settings['dir']['app-headers'].'/livro.edit.html',
					$settings['dir']['app-blocks'].'/livro.form.html'
				)
			),
		),

		'autor' => array(
			'@head' => array(
				'@title' => 'Todos os autores'
			),

			'@include' => array(
				$settings['dir']['app-blocks'].'/autor.lista.html'
			),

			'novo' => array(
				'@include' => array(
					$settings['dir']['app-headers'].'/autor.novo.html',
					$settings['dir']['app-blocks'].'/autor.form.html'
				)
			),

			'edit' => array(
				'@include' => array(
					$settings['dir']['app-headers'].'/autor.edit.html',
					$settings['dir']['app-blocks'].'/autor.form.html'
				)
			)
		),

		// Paginas de aplicativos
		'issue' => array(

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
	# # # # # # # # # /  DEFINE PAGINAS DA APLICAÇÃO / # # # # # # # # #
?>
