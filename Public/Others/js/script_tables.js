$(document).ready(function() {
	$('#datatables-reponsive').DataTable({
		"bProcessing": true,
		"deferRender": true,
		"oLanguage": {
			"sProcessing": "Processando",
			"sLengthMenu": "Mostrar _MENU_ registros por página",
			"sZeroRecords": "Nenhum registro encontrado com esses critérios",
			"sEmptyTable": "Não há dados a serem mostrados",
			"sLoadingRecords": "Carregando...",
			"sInfo": "Mostrando de _START_ a _END_ de um total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando 0 até 0 de 0 registro(s)",
			"sInfoFiltered": "(filtro aplicado em _MAX_ registros)",
			"sinfoPostFix": "",
			"sinfoThousands": ".",
			"sSearch": "Pesquisar: ",
			"sUrl": "",
			"oPaginate":{
				"sFirst": "Primeira",
				"sPrevious": "Anterior",
				"sNext": "Próxima",
				"sLast": "Última",
			},
		},
		"pageLength": 10,
		"scrollX": true,
		"sScrollX": "100%",
		"sScrollXInner": "100%",
		"aaSorting": [[0, "asc"]]
	});
} );