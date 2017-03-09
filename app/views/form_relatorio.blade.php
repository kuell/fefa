@extends('index')

@section('main')
	{{ Form::open(['class'=>'form form-horizontal']) }}
		<div class="form-group">
			<div class="col-md-4">
				{{ Form::label('periodo', 'Periodo: ' , ['class'=>'form-label']) }}
				{{ Form::text('periodo', null, ['class'=>'form-control periodo']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('cidade', 'Municipio: ' , ['class'=>'form-label']) }}
				{{ Form::select('cidade', [''=>'Todos']+Fefa::orderBy('cidade')->lists('cidade','cidade'), null, ['class'=>'form-control']) }}
			</div>

            <div class="col-md-3">
                {{ Form::label('empresa_id', 'Empresa: ' , ['class'=>'form-label']) }}
                {{ Form::select('empresa_id', ['0'=>'Todos']+Empresa::lists('razao', 'id'), null, ['class'=>'form-control']) }}
            </div>

		</div>

		<div class="form-group">
			<div class="col-md-12">
				{{ Form::button('SIF', ['class'=>'btn btn-info','name'=>'sif']) }}
				{{ Form::button('FEFA', ['class'=>'btn btn-success', 'name'=>'fefa']) }}
				{{ link_to_route('fefa.index', 'Voltar', null, ['class'=>'btn btn-danger']) }}
			</div>
		</div>

	{{ Form::close() }}

@stop

@section('scripts')
	<script type="text/javascript">
	$(function(){
		$('button[name=sif]').click(function() {
			open('/fefa/relatorio/sif?periodo='+$('input[name=periodo]').val()+'&cidade='+$('select[name=cidade]').val(), 'Print','channelmode=yes')
		});
		$('button[name=fefa]').click(function() {
			open('/fefa/relatorio/fefa/'+$('select[name=empresa_id]').val()+'?periodo='+$('input[name=periodo]').val(), 'Print','channelmode=yes')
		});
	})
	</script>
@stop