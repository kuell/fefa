<!DOCTYPE html>
<html>
<head>
	<title>::: Movimentação do Fefa :::</title>

	{{ HTML::style('assets/css/bootstrap.min.css') }}
    

    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    {{ HTML::style('assets/css/styles.css') }}
    <!-- script references -->

    {{ HTML::script('assets/js/jquery.min.js') }}
    {{ HTML::script('assets/js/bootstrap.min.js') }}
    

    {{ HTML::style('assets/js/plugins/datatables-1.10.12/datatables.net-bs/css/dataTables.bootstrap.min.css') }}
	{{ HTML::style('assets/js/plugins/datatables-1.10.12/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}
	{{ HTML::style('assets/js/plugins/datatables-1.10.12/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}
	{{ HTML::style('assets/js/plugins/datatables-1.10.12/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}
	{{ HTML::style('assets/js/plugins/datatables-1.10.12/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}	

	{{-- Datatables --}}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/datatables.net/js/jquery.dataTables.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/datatables.net-bs/js/dataTables.bootstrap.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/datatables.net-buttons/js/dataTables.buttons.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/datatables.net-buttons/js/buttons.flash.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/datatables.net-buttons/js/buttons.html5.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/datatables.net-buttons/js/buttons.print.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/datatables.net-keytable/js/dataTables.keyTable.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/datatables.net-responsive/js/dataTables.responsive.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/datatables.net-scroller/js/dataTables.scroller.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/jszip/dist/jszip.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/pdfmake/build/pdfmake.min.js') }}
	{{ HTML::script('assets/js/plugins/datatables-1.10.12/pdfmake/build/vfs_fonts.js') }}
    
    <script type="text/javascript">
    	$(function(){
    		$('.table-dynamic').DataTable({
		        "paging": false,
		        
		        dom: "Bfrtip",
		        buttons: [
		            {
		                extend: "excel",
		                className: "btn-sm",
		                text: 'Exportar para Excel',
		            }
		        ],
		        responsive: true
		    });
    	})
    </script>

</head>
<body>

<table class="table table-hover table-dynamic">
	<thead>
		<tr>
			<th>DATA COMPRA</th>
			<th>GTA</th>
			<th>NFP</th>
			<th>MUNICÍPIO</th>
			<th>PRODUTOR</th>
			<th>PROPRIEDADE</th>
			<th>MACHO</th>
			<th>FEMEA</th>
			<th>TOTAL</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($fefas as $fefa) 
			<tr>
				<td>{{ Format::dateView($fefa->data_compra) }}</td>
				<td>{{ $fefa->gta }}</td>
				<td>{{ $fefa->nfp }}</td>
				<td>{{ $fefa->cidade }}</td>
				<td>{{ $fefa->produtor }}</td>
				<td>{{ $fefa->propriedade }}</td>
				<td>{{ $fefa->qtd_macho }}</td>
				<td>{{ $fefa->qtd_femea }}</td>
				<td>{{ $fefa->qtd_macho + $fefa->qtd_femea }}</td>
			</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>