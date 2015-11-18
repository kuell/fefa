$(document).ready(function() {
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });

  $('input[type=text]').bind('blur', (function(){
  	val = $(this).val().toUpperCase()
  	$(this).val(val)	
  })
  )

  $('.periodo').daterangepicker({
  	locale: {
      format: 'DD/MM/YYYY'
    }
  });
});