@extends('index')

@section('main')

	{{ Form::model($nota, ['class'=>'form form-horizontal', 'route'=>['fefa.store']]) }}

		<div class="form-group">
            <div class="col-md-6">
                {{ Form::label('empresa_id', 'Empresa: ', ['class'=>'form-label']) }}
                {{ Form::text('empresa', $empresa->razao, ['class'=>'form-control', 'disabled']) }}
                {{ Form::hidden('empresa_id', $empresa->id) }}
            </div>
            <div class="col-md-6">
				{{ Form::label('chave', 'Chave de Acesso: ' , ['class'=>'form-label']) }}
				{{ Form::text('chave', $nota->chave, ['class'=>'form-control', 'readonly']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				{{ Form::label('data_compra', 'Data Compra: ' , ['class'=>'form-label']) }}
				{{ Form::text('data_compra', date('d/m/Y', strtotime($nota->data_compra)), ['class'=>'form-control data', 'readonly'=>false]) }}
			</div>
			<div class="col-md-2">
				{{ Form::label('nfe', 'Nota Fiscal: ' , ['class'=>'form-label']) }}
				{{ Form::text('nfe', $nota->numero_nfe, ['class'=>'form-control numero', 'readonly']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('nfp', 'Nota Produtor: ' , ['class'=>'form-label']) }}
				{{ Form::text('nfp', $nota->nfp, ['class'=>'form-control', 'readonly']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('cidade', 'Municipio: ' , ['class'=>'form-label']) }}
                {{ Form::text('cidade', utf8_encode($nota->cidade), ['class'=>'form-control', 'readonly']) }}

			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				{{ Form::label('produtor', 'Produtor: ' , ['class'=>'form-label']) }}
				{{ Form::text('produtor', utf8_encode($nota->produtor), ['class'=>'form-control', 'readonly']) }}
			</div>
			<div class="col-md-6">
				{{ Form::label('propriedade', 'Propriedade: ' , ['class'=>'form-label']) }}
				{{ Form::text('propriedade', $nota->fazenda, ['class'=>'form-control', 'readonly']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-3">
				{{ Form::label('qtd_macho', 'Qtd Macho: ' , ['class'=>'form-label']) }}
				{{ Form::text('qtd_macho', number_format($nota->qtd_macho, 0, ',', '.'), ['class'=>'form-control int']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('peso_macho', 'Peso Macho: ' , ['class'=>'form-label']) }}
				{{ Form::text('peso_macho', number_format($nota->peso_macho, 2, ',', '.'), ['class'=>'form-control double']) }}
			</div>

			<div class="col-md-3">
				{{ Form::label('qtd_femea', 'Qtd Femea: ' , ['class'=>'form-label']) }}
				{{ Form::text('qtd_femea', number_format($nota->qtd_femea, 0, ',', '.'), ['class'=>'form-control int']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('peso_femea', 'Peso Femea: ' , ['class'=>'form-label']) }}
				{{ Form::text('peso_femea', number_format($nota->peso_femea, 2, ',', '.'), ['class'=>'form-control double']) }}
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

@stop