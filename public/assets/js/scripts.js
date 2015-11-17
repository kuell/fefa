$(document).ready(function() {
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });

  $('.periodo').daterangepicker({
  	locale: {
      format: 'DD/MM/YYYY'
    }
  });
});