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
				{{ Form::select('cidade', [''=>'Todos']+Fefa::all()->lists('cidade','cidade'), null, ['class'=>'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-12">
				{{ Form::button('SIF', ['class'=>'btn btn-info','name'=>'sif']) }}
				{{ Form::button('FEFA', ['class'=>'btn btn-success']) }}

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
	})
	</script>
@stop