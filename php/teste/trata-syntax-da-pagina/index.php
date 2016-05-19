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

					'@title' => 'Home',

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
						'@title' => 'ADM',
						'@style' => array(
							// name-path-file => type-file-include
							'bootstrap-css' => 'css',
							'fontawesome' => 'css',
							'style-less'  => 'less'
						),
					)
				),

				'login' => array(
					'@head' => array(
						'@title' => 'Login',
					),

					'@include' => array(
						$GLOBALS['settings']['dir']['php'].'/teste/include_teste.php'
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
				'no_default' => array('success' => null),
				'inicia content' => false,
				'valida content' => array('success' => true)
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
				$reserve['@default'] = array_replace_recursive($reserve['@default'], $me['@default']);
			}
			# # / VALIDA SE EXISTE DEFAULT / # #
			# # # # # / MONTA DEFAULT / # # # # # #

			# # # # # / TRATA SE DEVE SER SELECIONADO UMA SUB PASTA / # # # # # #

			# # valida se é uma solicitação da função
			if ($result['this'] == 'me') {

				$result['done']['@default'] = $reserve['@default'];
				$result['done']['@pages'] = $reserve['@pages'];
				$result['success'] = true;
			}

			# # Solicita sub-valor
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
			# # # # # / TRATA SE DEVE SER SELECIONADO UMA SUB PASTA / # # # # # #

			# # # / Define o inicio do tratamento dos elementos para essa pagina / # # #
			if ($result['this'] == 'F::page_config') {

				# # Valida o inicio dos tratamentos
				$result['process']['inicia']['success'] = true;

				# # Mescla parametros da pagina con default
				# # # Cria lista pra validação
				$temp['list'] = array('@head', '@body_end', '@include');

				// print_r($reserve['@pages']);
				// print_r($reserve['@default']);

				# # # Inicia loop para selecionar cada tipo de item
				for ($i=0; $i < count($temp['list']); $i++) { 

					// $reserve['@default']['@include'] = array();

					# # # # Valida se existe as condições na pagina
					if (array_key_exists($temp['list'][$i], $reserve['@pages'])) {

						# # # # # Adiciona o elemento em default se nao existe
						if (!array_key_exists($temp['list'][$i], $reserve['@default'])) {
							$reserve['@default'][$temp['list'][$i]] = array();
						}

						# # # # # Subistitui o reserve->default pelos parametros da pagina
						$reserve['@default'][$temp['list'][$i]] = array_replace_recursive($reserve['@default'][$temp['list'][$i]], $reserve['@pages'][$temp['list'][$i]]);
					}
				}
				unset($temp, $i); // Paga os valores utilizados
			}
			# # # / Define o inicio do tratamento dos elementos para essa pagina / # # #
		}

		unset($me); // Apaga os parametros usados temposariamente
		# # / INICIA CASO O PROCESSO DE VALIDAÇÃO DE PAGINA ESTEJA CORRETO / # #



		# # / INICIA OS TRATAMENTOS DOS ELEMENTOS/ # #
		if ($result['process']['inicia']['success'] == true) {


			# # Valida se é recebido um content
			if ($content == true) {

				# # Modifica as condições recebidas caso contrario usa o include
				switch ($content) {
					case 'head': $content = '@head'; break;
					case 'body_end': $content = '@body_end'; break;
					case 'include': $content = '@include'; break;
				}

				# # Valida se esta sendo recebido contents
				if ($content != '') { $result['process']['inicia content'] = true;}
				# # # caso content seja vazio preenche como "include"
				else { $content = '@include'; $result['process']['inicia content'] = true; $result['warning']['inicia content'] = 'Foi adicionado automaticamente o valor de "include"'; }

				# seleciona apenas os itens a setem tratados
				$me = $reserve['@default'][$content];

				# Monta estrutura para HEAD
				if ($content == '@head') {

					# # Inicia head
					$temp['construct'] .= "\n\t<head>";

					# # # Monta cada meta-tag
					if (array_key_exists('@meta', $me)) {
						
						# # # # Seleciona cada meta-tag
						foreach ($me['@meta'] as $key => $val) {

							# # # # # Valida se é um conjunto de metas do tipo configruação
							if ($key == '@config') {

								# # # # # # Seleciona cada item dentro de config
								for ($i=0; $i < count($val); $i++) { 

									# # # # # # Separa temp->meta para reservar o conjunto de atributos
									$temp['meta'] = '';

									# # # # # # Explode cada item na posição atual
									foreach ($val[$i] as $key2 => $val2) {
										$temp['meta'] .= '"'.$key2.'"="'.$val2.'" ';
									}

									# # # # # # adiona o a meta tag de configruação
									$temp['construct'] .= "\n\t\t".html_required(array('type'=>'meta', 'content'=>$temp['meta']));

									unset($key2, $val2);
								}

								unset($i,$temp['meta']);
							}

							# # # # # valida se as meta são de indexação
							else {

								$temp['construct'] .= "\n\t\t".html_required(array('type'=>'meta', 'content'=>'"name"="'.$key.'" "content"="'.$val.'"'));
							}
						}

						unset($key, $val);
					}
					# # # //

					# # # Adiciona title
					$temp['construct'] .= "\n\t\t".html_required(array('type'=>'title', 'content'=>$me['@title']));
					# # # //

					# # # Monta css
					if (array_key_exists('@style', $me)) {
						foreach ($me['@style'] as $key => $val) {

							$temp['construct'] .= "\n\t\t".html_required(array('type'=>$val, 'content'=>$key));
						}

						unset($key, $val);
					}
					# # # //

					# # # Monta script
					if (array_key_exists('@script', $me)) {
						foreach ($me['@script'] as $key => $val) {

							$temp['construct'] .= "\n\t\t".html_required(array('type'=>$val, 'content'=>$key));
						}

						unset($key, $val);
					}
					# # # //

					# # Fecha head
					$temp['construct'] .= "\n\t</head>";
					$temp['construct'] .= "\n";

					# reserva os dados tratados em done
					$result['done'] = $temp['construct'];

					# imprime done
					echo $result['done'];

					# apaga temp
					unset($temp);
				}

				# Monta estrutura para BODY_END
				if ($content == '@body_end') {

					# Inicia 
					$temp['construct'] .= "\n";

					# # # Monta script
					if (array_key_exists('@script', $me)) {

						foreach ($me['@script'] as $key => $val) {

							$temp['construct'] .= "\n\t\t".html_required(array('type'=>$val, 'content'=>$key));
						}

						unset($key, $val);
					}
					# # # //

					# Fecha
					$temp['construct'] .= "\n";

					# reserva os dados tratados em done
					$result['done'] = $temp['construct'];

					# imprime done
					echo $result['done'];

					# apaga temp
					unset($temp);
				}

				# Monta estrutura para INCLUDE
				if ($content == '@include') {

					# # # Valida se existe includes
					if (count($me) > 0) {

						# # # Navega em cada valor a ser incluido
						for ($i=0; $i < count($me); $i++) { 

							# # # inclui cada item da biblioteca
							include path_relative($me[$i])['done'];

							$result['process']['include']['log'][$i] = path_relative($me[$i])['done'];
						}

						$result['success'] = true;
					}

					# # # Caso não exista includes
					else {
						$result['success'] = false;
						$result['process']['include']['success'] = false;
						$result['process']['include']['erro'] = 'Não foi descrito nem uma lista de inclusão em "'.$page[0].'"';
						$result['erro'] = $result['process']['include']['erro'];
					}

					unset($me);
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

	// page_config(array('adm', 'login'), 'body_end');
?>
