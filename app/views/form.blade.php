@extends('index')

@section('main')


@if(empty($nota->id))
	{{ Form::model($nota, ['class'=>'form form-horizontal', 'route'=>['fefa.store']]) }}
@else
	{{ Form::model($nota, ['class'=>'form form-horizontal', 'route'=>['fefa.update',$nota->id], 'method'=>'PATCH']) }}
@endif
		<div class="form-group">
			<div class="col-md-10">
				{{ Form::label('chave', 'Chave de Acesso: ' , ['class'=>'form-label']) }}
				{{ Form::text('chave', null, ['class'=>'form-control', 'readonly']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				{{ Form::label('data_compra', 'Data Compra: ' , ['class'=>'form-label']) }}
				{{ Form::text('data_compra', null, ['class'=>'form-control data', 'readonly'=>false]) }}
			</div>
			<div class="col-md-2">
				{{ Form::label('nfe', 'Nota Fiscal: ' , ['class'=>'form-label']) }}
				{{ Form::text('nfe', null, ['class'=>'form-control numero', 'readonly']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('nfp', 'Nota Produtor: ' , ['class'=>'form-label']) }}
				{{ Form::text('nfp', null, ['class'=>'form-control', 'readonly']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('cidade', 'Municipio: ' , ['class'=>'form-label']) }}
				@if(!empty($nota->chave))
					{{ Form::text('cidade', null, ['class'=>'form-control', 'readonly']) }}
				@else

					{{ Form::select('cidade', ['Selecione ...']+Municipio::municipios(), null, ['class'=>'form-control']) }}
				@endif

			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				{{ Form::label('produtor', 'Produtor: ' , ['class'=>'form-label']) }}
				{{ Form::text('produtor', null, ['class'=>'form-control', 'readonly']) }}
			</div>
			<div class="col-md-6">
				{{ Form::label('propriedade', 'Propriedade: ' , ['class'=>'form-label']) }}
				{{ Form::text('propriedade', null, ['class'=>'form-control', 'readonly']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				{{ Form::label('qtd_macho', 'Qtd Macho: ' , ['class'=>'form-label']) }}
				{{ Form::text('qtd_macho', null, ['class'=>'form-control int']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('peso_macho', 'Peso Macho: ' , ['class'=>'form-label']) }}
				{{ Form::text('peso_macho', null, ['class'=>'form-control double']) }}
			</div>

			<div class="col-md-3">
				{{ Form::label('qtd_femea', 'Qtd Femea: ' , ['class'=>'form-label']) }}
				{{ Form::text('qtd_femea', null, ['class'=>'form-control int']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('peso_femea', 'Peso Femea: ' , ['class'=>'form-label']) }}
				{{ Form::text('peso_femea', null, ['class'=>'form-control double']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				{{ Form::label('gta', 'Numero da GTA: ' , ['class'=>'form-label']) }}
				{{ Form::text('gta', null, ['class'=>'form-control', 'autofocus', 'id'=>'gta']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('gta_serie', 'Serie da GTA: ' , ['class'=>'form-label']) }}
				{{ Form::text('gta_serie', 'J', ['class'=>'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-12">
				{{ Form::submit('Gravar', ['class'=>'btn btn-success']) }}
				{{ link_to_route('fefa.index', 'Voltar', null, ['class'=>'btn btn-danger']) }}
			</div>
		</div>

	{{ Form::close() }}

<script type="text/javascript">
	document.getElementById('gta').focus();
</script>
@if(empty($nota->chave))
	<script type="text/javascript">
		$(function(){
			$('input[name=peso_femea], input[name=peso_macho], input[name=qtd_femea], input[name=qtd_macho], input[name=nfe], input[name=nfp], input[name=data_compra], input[name=municipio], input[name=propriedade], input[name=produtor], input[name=cidade] ').removeAttr('readonly')
		});

	</script>
@endif
@stop