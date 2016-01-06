@extends('index')

@section('main')
	<div class="form form-horizontal">
		<div class="form-group">
			<div class="col-md-4">
				{{ Form::label('fechamento', 'Referencia de Mês: ' , ['class'=>'form-label']) }}
				{{ Form::text('fechamento', null, ['class'=>'form-control mes']) }}
			</div>
			<div class="col-md-8"></div>
		</div>

		<div class="form-group">
			{{ Form::button('Fechar', ['class'=>'btn btn-info','name'=>'fechar']) }}
		</div>
	</div>

	<div class="col-md-12">
		<div class="table-responsive form form-horizontal">
			<dl class="dl-horizontal">
			  	<dt>Qtde. Machos: <dd>{{ number_format(Fefa::total('qtd_macho'), 0, ',', '.') }}</dd></dt>
				<dt>Peso Machos: <dd>{{ number_format(Fefa::total('peso_macho'), 2, ',', '.') }}</dd></dt>
				<dt>Qtde. Femea: <dd>{{ number_format(Fefa::total('qtd_femea'), 0, ',', '.') }}</dd></dt>
				<dt>Peso Femea: <dd>{{ number_format(Fefa::total('peso_femea'), 2, ',', '.') }}</dd></dt>
			</dl>
		</div>
	</div>

	<div>	
		<table class="table table-hover" id="fefa">
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
			</tr>
		</thead>
		<tbody>
			@foreach(Fefa::abertas()->get() as $fefa)
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
			</tr>
			@endforeach
		</tbody>
	</table>

	</div>	

<style type="text/css">
	.table{
		font-size: 9px;
	}
</style>

<script type="text/javascript">
	$(function(){
		$('button[name=fechar]').bind('click', function(){
			$.post('/fefa/finalizar', {fechamento: $('input[name=fechamento]').val()}, function(data) {
				alert(data);
				window.opener.location.reload()
				window.self.close();
			});
		})
		$('input[name=fechamento]').mask('99/2099');
	})
</script>

@stop
