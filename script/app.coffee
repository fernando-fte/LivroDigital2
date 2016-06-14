# console.log 'oi'
# TInicia serviço de toltip
$('[data-toggle="tooltip"]').tooltip()

# DEFINE GLOBAL PARA USUARIO E DADOS GLOBAIS
window.app = {
	'user':{
		'client':md5(window.navigator.userAgent),
		'nome':'Fernando Truculo Evangelisa',
		'log':'0000000001', # Define id do log
		'key':'a0000000001' # Define a chave do log
	},

	'send':{}
}
# # # # 


# FUNÇÃO PARA TRATAR OS PARAMETROS
window.app.send = (post, func) ->
	result = {
		'success': null,
		'erro': null,
		'this': 'F::send',
		'done': null,
		'process': {
			'client': false
		}
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

	if result.process.client is true
		# TODO: Envia os dados para o php
		result.done = 'envia para o php' # REMOVER

	return result
# # # #

# Solicita enviar
console.log window.app.send 'oi'

