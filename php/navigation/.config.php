<?php

	# # # # # # # # # / CONFIGURA DADOS DE GET E POST / # # # # # # # # #
	# Valida se já foi definido os parametros
	if(!array_key_exists('post', $GLOBLAS)) { $post = $_POST; }
	if(!array_key_exists('get', $GLOBLAS)) { $get = $_GET; }
	# # # # # # # # # / CONFIGURA DADOS DE GET E POST / # # # # # # # # #



	# # # / VALIDA SE FOI RECEBIDO UM CONJUNTO DE QUERY / # # #
	if (parse_url($_SERVER['REQUEST_URI'])['query'] != false) {
		
		# # Explode as variaves
		$me = explode('&', parse_url($_SERVER['REQUEST_URI'])['query']);

		# # Reserva dados 
		$temp['query_decode']['get'] = array();

		# # # Seleciona cada argumento
		for ($i=0; $i < count($me); $i++) { 

			$temp['query_decode']['me'] = explode('=', $me[$i]);
			$temp['query_decode']['get'][$temp['query_decode']['me'][0]] = ($temp['query_decode']['me'][1] ? $temp['query_decode']['me'][1] : '');
		}
		unset($i);

		# # # Mescla os dados de @get
		$get = array_replace_recursive($temp['query_decode']['get'], $get);

		# # # Apaga dados usados
		unset($temp, $me);
	}
	# # # / VALIDA SE FOI RECEBIDO UM CONJUNTO DE QUERY / # # #



	# # # / CONFIGURA PAGINAS EM GET / # # #
	if (!array_key_exists('page', $get)) { $get['page'] = array('home'); }
	# # # / CONFIGURA PAGINAS EM GET / # # #



	# # # # # / CONFIGURA NAGEVAÇÃO / # # # # #
	$temp = parse_navgation()['done'];

	if ($temp['path'] != false) {
		$get['page'] = $temp['path'];
	}
	if ($temp['query'] != false) {
		$get = array_replace_recursive($temp['query'], $get);
	}
	unset($temp);
	# # # # # / CONFIGURA NAGEVAÇÃO / # # # # #



	# # # # # / ADICIONA CONSTRUCT DE PAGINAS / # # # # #
	if (array_key_exists('ajax', $post)){
		// print_r($get['page']);
		include 'construct/page.includes.php';
	}
	# Caso o post seja um ajax
	else if (!array_key_exists('ajax', $post)){
		include 'construct/page.full.php';
	}
	# # # # # / ADICIONA CONSTRUCT DE PAGINAS / # # # # #
?>
