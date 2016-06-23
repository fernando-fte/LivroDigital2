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
					'phpjs' => 'script',
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

		'html-data' => array(
			'@head' => array(
				'@title' => 'Conversor de html-data'
			),

			'@include' => array(
				$settings['dir']['app-htmldata-headers'].'/home.html',
				$settings['dir']['app-htmldata-forms'].'/submit.html'
			),

			'converte' => array(
				'@head' => array(
					'@title' => 'Convertendo arquivos'
				),

				'@include' => array(
					$settings['dir']['app-htmldata-headers'].'/convert.html',
					$settings['dir']['app-htmldata-forms'].'/convert.html'
				),

				'@body_end' => array(

					'@script' => array( 
						'app-htmldata-coffee' => 'script-coffee'
					)
				),
			)
		),

		// Paginas de aplicativos
		'issues' => array(
			'@no_default' => array(
				'@head->style', 
				'@body_end->script',
				'@include'
			),

			'vg' => array(

				'@head' => array(
					'@title' => 'Educação e Novas Tecnologias para o Ensino',
					'@meta' => array(
						'@description' => 'Aplicativo modelo da VG'
					),

					'@style' => array(
						'bootstrap-css' => 'css',
						'fontawesome' => 'css',
						'issue-vg-less'  => 'less'
					)
				),

				'@body_end' => array(

					'@script' => array( 
						'jquery' => 'script',
						'bootstrap-js' => 'script',
						'coffee' => 'script',
						'less' => 'script',
						'issue-vg-coffee' => 'script-coffee'
					)
				),

				'@include' => array( $settings['dir']['issue-vg'].'/index.html' )
			),

			'unipar' => array(

				'@head' => array(
					'@title' => 'Educação e Novas Tecnologias para o Ensino',
					'@meta' => array(
						'@description' => 'Aplicativo modelo da UNIPAR'
					),

					'@style' => array(
						'bootstrap-css' => 'css',
						'fontawesome' => 'css',
						'issue-unipar-less'  => 'less'
						// 'issue-unipar-css'  => 'css'
					)
				),

				'@body_end' => array(

					'@script' => array( 
						'jquery' => 'script',
						'bootstrap-js' => 'script',
						'less' => 'script',
						'coffee' => 'script',
						'issue-unipar-coffee' => 'script-coffee'
						// 'issue-unipar-js' => 'script',
					)
				),

				'@include' => array( $settings['dir']['issue-unipar'].'/index.html' )
			),

			'uniube' => array(

				'@head' => array(
					'@title' => 'Livro digital',
					'@meta' => array(
						'@description' => 'Aplicativo modelo da UNIUBE-POS'
					),

					'@style' => array(
						'bootstrap-css' => 'css',
						'fontawesome' => 'css',
						'issue-unipar-less'  => 'less'
					)
				),

				'@body_end' => array(

					'@script' => array( 
						'jquery' => 'script',
						'bootstrap-js' => 'script',
						'coffee' => 'script',
						'less' => 'script',
						'issue-unipar-coffee' => 'script-coffee'
					)
				),

				'@include' => array( $settings['dir']['issue-uniube'].'/index.html' )
			),
		)
	)
	# # # # # # # # # /  DEFINE PAGINAS DA APLICAÇÃO / # # # # # # # # #
?>
