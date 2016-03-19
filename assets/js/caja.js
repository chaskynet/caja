function number_format(number, decimals, dec_point, thousands_sep) {
  //  discuss at: http://phpjs.org/functions/number_format/
  // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: davook
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Theriault
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Michael White (http://getsprink.com)
  // bugfixed by: Benjamin Lupton
  // bugfixed by: Allan Jensen (http://www.winternet.no)
  // bugfixed by: Howard Yeend
  // bugfixed by: Diogo Resende
  // bugfixed by: Rival
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  //  revised by: Luke Smith (http://lucassmith.name)
  //    input by: Kheang Hok Chin (http://www.distantia.ca/)
  //    input by: Jay Klehr
  //    input by: Amir Habibi (http://www.residence-mixte.com/)
  //    input by: Amirouche
  //   example 1: number_format(1234.56);
  //   returns 1: '1,235'
  //   example 2: number_format(1234.56, 2, ',', ' ');
  //   returns 2: '1 234,56'
  //   example 3: number_format(1234.5678, 2, '.', '');
  //   returns 3: '1234.57'
  //   example 4: number_format(67, 2, ',', '.');
  //   returns 4: '67,00'
  //   example 5: number_format(1000);
  //   returns 5: '1,000'
  //   example 6: number_format(67.311, 2);
  //   returns 6: '67.31'
  //   example 7: number_format(1000.55, 1);
  //   returns 7: '1,000.6'
  //   example 8: number_format(67000, 5, ',', '.');
  //   returns 8: '67.000,00000'
  //   example 9: number_format(0.9, 0);
  //   returns 9: '1'
  //  example 10: number_format('1.20', 2);
  //  returns 10: '1.20'
  //  example 11: number_format('1.20', 4);
  //  returns 11: '1.2000'
  //  example 12: number_format('1.2000', 3);
  //  returns 12: '1.200'
  //  example 13: number_format('1 000,50', 2, '.', ' ');
  //  returns 13: '100 050.00'
  //  example 14: number_format(1e-8, 8, '.', '');
  //  returns 14: '0.00000001'

  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

/**
*
*/
$('#home').on('click', function(){
  $('#contenido').empty(); //load('cuerpo');
});

/***********************************************************/
/**
* 
* Desc: Seccion de gestion de usuarios
*/

// ******* Creacion de Usuarios
$('#creacion-usuarios').on('click', function(){
  $('#contenido').load('creacion_usuarios');
});

$(document).on('hide.bs.modal','#modal_creacion_usuarios', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('creacion_usuarios');
    // if(!confirm('You want to close me?'))
    //  e.preventDefault();
});

$(document).on('hide.bs.modal','#modal_edita_usuario', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('creacion_usuarios');
});

$(document).on('click', '#crear_usuario', function(e){
  e.preventDefault();
  var usuario = new Array();
  var datos_usuario = new Array();
  var lista_permisos = new Array();

  var crear_usuario = new Object();
  var permisos_usuario = new Object()
  crear_usuario.uname = $('#usuario').val();
  crear_usuario.nombre = $('#nombre').val();
  crear_usuario.apaterno = $('#apaterno').val();
  crear_usuario.amaterno = $('#amaterno').val();
  crear_usuario.ci = $('#ci').val();
  crear_usuario.password = $('#password').val();
  //crear_usuario.rol = $("input[name=rol]:checked").val();

  $( "input[type=checkbox]:checked").each(function(){ 
    console.log($(this).attr('id'));
    permisos_usuario = $(this).attr('id');
    lista_permisos.push(permisos_usuario);
  });

  datos_usuario.push(crear_usuario);
  
  usuario.push(datos_usuario);
  usuario.push(lista_permisos);

  var new_usuario = JSON.stringify(usuario);
  console.log(new_usuario);

  $.ajax({
        url: 'nuevo_usuario',
        data: {data: new_usuario},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          alert('Usuario creado correctamente!');
          $('#usuario').val('');
          $('#nombre').val('');
          $('#apaterno').val('');
          $('#amaterno').val('');
          $('#ci').val('');
          $('#password').val('');
          // $("input[name=rol]:checked").val('');
        }
  });
});

$(document).on('hide.bs.modal','#modal_creacion_usuarios', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('#contenido').load('creacion_usuarios');
});

$(document).on('click', '#nombre_usuario', function(e){
  e.preventDefault();
  var objFila=$(this).parents().get(1);
  var id_usuario = $(objFila).attr('id');
  $.ajax({
    url: 'carga_datos_usuario',
        data: {data: id_usuario},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          var objeto = JSON.parse(response);
           
          $.each(objeto.datos_usuario, function(i, item) {
            $('#id_usuario').val(id_usuario);
            $('#ed_usuario').val(item.uname);
            $('#ed_nombre').val(item.nombre);
            $('#ed_apaterno').val(item.apaterno);
            $('#ed_amaterno').val(item.amaterno);
            $('#ed_ci').val(item.ci);
            $('#ed_password').val(item.password);
            $("input[name=ed_rol]:checked").val(item.rol);
          });
          $.each(objeto.permisos, function(i, item){
            // $.each(i.datos_usuario, function(j, item2){
            //   console.log(j+'--'+item2);
            // });
            if (item == 'chk_inv_ini') {
              //console.log(i+'--'+item);
              $('#chk_inv_ini').prop('checked', true);
            }else if (item == 'chk_exist'){
              $('#chk_exist').prop('checked', true);
            }else if (item == 'chk_nota_ingre'){
              $('#chk_nota_ingre').prop('checked', true);
            }else if (item == 'chk_nota_salida'){
              $('#chk_nota_salida').prop('checked', true);
            }else if (item == 'chk_edit_nota'){
              $('#chk_edit_nota').prop('checked', true);
            }else if (item == 'chk_lst_conteo'){
              $('#chk_lst_conteo').prop('checked', true);
            }else if (item == 'chk_mov_inventa'){
              $('#chk_mov_inventa').prop('checked', true);
            }else if (item == 'chk_modifica'){
              $('#chk_modifica').prop('checked', true);
            }else if (item == 'chk_config'){
              $('#chk_config').prop('checked', true);
            }else if (item == 'chk_crea_art'){
              $('#chk_crea_art').prop('checked', true);
            } else if (item == 'chk_importa_art'){
              $('#chk_importa_art').prop('checked', true);
            } else if (item == 'chk_borra_art'){
              $('#chk_borra_art').prop('checked', true);
            } 
            
          }); 
        }
  });
  $('#modal_content_usuario').html();
})

$(document).on('click', '#chk_password', function(){
  $('#ed_password').prop('disabled', false);
});

$(document).on('click', '#actualizar_usuario', function(){
  var usuario = new Array();
  var datos_usuario = new Array();
  var lista_permisos = new Array();

  var usuario_actualizado = new Object();
  var permisos_usuario = new Object();

  usuario_actualizado.id_usuario = $('#id_usuario').val();
  usuario_actualizado.uname = $('#ed_usuario').val();
  usuario_actualizado.nombre = $('#ed_nombre').val();
  usuario_actualizado.apaterno = $('#ed_apaterno').val();
  usuario_actualizado.amaterno = $('#ed_amaterno').val();
  usuario_actualizado.ci = $('#ed_ci').val();
  if ($('#chk_password').prop('checked')) {
    usuario_actualizado.password = $('#ed_password').val();
  }

  $( "input[type=checkbox]:checked").each(function(){ 
    //console.log($(this).attr('id'));
    permisos_usuario = $(this).attr('id');
    lista_permisos.push(permisos_usuario);
  });

  datos_usuario.push(usuario_actualizado);
  
  usuario.push(datos_usuario);
  usuario.push(lista_permisos);

  var update_usuario = JSON.stringify(usuario);

  $.ajax({
        url: 'actualizar_usuario',
        data: {data: update_usuario},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          alert('Usuario Actualizado correctamente!');
          $('#ed_usuario').val('');
          $('#ed_nombre').val('');
          $('#ed_apaterno').val('');
          $('#ed_amaterno').val('');
          $('#ed_ci').val('');
          $('#ed_password').val('');
        }
      });
});

$(document).on('click', '#elimina_usr', function(){
  var objFila=$(this).parents().get(1);
  var id_usuario = $(objFila).attr('id');
  $.ajax({
        url: 'elimina_usuario',
        data: {data: id_usuario},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Borrar!');
        },
        success: function(response)
        {
          alert('Usuario Borrado correctamente!');
          $('#contenido').load('creacion_usuarios');
        }
      });
});

/***********************************************************/
/**
* 
* Desc: Seccion de gestion de Movimiento de Caja
*/

/*---- APERTURA DE CAJA -----*/
$(document).on('click','#abrir_caja', function(){
    var fecha = $('#fecha').val();
    var saldo_ini = $('#saldo_inicial').val();
    var apertura = new Object();
    $('#fecha_ini').val(fecha);
    $('#saldo_ini').text(saldo_ini);
    $('#estado_caja').text('Abierto');
    apertura.fecha = fecha;
    apertura.saldo_ini = saldo_ini;
    var new_apertura = JSON.stringify(apertura);
    $.ajax({
        url: 'apertura_caja',
        data: {data: new_apertura},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          console.log(response);
        }
    });
});

/*---- MOVIMIENTO DE CAJA -----*/
$('#movimientos_caja').on('click', function(){
  $('#contenido').load('abre_movimientos_caja');
});


$(document).on('click', '#usd', function(){
  $('#tcambio').toggleClass('ocultar');
});

$(document).on('click','#reg_mov', function(){
  var movimiento = new Object();
  movimiento.tipo_operacion = $('#tipo_operacion').val();
  movimiento.comprobante = $('#comprobante').val();
  movimiento.num_comprobante = $('#num_comprobante').val();
  movimiento.monto = $('#monto').val();
  movimiento.moneda = $("input[name='moneda']:checked").val();
  movimiento.tipo_cambio = $('#tipo_cambio').val();
  movimiento.descripcion = $('#descripcion').val();

  var new_movimiento = JSON.stringify(movimiento);
  console.log(new_movimiento);
  $.ajax({
        url: 'registra_movimientos_caja',
        data: {data: new_movimiento},
        type: "POST",
        dataType: "html",
        error: function()
        {
            alert('Error al Guardar!');
        },
        success: function(response)
        {
          console.log(response);
        }
      });
});
$(document).on('hide.bs.modal','#modal_nuevo_movimiento', function(e){
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    var fecha = $('#fecha').val();
    $('#contenido').load('abre_movimientos_caja', fecha, function(data){ console.log('-->'+data+'<----');});
});
