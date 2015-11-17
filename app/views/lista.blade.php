@if(!empty($fefas))

{{ Form::open(['route'=>'fefa.create','method'=>'get' ,'class'=>'navbar-form navbar-right', 'onSubmit'=>'load()']) }}
	<div class="form-group has-warning">
    	<input type="text" class="form-control" placeholder="Adicionar nota pela chave de acesso" autofocus size="50" name="chave">
    </div>
  {{ Form::close() }}

<div class="table-responsive">

<table class="table table-hover" id="fefa">
	<thead>
		<tr>
			<th>Data Compra</th>
			<th>NFE</th>
			<th>NFP</th>
			<th>Cidade</th>
			<th>Produtor</th>
			<th>Propriedade</th>
			<th>Qtd Macho</th>
			<th>Qtd Femeas</th>
		</tr>
	</thead>
	<tbody>
		@foreach($fefas as $fefa)
		<tr>
			<td>{{ date('d/m/Y', strtotime($fefa->data_compra)) }}</td>
			<td>{{ link_to_route('fefa.edit', $fefa->nfe, $fefa->id) }}</td>
			<td>{{ $fefa->nfp }}</td>
			<td>{{ $fefa->cidade }}</td>
			<td>{{ $fefa->produtor }}</td>
			<td>{{ $fefa->propriedade }}</td>
			<td>{{ $fefa->qtd_macho }}</td>
			<td>{{ $fefa->qtd_femea }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
      			<p>Buscando Informações Aguarde ...</p>
      		</div>
    	</div>
    </div>
</div>



@endif

@section('scripts')
	<script type="text/javascript">
	function load(){
		$('#myModal').modal();
	}

	$(function () {
	 	$('#fefa').DataTable({
		 	"language": {
	            "lengthMenu": "Exibir _MENU_ registros por página",
	            "zeroRecords": "Nenhum registro retornado - desculpe-nos",
	            "info": "Mostrando pagina _PAGE_ de _PAGES_",
	            "infoEmpty": "Não existe registros",
	            "infoFiltered": "(filtered from _MAX_ total records)",
				"search":         "Buscar por: ",
		        "paginate": {
			        "first":      "Primeiro",
			        "last":       "Ultimo",
			        "next":       "Proximo",
			        "previous":   "Anterior"
			    },
	        },
		 });
	})
	</script>

@stop