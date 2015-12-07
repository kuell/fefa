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

  $('.data').mask('00/00/0000');
  $('.double').mask('000.000.000.000.000,00',{reverse:true});
  $('.int').mask('000.000.000.000.000',{reverse:true});

  $(document).keyup(function handleEnter(e, func) {
      if(e.keyCode == 27){
        location = '/';
      }
  });

});