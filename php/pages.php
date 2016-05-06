<?php 

	# # # HTMLS BASICOS
	function html_required($post) {
		// Recebe tipo de tag

		switch ($post['type']) {

			case 'title':
				$result = '<title>'.$GLOBALS['settings']['page'][$post['content']]['title'].'</title>';
				break;

			case 'css':
				$result = '<link rel="stylesheet" type="text/css" href="'.$GLOBALS['settings']['file'][$post['content']].'">';
				break;

			case 'less':
				$result = '<link rel="stylesheet/less" type="text/css" href="'.$GLOBALS['settings']['file'][$post['content']].'">';
				break;

			case 'script':
				$result = '<script src="'.$GLOBALS['settings']['file'][$post['content']].'"></script>';
				break;

			case 'script-js':
				$result = '<script type="text/javascript" src="'.$GLOBALS['settings']['file'][$post['content']].'"></script>';
				break;

			case 'script-coffee':
				$result = '<script type="text/coffeescript" src="'.$GLOBALS['settings']['file'][$post['content']].'"></script>';
				break;
		}

		return $result;
	}

	# # # CONTRUÇÃO DO HTML
	function construct_html_required ($post) {
		// $post = text //recebe o tipo de arquivo a ser montado



		$temp['construct'] = false;

		// Monta HEADER
		if ($post == 'header') {

			$temp['construct'] .= "\n\t<header>";
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'title', 'content'=>$GLOBALS['get']['page']));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'css', 'content'=>'bootstrap-css'));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'css', 'content'=>'fontawesome'));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'less', 'content'=>'style-less'));
			$temp['construct'] .= "\n\t</header>";
			$temp['construct'] .= "\n";
		}

		// Monta scripts
		if ($post == 'script') {

			$temp['construct'] .= "\n";
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'script', 'content'=>'jquery'));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'script', 'content'=>'coffee'));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'script', 'content'=>'less'));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'script', 'content'=>'bootstrap-js'));
			$temp['construct'] .= "\n\t\t".html_required(array('type'=>'script-coffee', 'content'=>'app-coffee'));
			$temp['construct'] .= "\n";
		}

		// Adiciona para return
		$return = $temp['construct'];

		// Imprime solicitação
		echo $return;
	}
?>
