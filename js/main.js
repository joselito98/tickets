$(document).ready(function() {
    var iCnt = 0;

// Crear un elemento div añadiendo estilos CSS estas ahi?
    var container = $(document.createElement('div')).css({
        padding: '5px', margin: '20px', width: '170px', border: '1px dashed',
        borderTopColor: '#999', borderBottomColor: '#999',
        borderLeftColor: '#999', borderRightColor: '#999'
    });

    $('#btAdd').click(function() {
        if (iCnt <= 19) {

            iCnt = iCnt + 1;

            // Añadir caja de texto.
            $(container).append('<input type=text class="input" id=tb' + iCnt + ' ' +
                        'value="Elemento de Texto ' + iCnt + '" />');

            if (iCnt == 1) {   

var divSubmit = $(document.createElement('div'));
                $(divSubmit).append('<input type=button class="bt" onclick="GetTextValue()"' + 
                        'id=btSubmit value=Enviar />');

            }

$('#main').after(container, divSubmit); 
        }
        else {      //se establece un limite para añadir elementos, 20 es el limite
            
            $(container).append('<label>Limite Alcanzado</label>'); 
            $('#btAdd').attr('class', 'bt-disable'); 
            $('#btAdd').attr('disabled', 'disabled');

        }
    });

    $('#btRemove').click(function() {   // Elimina un elemento por click
        if (iCnt != 0) { $('#tb' + iCnt).remove(); iCnt = iCnt - 1; }
    
        if (iCnt == 0) { $(container).empty(); 
    
            $(container).remove(); 
            $('#btSubmit').remove(); 
            $('#btAdd').removeAttr('disabled'); 
            $('#btAdd').attr('class', 'bt') 

        }
    });

    $('#btRemoveAll').click(function() {    // Elimina todos los elementos del contenedor
    
        $(container).empty(); 
        $(container).remove(); 
        $('#btSubmit').remove(); iCnt = 0; 
        $('#btAdd').removeAttr('disabled'); 
        $('#btAdd').attr('class', 'bt');
});

// Obtiene los valores de los textbox al dar click en el boton "Enviar"
var divValue, values = '';

function GetTextValue() {

    $(divValue).empty(); 
    $(divValue).remove(); values = '';

    $('.input').each(function() {
        divValue = $(document.createElement('div')).css({
            padding:'5px', width:'200px'
        });
        values += this.value + '<br />'
    });

    $(divValue).append('<p><b>Tus valores añadidos</b></p>' + values);
    $('body').append(divValue);

}

       




           //validar form

           function validar(form) {
             form.sub.disabled = true;
             for (i=0; i<2; i++)
             if (frm['checkbox'+i].value =="") return
             form.sub.disabled = false;
         }

           //agregar autorizaciones
           var nextinput = 0;
           function AgregarCampos(){
           nextinput++;
            autorizacion  =  '<li id="rut'+nextinput+'">Autorizaciòn  <input type="text"  size="20" id="campo' + nextinput + '"&nbsp; name="campo' + nextinput + '"&nbsp; /></li> <p>';
            $("#campos").append(autorizacion);
            }
        
           //<!--aca caba temina la funcion para agregar los campos-->