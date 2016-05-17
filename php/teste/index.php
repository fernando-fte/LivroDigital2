<?php 
	/*
	@no_default // define a quebra de erança e sempre é tratado antes de @default
	@default // define para si e para todos os filhos elementos padrao
		@pattern // define o carregamento e a substiuição de uma herança
			-> @path // define o local da herança
		@head // Configura os contents para head com titulo, metas, css
		@body_end // Configura elementos do final de body normalmente scripts
		@include // define uma lista de importação de elementos
	*/



	# # # # # / FUNÇÂO DE TARTAMENTO DE PAGINAS / # # # # #
	function page_config($page, $content, $func) {

		$settings['pages'] = array(

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

					'@title' => null,

					'@style' => array(
						// name-path-file => type-file-include
						'bootstrap-css' => 'css',
						'fontawesome' => 'css',
						'style-css'  => 'css'
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
				)
			),

			'adm' => array(
				'@no_default' => array('@head->style'),
				'@default' => array(
					'@head' => array(
						'@style' => array(
							// name-path-file => type-file-include
							'bootstrap-css' => 'css',
							'fontawesome' => 'css',
							'style-less'  => 'less'
						),
					)
				),

				'login' => array(
					'@include' => array(
						'incluir_pagina_x',
						'incluir_pagina_y'
					),

					'erro' => array(
						'@default' => array(
							'@head' => array(
								'@style' => array(
									// name-path-file => type-file-include
									'teste' => 'css'
								),
							)
						),
					)
				)
			)
		);

		// print_r($page);

		# DECLARA INSTANCIAS DO RESULTADO
		$result = array(
			'success' => null,
			'erro' => null,
			'done' => null,
			'this' => 'F::page_config',
			'process' => array (
				'valida-page' => false,
				'@help' => false,
				'inicia' => array(
					'success' => null,
					'log' => array(
						'@page' => null,
						'@default' => null
					)
				),
				'no_default' => array('success' => null)
			)
		);

		# DECLARA INSTANCIAS DE RESERVA
		$reserve = array(
			'@default' => null,
			'@pages' => null
		);


		# # # # # / VALIDAÇÃO / # # # # # #
		# Valida se esta sendo recebido parametros da função
		if ($func == true && gettype($func) == 'array') {

			# # modifica nome da função para identificar como sub-item
			$result['this'] = 'me';

			# # reserva os dados enviador pela função
			$reserve = $func;
		}

		# Valida se foi recebido a pagina
		if ($page == true) {

			# # valida se foi recebido uma lista direta
			if (gettype($page) == 'string') {

				# # # explode e separa as paginas
				$page = explode('->', $page);

				# # # define o processo de tratamento
				$result['process']['trata-page-direct'] = true;
			}

			# # Valida os parametros sao uma array
			if (gettype($page) == 'array') {

				# # # valida se é uma sub chamada
				if ($result['this'] == 'me') {

					# # # valida se a pagina existe
					if (array_key_exists($page[0], $reserve['@pages'])) {

						# # # # valida se a pagina existe
						$result['process']['valida-page'] = true;
					}
				}

				# # # caso o parametro nao seja uma sub chamada
				if ($result['this'] == 'F::page_config') {

					# # # valida se a pagina existe
					if (array_key_exists($page[0], $settings['pages'])) {

						# # # # valida se a pagina existe
						$result['process']['valida-page'] = true;
					}
				}
			}

			# # Monta erro caso a pagina nao seja valida
			if ($result['process']['valida-page'] == false) {

				$result['erro'] = true;
				$result['done'] = 'A pagina "'.$page[0].'" não esta listada nas configurações';
			}
		}

		# # Valida se é um pedido de help
		if ($page == false) {

			# # # configura help
			$result['process']['@help'] = true;
		}
		# # # # # / VALIDAÇÃO / # # # # # #


		# # # # # / TRATA HELP / # # # # # #
		# Declara o help para a chamada a da função
		if ($result['process']['@help'] == true) {

			# # Decalra em done o help
			$result['done'] = 'Esta sendo esperado ao menos um $page que pode ser uma lista array ou uma string com os valores separados por "->" assim "pagina->pagina2"';
		}
		# # # # # / TRATA HELP / # # # # # #



		# # / INICIA CASO O PROCESSO DE VALIDAÇÃO DE PAGINA ESTEJA CORRETO / # #
		if ($result['process']['valida-page'] == true) {

			# # # # # / RESERVA OS DADOS DAS PAGINAS / # # # # # #
			if ($result['this'] == 'F::page_config') {
				$reserve['@pages'] = $settings['pages'][$page[0]];
				$reserve['@default'] = $settings['pages']['@default'];
			}
			if ($result['this'] == 'me') {
				$reserve['@pages'] = $reserve['@pages'][$page[0]];
				$reserve['@default'] = $reserve['@default'];
			}
			# # # # # / RESERVA OS DADOS DAS PAGINAS / # # # # # #

			# # # #
			# reserva pagina na posição atual
			$me = $reserve['@pages'];
			# # # #

			# # # # # / MONTA DEFAULT / # # # # # #
			# # / TRATA REMOVE DEFAULT / # #
			if (array_key_exists('@no_default', $me)) {

				# # # Adiciona processo de remoção de default
				$result['process']['no_default']['success'] = true;


				# # / TRATA REMOVE DEFAULT / # #
				# # # Valida se é preciso rezetar todos os dados
				if (gettype($me['@no_default']) == 'boolean' && $me['@no_default'] == true) {

					# # # # Apaga os dados de default
					unset($reserve['@default']);

					# # # # Acrecenta um alerta
					$result['process']['no_default']['warning'][] = 'Foi resetado os dados de default da página "'.$page[0].'"';
				}

				# # # Valida se o default é parcial
				if (gettype($me['@no_default']) == 'array') {

					# # # Adiciona processo de remoção de default
					$result['process']['no_default']['success'] = true;

					# # # # Seleciona todos os itens
					for ($i=0; $i < count($me['@no_default']); $i++) { 
						
						# # # # # Trata cada instancia
						switch ($me['@no_default'][$i]) {

							case '@head': unset($reserve['@default']['@head']); break;
							case '@head->title': unset($reserve['@default']['@head']['@title']); break;
							case '@head->meta': unset($reserve['@default']['@head']['@meta']); break;
							case '@head->style': unset($reserve['@default']['@head']['@style']); break;
							case '@head->script': unset($reserve['@default']['@head']['@script']); break;

							case '@body_end': unset($reserve['@default']['@body_end']); break;
							case '@body_end->style': unset($reserve['@default']['@body_end']['@style']); break;
							case '@body_end->script': unset($reserve['@default']['@body_end']['@script']); break;

							case '@include': unset($reserve['@default']['@include']); break;
						}

						# # # # Acrecenta um alerta
						$result['process']['no_default']['warning'][] = 'Foi resetado o default "'.$me['@no_default'][$i].'" da página "'.$page[0].'"';
					}
					unset($i);
				}
			}
			# # / TRATA REMOVE DEFAULT / # #


			# # / VALIDA SE EXISTE DEFAULT / # #
			if (array_key_exists('@default', $me)) {
				
				# # # Adiciona processo de remoção de default
				$result['process']['default']['success'] = true;

				# # # Mescla com o default reservado
				$reserve['@default'] = array_merge_recursive($me['@default'], $reserve['@default']);
			}
			# # / VALIDA SE EXISTE DEFAULT / # #
			# # # # # / MONTA DEFAULT / # # # # # #

			# # # # # / TRATA SE DEVE SER SELECIONADO UMA SUB PASTA / # # # # # #
			if (count($page) > 1) {

				# Decalra processo de sub pastas
				$result['process']['sub-pages']['success'] = true;


				$temp['func']['@default'] = $reserve['@default'];
				$temp['func']['@pages'] = $me;
				$temp['page'] = $page;
				array_shift($temp['page']);

				$result['process']['sub-pages']['log'] = page_config($temp['page'], null,$temp['func']);

				# Caso o sucesso no processo
				if ($result['process']['sub-pages']['log']['success'] == true) {

					# define os valores
					$reserve = $result['process']['sub-pages']['log']['done'];
				}

				unset($temp);
			}

			# valida se é uma solicitação da função
			if ($result['this'] == 'me') {
				
				$result['done']['@default'] = $reserve['@default'];
				$result['done']['@pages'] = $me;
				$result['success'] = true;
			}
			# # # # # / TRATA SE DEVE SER SELECIONADO UMA SUB PASTA / # # # # # #


			# Define o inicio do tratamento dos elementos para essa pagina
			if ($result['this'] == 'F::page_config') {
				
				# # Valida o inicio dos tratamentos
				$result['process']['inicia']['success'] = true;

				$result['process']['inicia']['log']['@page'] = $me;
				$result['process']['inicia']['log']['@default'] = $reserve['@default'];
			}
		}
		# # / INICIA CASO O PROCESSO DE VALIDAÇÃO DE PAGINA ESTEJA CORRETO / # #



		# # / INICIA OS TRATAMENTOS DOS ELEMENTOS/ # #
		if ($result['process']['inicia']['success'] == true) {

			// print_r($result['process']['inicia']);

			# # Valida se é recebido content
			if ($content == true) {

				# # Valida se foi recebido algum desses argumentos e transforma
				if ($content == 'head' || $content == 'body_end' || $content == 'include') {
					
					switch ($content) {
						case 'head': $content = '@head'; break;
						case 'head': $content = '@head'; break;
						case 'head': $content = '@head'; break;
						default:
							# code...
							break;
					}
				}
			}

		}
		# # / INICIA OS TRATAMENTOS DOS ELEMENTOS/ # #



		# # # // # # #
		// $result['done'] = array_search('pages', $settings);

		// $result['me'] = $me;
		// if ($result['this'] == 'F::page_config'){ print_r($result); }

		return $result;
	}

	// page_config(array('adm'));
	page_config(array('adm'), false);

?>
