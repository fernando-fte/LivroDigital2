<?php
	
	// print_r(expression);
	// print_r(gettype($GLOBALS['get']['teste']));
	// print_r(
	// 	urldecode(parse_url($_SERVER['REQUEST_URI'])['query'])
	// );
	// http_build_query(parse_url($_SERVER['REQUEST_URI'])['query'])

	// teste=1&2=3


	// print_r($GLOBALS['get']);

	function monta_navegacao ($func) {

		# # # DECLARA INSTANCIAS DO RESULTADO
		$result = array(
			'success' => null,
			'erro' => null,
			'this' => 'F::monta_navegacao',
			'done' => null,
			'process' => array (
				'loop-paginas' => array(
					'success' => null
				),
			),
		);

		# # # DECLARA INSTANCIAS RESERVADAS
		$reserve = array(
			'map' => null,
			'position' => null,
			'nav' => null
		);


		# # # \ VALIDA SE É UMA SUB-SOLICITAÇÃO \ # # #
		if ($func != false) { $result['this'] = 'me'; }
		# # # \ VALIDA SE É UMA SUB-SOLICITAÇÃO \ # # #


		# # # \ RESERVA OS VALORES \ # # #
		# caso não seja uma suv função
		if ($result['this'] != 'me') {
			$reserve['map'] =  explode('/', explode('?', str_replace($GLOBALS['settings']['wwwproj'], '', $_SERVER['REQUEST_URI']))[0]);
			$reserve['position'] = 0;
			$reserve['nav'] = $GLOBALS['settings']['pages'];

			# # # # \ Apaga todos os valores nulos \ # # # #
			$me = $reserve['map'];
			$reserve['map'] = array();
			for ($i=0; $i < count($me); $i++) { 

				# # # Seleciona apenas o valor valido
				if ($me[$i] != '') {
					array_push($reserve['map'], $me[$i]);
				}
			}
			unset($i, $me);
			# # # # \ Apaga todos os valores nulos \ # # # #
		}
		# caso seja uma suv função
		if ($result['this'] == 'me') { $reserve =  $func; }
		# # # \ RESERVA OS VALORES \ # # #

		# # # \ INICIA NAVEGAÇÃO EM LOOP \ # # #
		if (count($reserve['map']) > 0) {

			# Inclui em $me o valor reservado
			$me = $reserve['map'];

			# # Seleciona o primeiro item da posição valido
			$i = $reserve['position'];

			# # # Guarda valor da proxima posição
			$reserve['position'] = ($i + 1);

			# # # Valida se existe a pagina
			if (array_key_exists($me[$i], $reserve['nav'])) {

				# # # # Valida se existe mais argumentos
				if (count($me) > ($i + 1) ) {

					# # # # # re envia os dados para as sub funções
					$reserve = monta_navegacao(array('map' => $me, 'position' => $reserve['position'], 'nav' => $reserve['nav'][$me[$i]]))['done'];
				}

				# # # # Valida se é o ultimo argumento
				if (count($me) == ($i + 1) ) {
					$reserve['position']++;
				}
			}

			unset($i, $me);


			# # # Retorna dados caso a função seja sub-função
			if ($result['this'] == 	'me') {
				
				# # # Reserva como pronto os dados tratados
				$result['done'] = $reserve;
			}

			# # # Trata os dados
			if ($result['this'] != 	'me') {

				# # Reserva dados a serem tratados
				$me = $reserve['map'];

				# # Diminui 1 posição
				$reserve['position']--;

				# # declara valores
				$result['done'] = array('path' => array(), 'query' => array());

				# # Trata cada item
				for ($i=0; $i < count($me); $i++) { 

					# # # Caso seja um caminho de pastas
					if ($i < $reserve['position']) {
						array_push($result['done']['path'], $me[$i]);
					}

					# # # Caso seja um comanda GET
					if ($i >= $reserve['position']) {
						array_push($result['done']['query'], $me[$i]);

					}
				}
				unset($me, $i);

				# # Valida se existe algum parametro e retorna falso caso nao tenha
				$result['done']['path'] = (count($result['done']['path']) == 0 ? false : $result['done']['path']);
				$result['done']['query'] = (count($result['done']['query']) == 0 ? false : $result['done']['query']);

				# # Trata query
				if ($result['done']['query'] != false) {

					# # # Valida se a pagina trata query
					if (array_key_exists('@query', $reserve['nav'])) {
						$me = $reserve['nav']['@query'];
						$temp = array();

						# valida se é do tipo group
						if (array_key_exists('@group', $me)) {

							for ($i=0; $i < count(array_keys($me['@group'])); $i++) { 
								$k = array_keys($me['@group'])[$i];
								$v = array_values($me['@group'])[$i];

								# # MOnsta chaves
								$temp[$result['done']['query'][$k]] = $result['done']['query'][$v];

								# # remove chaves
								unset($result['done']['query'][$k], $result['done']['query'][$v]);
							}
							unset($i, $k, $v);

						}

						if (array_key_exists('@double', $me)) {
							for ($i=0; $i < count($result['done']['query']); $i++) { 
								# reserva double
								$temp[$result['done']['query'][$i]] = $result['done']['query'][($i + 1)];

								# # remove chaves
								unset($result['done']['query'][$k], $result['done']['query'][$v]);

								# adiona de dois em dois
								$i = $i + 2;
							}
							unset($i);
						}

						if (array_key_exists('@next', $me)) {

							# Inverte cada instancia
							$b = array_flip($result['done']['query']);
							for ($i=0; $i < count($me['@next']); $i++) { 

								# reserva valor especifico
								$temp[$me['@next'][$i]] = $result['done']['query'][($b[$me['@next'][$i]] + 1)];

								unset($result['done']['query'][($b[$me['@next'][$i]] + 1)], $result['done']['query'][$b[$me['@next'][$i]]]);
							}
							unset($a, $b, $i);
						}


						# # # Finaliza montagem
						$result['done']['query'] = array_values($result['done']['query']);
						for ($i=0; $i < count($result['done']['query']); $i++) { 
							
							$temp[$result['done']['query'][$i]] = '';
						}
	
						$result['done']['query'] = $temp;
						unset($i, $temp);
						# # # //
					}

					# # # Inverte todos os valores
					else {
						$result['done']['query'] = array_values($result['done']['query']);
						for ($i=0; $i < count($result['done']['query']); $i++) { 							
							$temp[$result['done']['query'][$i]] = '';
						}
						$result['done']['query'] = $temp;
						unset($i, $temp);
					}
				}
			}

			return $result;
		}
	}

	// print_r(monta_navegacao()['done']);
	// monta_navegacao();

?>
