$(document).ready(function() {
  $('#btnDel').attr('disabled','disabled');
  $('#btnAdd').click(function() {
    var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
    var newNum = new Number(num + 1); // the numeric ID of the new input field being added
 
    // create the new element via clone(), and manipulate it's ID using newNum value
    var newElem = $('#input' + num).clone().attr('id', 'Add' + newNum);
 
    // manipulate the name/id values of the input inside the new element
    newElem.children(':last').attr('id', 'name' + newNum).attr('name', 'name' + newNum);
 
    // insert the new element after the last "duplicatable" input field
    $('#input' + num).after(newElem);
 
    // enable the "remove" button
    $('#btnDel').attr('disabled',false);
 
    // business rule: you can only add 10 names
    if (newNum == 10)
      $('#btnAdd').attr('disabled','disabled');
  });
 
  $('#btnDel').click(function() {
    var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
    $('#input' + num).remove(); // remove the last element
 
    // enable the "add" button
    $('#btnAdd').attr('disabled',false);
 
    // if only one element remains, disable the "remove" button
    if (num-1 == 1)
      $('#btnDel').attr('disabled','disabled');
  });
 
});
$(document).ready(function() {
        var iCnt = 0;

// Crear un elemento div añadiendo estilos CSS
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

    $(document).ready(function(){
     $('input[type="submit"]').attr('disabled','disabled');
     $('input[type="text"]').keypress(function(){
            if($(this).val() != ''){
               $('input[type="submit"]').removeAttr('disabled');
            }
     });
 });