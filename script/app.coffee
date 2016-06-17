# console.log 'oi'
# Inicia serviço de toltip
$('[data-toggle="tooltip"]').tooltip()

# DEFINE GLOBAL PARA USUARIO E DADOS GLOBAIS
window.app = {
	'user':{
		'client':md5(window.navigator.userAgent),
		'nome':'Fernando Truculo Evangelisa',
		'log':'0000000001', # Define id do log
		'key':'a0000000001' # Define a chave do log
	},

	# Define valor base para função
	'result':{
		'success': null, # Retorna o resultado valido
		'erro': null, # retorna lista de erros
		'this': null, # nome da função
		'done': null, # valores tratados prontos
		'process': {} # constroi um conjunto de processos
	}

	# F::send // Função para tratar envio
	'send':{},

	# F::ctrl // Função para tratar os controles
	'ctrl':{}
}
# # # # 


# FUNÇÃO PARA IDENTIFICAR OS CONTROLES
window.app.send = (post, func) ->
	###
	// post = recebe conjunto de objeto com os parametros para o servidor
	###

	# # Configura os dados base
	result = window.app.result
	result.this = 'F::send'
	result.process = {
		'client': false
	}
	# # # #

	# # Define dados de envio
	send = {'ajax': {'user':window.app.user, 'query':post}}
	# # # #

	# # Valida o cliente antes de enviar
	if send.ajax.user.client is md5(window.navigator.userAgent)
		result.process.client = true # Define o processo cliente válido
	
	else result.erro = {'client':'O cliente não é o mesmo declarado'} # Define o processo cliente válido
	# # # #

	# # Valida os dados do client
	if result.process.client is true

		# Função ajax
		$.ajax(
			type: "post"
			url: "index.php" #local no php
			cache: false
			data: send
			async: false
		)

		# resultado de retorno
		.done (data) -> 
			# console.log data # exibe valor de data
			console.log data
			# result.done = data

	return result
# # # #

# FUNÇÃO PARA INICIAR OS CONTROLES
window.app.ctrl = (post, func) ->
	###
	// post = recebe os valores dom do html
	###

	# # Valida se existe algum controle
	if post.find('[data-ctrl]').length > 0

		# # # Inicia loop para selecionar cada valor
		count = post.find('[data-ctrl]').length # Numero de resultados
		i = 0 # Contador

		while i < count # loop

			# # Define o valor atual de controle
			me = post.find('[data-ctrl]')[i]

			# # Reserva os valores de controle
			ctrl = $(me).data('ctrl')

			# # Adiciona identificador
			ctrlId = $(me).attr("data-ctrl-id-#{md5(me)}", true)

			# # F:: Formulario
			window.app.form ctrl['form'], ctrlId if ctrl['form'] != undefined


			# # # #
			# # # # Remove o atributo data
			$(me).removeAttr('data-ctrl')

			i++
		# # # #
	# # # #
# # # #

# FUNÇÃO PARA TRATAR OS FORMULARIOS
window.app.form = (post, seletor, func) ->
	###
	// post = recebe os dados de tratamento
		   // action = ID do botão de envio ou ação de inicio
		   // name = nome do formulario
	// seletor = rebece o data-id
	###

	# # Valida se o seletor de envio existe
	if $(seletor).find(post['action']) != undefined

		# # # Adiciona evento de clique na ação
		$(seletor).find(post['action']).click ->

			# # Validador 
			valida = true
			data = {}

			# # Valida todos os campos
			i = 0
			while i < $(seletor).find('[name]').length

				# # # Reserva valor
				me = $(seletor).find('[name]')[i]

				# # # Define valida como falso
				if me.checkValidity() is false
					valida = false

				# # # 
				else
					# # Seleciona valor de radio
					if me.type is 'radio' or  me.type is 'checkbox'
						data[me.name] = me.value if me.checked is true

					else if me.type is 'input' or me.tagName is 'SELECT' or me.tagName is 'TEXTAREA'
						data[me.name] = me.value
				# # # #

				# TODO: adiciona balão de validação

				i++
			# # # #

			# # Inicia envio para o php
			if valida is true
				# # # Envia para a função
				window.app.send {'form':post['name'], 'input':data}

			# # # #

			# console.log $('#html-data')[0].checkValidity()
# # # #


# Solicita enviar
window.app.ctrl $('body')
# console.log  window.app.ctrl $('body')

