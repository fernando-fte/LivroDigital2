# FUNÇÃO PARA TRATAR HTMLDATA
window.app.htmldata = (post, seletor, func) ->
	# # Seleciona e reserva os contents
	container = $([seletor])[0]

	# reserve = {
	# 	"nome":$(container).find('[data-book-livro]').text(),
	# 	"idfull":md5($(container).find('[data-book-livro]').text()+microtime())
	# }

	# # Reserva os valores
	reserve = {nome:null, id:null, autor:{list:{}}, introducao:{text:{}, video:null}, conclusao:{text:{}, video:null}, referencias:{}}


	# # Título do livro
	reserve.nome = $(container).find('[data-book-livro]').text()

	# # ID do livro
	reserve.id = $(container).find('[data-book-id]').data('book-id')
	# # # ID Caso nao seja declarado o id
	reserve.id = md5(reserve.nome + microtime()) if $(container).find('[data-book-id]').data('book-id') is undefined 
	# # 

	# # Introducao
	reserve.introducao = {text:$(container).find('[data-book-introducao-text]').html(), video:$(container).find('[data-book-introducao-video]').data('book-introducao-video')}

	# # Conclusao
	reserve.conclusao = {text:$(container).find('[data-book-conclusao-text]').html(), video:$(container).find('[data-book-conclusao-video]').data('book-conclusao-video')}

	# # Referencias


	# # Autor container
	i = 0
	while i < $(container).find('[data-book-autor]').length
		me = $($(container).find('[data-book-autor]')[i])

		# # # Adiciona autor na lista
		reserve.autor.list[i] = me.find('[data-book-autor-nome]').text()

		# # # Cria autor
		reserve.autor[reserve.autor.list[i]] = {}

		# # # Nome do autor
		reserve.autor[reserve.autor.list[i]].nome = me.find('[data-book-autor-nome]').text()

		# # # Imagem do autor
		reserve.autor[reserve.autor.list[i]].foto = me.find('[data-book-autor-img]').attr('src')

		# # # Titulacao
		reserve.autor[reserve.autor.list[i]].titulacao = {}
		u = 0
		while u < me.find('[data-book-autor-titulacao-item]').length

			# # # # #Titulacao item
			reserve.autor[reserve.autor.list[i]].titulacao[u] = $(me.find('[data-book-autor-titulacao-item]')[u]).text()

			u++
		# # #

		i++
	# # #


	# while $(container).find('[data-book-autor]').lenght

	



	console.log reserve



window.app.ctrl $('body')

