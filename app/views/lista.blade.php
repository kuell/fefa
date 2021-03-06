@if(!empty($fefas))

<div class="table-responsive form form-horizontal">
    @foreach(Empresa::all() as $empresa)
        <div class="col-md-3">
        {{ $empresa->razao }}
            <dl class="dl-horizontal">
                <dt></dt>
                <dt>Qtde. Machos: <dd>  {{ number_format($empresa->fefas()->abertas()->sum('qtd_macho'), 0, ',', '.') }}   </dd></dt>
                <dt>Peso Machos: <dd>   {{ number_format($empresa->fefas()->abertas()->sum('peso_macho'), 2, ',', '.') }}  </dd></dt>
                <dt>Qtde. Femea: <dd>   {{ number_format($empresa->fefas()->abertas()->sum('qtd_femea'), 0, ',', '.') }}   </dd></dt>
                <dt>Peso Femea: <dd>    {{ number_format($empresa->fefas()->abertas()->sum('peso_femea'), 2, ',', '.') }}  </dd></dt>
            </dl>
        </div>
        <!-- /.col-md-3 -->
    @endforeach

        <div class="col-md-3">
            Total
            <dl class="dl-horizontal">
                <dt></dt>
                <dt>Qtde. Machos: <dd>  {{ number_format(Fefa::abertas()->sum('qtd_macho'), 0, ',', '.') }}   </dd></dt>
                <dt>Peso Machos: <dd>   {{ number_format(Fefa::abertas()->sum('peso_macho'), 2, ',', '.') }}  </dd></dt>
                <dt>Qtde. Femea: <dd>   {{ number_format(Fefa::abertas()->sum('qtd_femea'), 0, ',', '.') }}   </dd></dt>
                <dt>Peso Femea: <dd>    {{ number_format(Fefa::abertas()->sum('peso_femea'), 2, ',', '.') }}  </dd></dt>
            </dl>
        </div>
</div>

<div class="col-md-12">
    {{ Form::open(['route'=>'fefa.create','method'=>'get' ,'class'=>'navbar-form navbar-right', 'onSubmit'=>'load()']) }}
    <div class="form-group has-warning">
        <input type="text" class="form-control" placeholder="Digite o Numero da Nota" autofocus size="30" name="nfe">
    </div>
    {{ Form::close() }}
</div>
<!-- /.col-md-12 -->

<hr />
<div class="form-group">
	<table class="table table-hover table-responsive" id="fefa">
		<thead>
			<tr>
				<th>NFE</th>
				<th>Data Compra</th>
				<th>NFP</th>
				<th>Cidade</th>
				<th>Produtor</th>
				<th>Propriedade</th>
				<th>Qtd Macho</th>
				<th>Peso Macho</th>
				<th>Qtd Femeas</th>
				<th>Peso Femeas</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($fefas as $fefa)
			<tr>
				<td>{{ $fefa->nfe }}</td>
				<td>{{ Format::dateView($fefa->data_compra) }}</td>
				<td>{{ $fefa->nfp }}</td>
				<td>{{ $fefa->cidade }}</td>
				<td>{{ $fefa->produtor }}</td>
				<td>{{ $fefa->propriedade }}</td>
				<td>{{ $fefa->qtd_macho }}</td>
				<td>{{ $fefa->peso_macho }}</td>
				<td>{{ $fefa->qtd_femea }}</td>
				<td>{{ $fefa->peso_femea }}</td>
				<td>
					{{ Form::open(['route'=>['fefa.destroy', $fefa->id], 'method'=>'DELETE']) }}
						{{ Form::submit('delete', ['class'=>'btn btn-sm btn-danger']) }}
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
      			<p>Buscando Informações Aguarde ...</p>
      		</div>
    	</div>
    </div>
</div>


<style type="text/css">
	.table{
		font-size: 10px;
	}
</style>


@endif

@section('scripts')
	<script type="text/javascript">
	function load(){
		$('#myModal').modal();
	}

	$(function () {

		$('#create').bind('click', function() {
			location = '/fefa/create?avulsa=sim'
		});

	 	$('#fefa').DataTable({
	 		columnDefs: [ {
	            targets: [ 0 ],
	            orderData: [ 0, 2 ]
	        }, {
	            targets: [ 1 ],
	            orderData: [ 2, 0 ]
	        }, {
	            targets: [ 4 ],
	            orderData: [ 4, 0 ]
	        } ],
		 	paging: false,
		 	"language": {
	            "lengthMenu": "Exibir _MENU_ registros por página",
	            "zeroRecords": "Nenhum registro retornado",
	            "info": "Mostrando pagina _PAGE_ de _PAGES_",
	            "infoEmpty": "Não existem registros",
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