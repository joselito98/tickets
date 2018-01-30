$(function()
{  
	var MyApp = {

		required : ".required",

		
		validaFormulario : function(form)
		{
			var frm = $(form).find(this.required), status = false;

			for(i = 0; i < frm.length; i++)
			{
				inputs = $(frm[i]);

				if(inputs.val() == "")
				{
					inputs.focus().val('');
					this.mostrarMensaje('Error', 'Campos requeridos', 'error');
					status = false;
					break;
				}
				else if(inputs.attr('type') === 'checkbox')
				{
					if(!inputs.is(':checked'))
					{
						this.mostrarMensaje('Error', 'Campo '+ this.showPlaceholder(inputs) +' requerido', 'error');
						status = false;
						break;
					}
				}
				else if ($.trim(inputs.val()) == "")
				{
					inputs.focus().val('');
					this.mostrarMensaje('Error', 'Campos requeridos', 'error');
					status = false;
					break;
				}
				else
					status = true;
			}

			return status;
		},

		showPlaceholder : function(element)
		{
			if(element.attr('placeholder') == undefined)
				return '';
			else
				return element.attr('placeholder');
		},
	
		procesaFormulario : function(form, btn, file, modal, id)
		{
			$(btn).click(function(){

				if(!MyApp.validaFormulario(form))
					return false;
				else
				{
					if(modal)
					{
						MyApp.procesaModal(id, form, btn, file);
					}
					else
						MyApp.enviaDatos(form, btn, file);
				}
			});
		},

		procesaModal : function(id, form, btn, file)
		{
			$(id).modal('show');

			$(btn).click(function(){

				if(!MyApp.validaFormulario(form))
					return false;
				else
				{
					sendAllData(form, btn, file);
				}
			})
		},

		sendAllData : function(form, btn, file)
		{
			if(!this.validaFormulario(form))
				return false;
			else
				MyApp.enviaDatos(form, btn, file);
		},
	
		enviaDatos : function(form, btn, file)
		{
			var datosFormulario = $(form).serialize(), bussy = false;

			if(bussy)
			{
				bussy = true;
				return;
			}
			else
			{
				$.ajax(
				{
					url 	: 'ajax/' + file + '.php',
					type	: 'POST',
					cache	: true,
					beforeSend	: function()
					{
						$(btn).attr('disabled', true);
					},
					success	: function(response)
					{
						MyApp.controlaRespuesta(response);
					},
					complete : function()
					{
						$(btn).attr('disabled', false);
					}
				});
			}
		},

		controlaRespuesta : function(response)
		{
			
		},

		mostrarMensaje : function(t, msg, s)
		{
			return new PNotify({ title : t, text : msg, type : s });
		}
	};

	PNotify.removeAll();

	MyApp.procesaFormulario("#frm-crea-tutela", "#btn-guarda-tutela", "crea_tutela", true, "#MyModal");


}); 