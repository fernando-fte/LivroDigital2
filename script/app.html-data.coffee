# FUNÇÃO PARA TRATAR HTMLDATA
window.app.htmldata = (post, seletor, func) ->
	# # Seleciona e reserva os contents
	container = $([seletor])[0]

	# livro = {
	# 	"nome":$(container).find('[data-book-livro]').text(),
	# 	"idfull":md5($(container).find('[data-book-livro]').text()+microtime())
	# }

	# # Reserva os valores basico do livro
	livro = {nome:null, id:null, autor:{list:{}}, introducao:{text:{}, video:null}, conclusao:{text:{}, video:null}, referencias:{}, capitulo:{list:{}}}

	artigo = {}


	# # Título do livro
	livro.nome = $(container).find('[data-book-livro]').text()

	# # ID do livro
	livro.id = $(container).find('[data-book-id]').data('book-id')
	# # # ID Caso nao seja declarado o id
	livro.id = md5(livro.nome + microtime()) if $(container).find('[data-book-id]').data('book-id') is undefined 
	# # 

	# # Introducao
	livro.introducao = {text:$(container).find('[data-book-introducao-text]').html(), video:$(container).find('[data-book-introducao-video]').data('book-introducao-video')}

	# # Conclusao
	livro.conclusao = {text:$(container).find('[data-book-conclusao-text]').html(), video:$(container).find('[data-book-conclusao-video]').data('book-conclusao-video')}

	# # Referencias
	i = 0
	while i < $(container).find('[data-book-referencias-item]').length

		# # # Cria contents da referencia
		livro.referencias[i] = {text:null, link:null}

		# # # texto da treferencia
		livro.referencias[i].text = $($(container).find('[data-book-referencias-item]')[i]).html()

		# # # link da referencia
		if $($(container).find('[data-book-referencias-item]')[i]).data('book-referencias-item') != ''
			livro.referencias[i].link = $($(container).find('[data-book-referencias-item]')[i]).data('book-referencias-item')
		else livro.referencias[i].link = false
		
		i++
	# # #


	# # Autor container
	i = 0
	while i < $(container).find('[data-book-autor]').length
		me = $($(container).find('[data-book-autor]')[i])

		# # Numero do autor
		n = me.data('book-autor')

		# # # Adiciona autor na lista
		livro.autor.list[n] = me.find('[data-book-autor-nome]').text()

		# # # Cria autor
		livro.autor[livro.autor.list[n]] = {nome:null, foto:null, titulacao:{}, sobre:null}

		# # # Nome do autor
		livro.autor[livro.autor.list[n]].nome = me.find('[data-book-autor-nome]').text()

		# # # Imagem do autor
		livro.autor[livro.autor.list[n]].foto = me.find('[data-book-autor-img]').attr('src')

		# # # Informações do autor
		livro.autor[livro.autor.list[n]].sobre = me.find('[data-book-autor-info]').html()

		# # # Titulacao
		u = 0
		while u < me.find('[data-book-autor-titulacao-item]').length

			# # # # #Titulacao item
			livro.autor[livro.autor.list[n]].titulacao[u] = $(me.find('[data-book-autor-titulacao-item]')[u]).text()

			u++
		# # #

		i++
	# # #


	# # Seleciona capitulo
	i = 0
	while i < $(container).find('[data-book-unidade]').length


		# # Numero do capitulo
		n = $($(container).find('[data-book-unidade]')[i]).data('book-unidade')

		# # Content da introducao
		me = $($($(container).find('[data-book-unidade]')[i]).find('[data-book-unidade-info]')[0])

		# # # Define capitulo na lista
		livro.capitulo.list[n] = me.find('[data-book-unidade-titulo]').html()

		# # # Declara os valores da lista
		livro.capitulo[livro.capitulo.list[n]] = {nome:null, id:null, capa:null, numero:null, introducao:null, autor:{}}

		# # # Sequencia do capitulo
		livro.capitulo[livro.capitulo.list[n]].numero = n

		# # # titulo do capitulo
		livro.capitulo[livro.capitulo.list[n]].nome = me.find('[data-book-unidade-titulo]').html()

		# # # Id do capitulo
		livro.capitulo[livro.capitulo.list[n]].id = md5(livro.capitulo[livro.capitulo.list[n]].nome + microtime())

		# # # Capa da unidade
		livro.capitulo[livro.capitulo.list[n]].capa = me.find('[data-book-unidade-capa]').attr('src')

		# # # Introdução
		livro.capitulo[livro.capitulo.list[n]].introducao = me.find('[data-book-unidade-introducao]').html()


		# # # Autor
		u = 0
		while u < me.find('[data-book-unidade-autor]').length
			# # # Numero do autor
			autor = livro.autor[livro.autor.list[me.find('[data-book-unidade-autor]').data('book-unidade-autor')]]

			# # # Declara valores do autor
			livro.capitulo[livro.capitulo.list[n]].autor[u] = { nome: autor.nome, titulacao: autor.titulacao, foto: autor.foto}

			u++
		# # # #

		i++
	# # #

	# # Seleciona artigos
	# // primeiro capitulo
	capitulo = $($(container).find('[data-book-unidade-content]')[0])

	# # Numero do capitulo
	c = 1

	# # Trata artigos
	# // primeiro artigo
	me = $(capitulo.children()[0])

	# # ID do artigo
	id = md5(me.find('h1').text() + microtime())

	# # #  Declara os contens do artigo
	artigo[id] = {nome:null, id:null, contents:null, info:{livro:{}}, autor:null, elementos:{grafico:{}, figura:{}, tabela:{}, quadro:{}, infografico:{}}, atividade:{}}

	# # # Titulo do artigo
	artigo[id].nome = me.find('h1').text()

	# # # Id do artigo
	artigo[id].id = id

	# # # Informações do artigo
	artigo[id].info.livro[livro.id] = {nome:livro.nome, capitulo:{nome:livro.capitulo[livro.capitulo.list[c]].nome, numero:livro.capitulo[livro.capitulo.list[c]].numero}}

	# # # Autor
	artigo[id].autor = livro.capitulo[livro.capitulo.list[c]].autor

	# # # Capitulo

	# # # Elementos Graficos do artigo

	# # # Secoes do artigo

	# # # Atividades do artigo

	# # # Conteudo do html


	# console.log me.find('h1').text()

	console.log artigo[id]




window.app.ctrl $('body')

