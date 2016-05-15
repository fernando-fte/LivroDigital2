<?php 

	# # # \ TRATA CAMIMHOS RELATIVOS \ # # #
	function path_relative($post) {
		# $post = $settings['file'] | $settings['dir'] type text

		# # # DECLARA INSTANCIAS DO RESULTADO
		$result = array(
			'success' => null,
			'erro' => null,
			'this' => 'F::path_relative',
			'done' => null,
			'process' => array (
				'path relativo' => array ('success' => true),
				'path no post' => array ('success' => null)
			),
		);

		# # # # # // # # # # # #
		# remove argumentos
		$me = explode('?', $_SERVER['REQUEST_URI'])[0];

		# remove nó root da pasta do projeto
		$me = str_replace($GLOBALS['settings']['wwwproj'], '', $me);

		# explode as barras
		$me = explode('/', $me);

		# #inicia loop para seelecionar o path relativo
		for ($i=0; $i < count($me); $i++) { 

			// print $me[$i]."\n";
			if ($me[$i] != '') {

				$result['done'] .= '../';
			}
		}

		# apaga me
		unset($me);
		# # # # # // # # # # # #

		# # # # # // # # # # # #
		if ($post != false) {
			# reserva resultado do processo de separar o path relativo
			$result['process']['path relativo']['log'] = $result['done'];


			# remove o caminho root do item
			$result['done'] = str_replace($GLOBALS['settings']['wwwroot'].'/', $result['done'], $post);

			# remove caminhos duplos "//"
			$result['done'] = str_replace('//', '/', $result['done']);

			# declara processo como valido
			$result['process']['path no post']['success'] = true;
		}

		# apaga me
		unset($me);
		# # # # # // # # # # # #

		return $result;
	}

	# # # \ HTMLS BASICOS \ # # #
	function html_required($post) {
		// Recebe tipo de tag

		switch ($post['type']) {

			case 'title':
				$result = '<title>'.$post['content'].'</title>';
				break;

			case 'meta':
				$result = '<meta '.$post['content'].'>';
				break;

			case 'css':
				$result = '<link rel="stylesheet" type="text/css" href="'.path_relative($GLOBALS['settings']['file'][$post['content']])['done'].'">';
				break;

			case 'less':
				$result = '<link rel="stylesheet/less" type="text/css" href="'.path_relative($GLOBALS['settings']['file'][$post['content']])['done'].'">';
				break;

			case 'script':
				$result = '<script src="'.path_relative($GLOBALS['settings']['file'][$post['content']])['done'].'"></script>';
				break;

			case 'script-js':
				$result = '<script type="text/javascript" src="'.path_relative($GLOBALS['settings']['file'][$post['content']])['done'].'"></script>';
				break;

			case 'script-coffee':
				$result = '<script type="text/coffeescript" src="'.path_relative($GLOBALS['settings']['file'][$post['content']])['done'].'"></script>';
				break;
		}

		return $result;
	}

	# # # \ CONTRUÇÃO DO HTML \ # # #
	function construct_page_required ($page, $content) {
		# DECLARA INSTANCIAS DO RESULTADO
		$result = array(
			'success' => null,
			'erro' => null,
			'done' => null,
			'this' => 'F::construct_html_required',
			'process' => array (
				'inicia page' => false,
				'inicia content' => false,
				'@help' => false,
				'valida page' => array('success' => true),
				'valida content' => array('success' => true)
			)
		);

		# VALIDAÇÃO INICIAL
		# # Valida se está sendo recebido $page
		if ($page != '') { $result['process']['inicia page'] = true;}

		# # Valida se esta sendo recebido contents
		if ($content != '') { $result['process']['inicia content'] = true;}
		# # # caso content seja vazio preenche como "include"
		else { $content = 'include'; $result['process']['inicia content'] = true; $result['warning']['inicia content'] = 'Foi adicionado automaticamente o valor de "include"'; }

		# # Valida se foi solicitado os solicitadoress
		if ($result['process']['inicia page'] == false ){ $result['process']['@help'] = true; }
		# # # // # # # #

		# CONFIGURA HELP
		if ($result['process']['@help'] == true) {

			$result['erro'] = true;
			$result['done'] = 'A função esta esperando dois valores "$page e $content", $page para a pagina a ser tratada e $content para o tipo de valor a ser retornado, podendo ser "head, script, include" caso vazio ele apenas retornará "include"';
		}
		# # # // # # # #

		# VALIDA SE EXISTE OS ELEMENTOS SOLICITADOS
		if ($result['process']['inicia page'] == true) {

			# # caso nao exista a pagina listada
			if (!array_key_exists($page, $GLOBALS['settings']['page'])) {

				$result['process']['valida page']['success'] = false;
				$result['process']['valida page']['motivo'] = 'Não foi declarada a página "'.$page.'" nas configurações';
				$result['success'] = false;
				$result['erro'] = $result['process']['valida page']['motivo'];
			}

			# # valida se na pagina declara o content existe
			if ($result['process']['valida page']['success'] == true) {

				# # caso nao exista o content listado
				if (!array_key_exists($content, $GLOBALS['settings']['page'][$page])) {

					$result['process']['valida page']['success'] = false;
					$result['process']['valida page']['motivo'] = 'Não foi declarado "'.$content.'" em "'.$page.'"';
					$result['success'] = false;
					$result['erro'] = $result['process']['valida page']['motivo'];
				}

				# # declara success para iniciar todas as outras tarefas
				else { $result['success'] = true; }
			}
		}
		# # # // # # # #

		# INICIA TRATAMENTO PARA OS CONTENTS
		if ($result['success'] != false) {

			# seleciona apenas os itens a setem tratados
			$me = $GLOBALS['settings']['page'][$page][$content];

			# Monta estrutura para HEAD
			if ($content == 'head') {

				# # Inicia head
				$temp['construct'] .= "\n\t<head>";

				# # # Monta cada meta-tag
				if (array_key_exists('meta', $me)) {
					
					# # # # Seleciona cada meta-tag
					foreach ($me['meta'] as $key => $val) {

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
				$temp['construct'] .= "\n\t\t".html_required(array('type'=>'title', 'content'=>$GLOBALS['settings']['page'][$page][$content]['title']));
				# # # //

				# # # Monta css
				if (array_key_exists('style', $me)) {
					foreach ($me['style'] as $key => $val) {

						$temp['construct'] .= "\n\t\t".html_required(array('type'=>$val, 'content'=>$key));
					}

					unset($key, $val);
				}
				# # # //

				# # # Monta script
				if (array_key_exists('script', $me)) {
					foreach ($me['script'] as $key => $val) {

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
			if ($content == 'body_end') {

				# Inicia 
				$temp['construct'] .= "\n";

				# # # Monta script
				if (array_key_exists('script', $me)) {

					foreach ($me['script'] as $key => $val) {

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
			if ($content == 'include') {

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
					$result['process']['include']['erro'] = 'Não foi descrito nem uma lista de inclusão em "'.$page.'"';
					$result['erro'] = $result['process']['include']['erro'];
				}

				unset($me);
			}
		}

		// Imprime solicitação
		// print_r($result);
		return $result;
	}

	# # # # \ TRATA PARAMETROS DE NAVEGAÇÃO \ # # # #
	
?>
