<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>::: Movimentações do Fefa ::: </title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    {{ HTML::style('assets/css/bootstrap.min.css') }}
    {{ HTML::style('assets/js/plugins/daterangepicker.css') }}
    {{ HTML::style('assets/js/plugins/jquery.dataTables.min.css') }}

    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    {{ HTML::style('assets/css/styles.css') }}
    <!-- script references -->

    {{ HTML::script('assets/js/jquery.min.js') }}
    {{ HTML::script('assets/js/bootstrap.min.js') }}
    {{ HTML::script('assets/js/jquery-ui.js') }}

    {{ HTML::script('assets/js/plugins/moment.min.js') }}
    {{ HTML::script('assets/js/plugins/daterangepicker.js') }}
    {{ HTML::script('assets/js/plugins/jquery.dataTables.js') }}
    {{ HTML::script('assets/js/plugins/jquery.mask.min.js') }}
    {{ HTML::script('assets/js/plugins/jquery.autocomplete.min.js') }}

    {{ HTML::script('assets/js/scripts.js') }}

  </head>
  <body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Frizelo - Fefa</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/fefa/relatorios">Relatorios</a></li>
            <li><a href="#" id="finalizar">Finalizar Fefa</a></li>
          </ul>
        </div>
      </div>
</nav>

<div class="container-fluid">

      <div class="row row-offcanvas row-offcanvas-left">

        <div class="col-sm-12 col-md-12 main">

          <!--toggle sidebar button-->
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">
              <i class="glyphicon glyphicon-chevron-left"></i>
            </button>
          </p>

          <h2 class="sub-header">Movimentações Fefa</h2>

          @if (Session::has('message'))
    @if(!$errors->all())
<?php
$tipo = 'success';
?>
@else
<?php
$tipo = 'warning';
?>
    @endif
      <div class="alert alert-{{ $tipo }} fade in">
        <button type="button" class="btn close" data-dismiss="alert" aria-hidden="true">
          ×
        </button>
        <strong>
          {{ Session::get('message') }}
        </strong>
        @if ($errors->any())
          <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
          </ul>
        @endif
      </div>
    @endif
    <!-- END CONTENT -->

          <hr>
            @yield('main')
            @include('lista')

      </div><!--/row-->
  </div>
</div><!--/.container-->

<footer>

</footer>

    @yield('scripts')

    <script type="text/javascript">
      $(function () {
        $('#finalizar').bind('click', function() {
          open('/fefa/finalizar', 'Finalizar', 'channelmode=yes')
        });
      })
    </script>
  </body>
</html>