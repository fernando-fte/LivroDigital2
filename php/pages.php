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
				$result = '<title>'.path_relative($GLOBALS['settings']['page'][$post['content']]['title'])['done'].'</title>';
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
	function construct_html_required ($post) {
		// $post = text //recebe o tipo de arquivo a ser montado

		$temp['construct'] = false;

		// Monta HEADER
		if ($post == 'head') {

			$temp['construct'] .= "\n\t<head>";
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'title', 'content'=>$GLOBALS['get']['page']));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'css', 'content'=>'bootstrap-css'));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'css', 'content'=>'fontawesome'));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'css', 'content'=>'style-css'));
			$temp['construct'] .= "\n\t</head>";
			$temp['construct'] .= "\n";
		}

		// Monta scripts
		if ($post == 'script') {

			$temp['construct'] .= "\n";
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'script', 'content'=>'jquery'));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'script', 'content'=>'coffee'));
			// $temp['construct'] .= "\n\t\t".html_required(array('type'=>'script', 'content'=>'less'));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'script', 'content'=>'bootstrap-js'));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'script-coffee', 'content'=>'app-coffee'));
			$temp['construct'] .= "\n";
		}

		// Adiciona para return
		$return = $temp['construct'];

		// Imprime solicitação
		echo $return;
	}

	# # # \ INCLUSAO DE PAGINAS COMPLETAS \ # # #
	function construct_page_required ($post) {

		// DECLARA INSTANCIAS DO RESULTADO
		$result = array(
			'success' => null,
			'erro' => null,
			'this' => 'F::construct_page_required',
			'process' => array (
				'inicia' => array (
					'success' => true
				),
				'include' => array (
					'success' => null
				)
			)
		);

		# # # Valida se existe o conjunto de infomações
		if (array_key_exists($post, $GLOBALS['settings']['page'])) {

			$me = $GLOBALS['settings']['page'][$post];

			# # # Valida se existe includes
			if (array_key_exists('include', $me) == true || count($me['include']) > 0) {

				// echo  'ok';

				# # # Navega em cada valor a ser incluido
				for ($i=0; $i < count($me['include']); $i++) { 

					# # # inclui cada item da biblioteca
					include path_relative($me['include'][$i])['done'];

					$result['process']['include']['log'][$i] = path_relative($me['include'][$i])['done'];
				}

				$result['success'] = true;
			}

			# # # Caso não exista includes
			else {
				$result['success'] = false;
				$result['process']['include']['success'] = false;
				$result['process']['include']['erro'] = 'Não foi descrito uma lista de inclusão para "'.$post.'"';
				$result['erro'] = $result['process']['include']['erro'];
			}

			unset($me);
		}

		# # # caso não exista o conjunto de informações solicitadas
		else {
			$result['success'] = false;
			$result['process']['inicia']['success'] = false;
			$result['process']['inicia']['erro'] = 'Não foi declarado "'.$post.'"';
			$result['erro'] = $result['process']['inicia']['erro'];
		}

		return $result;
	}
?>
