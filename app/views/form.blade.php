@extends('index')

@section('main')

@if(!count($nota->fefa))
	{{ Form::model($nota, ['class'=>'form form-horizontal', 'route'=>['fefa.store']]) }}
@else
	{{ Form::model($nota, ['class'=>'form form-horizontal', 'route'=>['fefa.update',$nota->fefa->id]]) }}
@endif
		<div class="form-group">
			<div class="col-md-12">
				{{ Form::label('chave', 'Chave de Acesso: ' , ['class'=>'form-label']) }}
				{{ Form::text('chave', null, ['class'=>'form-control', 'readonly']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				{{ Form::label('data_compra', 'Data Compra: ' , ['class'=>'form-label']) }}
				{{ Form::text('data_compra', null, ['class'=>'form-control', 'readonly']) }}
			</div>
			<div class="col-md-2">
				{{ Form::label('nfe', 'Nota Fiscal: ' , ['class'=>'form-label']) }}
				{{ Form::text('nfe', null, ['class'=>'form-control', 'readonly']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('nfp', 'Nota Produtor: ' , ['class'=>'form-label']) }}
				{{ Form::text('nfp', null, ['class'=>'form-control', 'readonly']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('cidade', 'Municipio: ' , ['class'=>'form-label']) }}
				{{ Form::text('cidade', null, ['class'=>'form-control', 'readonly']) }}
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
				{{ Form::text('qtd_macho', null, ['class'=>'form-control', 'readonly']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('peso_macho', 'Peso Macho: ' , ['class'=>'form-label']) }}
				{{ Form::text('peso_macho', null, ['class'=>'form-control', 'readonly']) }}
			</div>

			<div class="col-md-3">
				{{ Form::label('qtd_femea', 'Qtd Femea: ' , ['class'=>'form-label']) }}
				{{ Form::text('qtd_femea', null, ['class'=>'form-control', 'readonly']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('peso_femea', 'Peso Femea: ' , ['class'=>'form-label']) }}
				{{ Form::text('peso_femea', null, ['class'=>'form-control', 'readonly']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				{{ Form::label('gta', 'Numero da GTA: ' , ['class'=>'form-label']) }}
				{{ Form::text('gta', null, ['class'=>'form-control', 'autofocus']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('gta_serie', 'Serie da GTA: ' , ['class'=>'form-label']) }}
				{{ Form::text('gta_serie', null, ['class'=>'form-control']) }}
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
	document.getElementsByName('gta').focus()

</script>

@stop