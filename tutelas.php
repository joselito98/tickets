  <!DOCTYPE html>
  <html lang="en">
  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <?php
  $title ="Tutelas | ";
  include "head.php";
  include "sidebar.php"; 
  ?>

  <div class="right_col" role="main"> 
    <div class="">
      <div class="page-title">
        <div class="clearfix"></div>
        <div class="col-md-12 col-sm-12 col-xs-12">

         <div class="x_panel">
           <div class="x_title">
             <h2>Radicaciòn de Tutelas</h2>
             <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>


          <!--ACA INICIA EL FORMULARIO-->
          <form id="frm-crea-tutela" class="form-horizontal" action="javascript:" method="post">
            <div class="row">          
              <div class="col-lg-4">
                <input type="checkbox" class="required" placeholder="Documento de Identidad" />
                <label>Documento de Identidad</label>
              </div>
              <div class="col-lg-4">
                <input type="checkbox" class="required" placeholder="Formula Original" />
                <label>Formula Original </label>
              </div>
              <div class="col-lg-4">
                <input type="checkbox" class="required" placeholder="Historia Clinica" />
                <label>Historia Clinica</label>
              </div>          
            </div>
            <div class="row">&nbsp;</div>
            <div class="row">
              <div class="col-lg-4">
                <input type="checkbox" class="required" placeholder="Autorizacion" />
                <label>Autorización</label>
              </div>
              <div class="col-lg-4">
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Fecha</label>
                  <div class="col-md-10">
                    <input type="date" name="fecha" class="form-control "/>
                  </div>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group row">
                 <label class="col-sm-2 control-label" >EPS</label>
                 <div class="col-md-10">
                   <select class="form-control required" name="entidad">
                     <option></option>
                     <option>Nueva EPS</option>
                     <option>Sociedad Clinica Emcosalud</option>
                     <option>FerroCarriles Nacionales</option>
                     <option>Comparta</option>
                     <option>SaludVida</option>
                   </select>
                 </div>
               </div>
             </div>


             <div class="row">&nbsp;</div>
             <div class="row">&nbsp;</div>

             <div class="row">          
              <div class="col-lg-4">
                <div class="form-group row">
                 <label class="col-sm-3 control-label">Documento</label>
                 <div class="col-md-8">
                   <select class="form-control required" name="tdocumento">
                    <option></option>
                    <option>Cedula de Ciudadania</option>
                    <option>Tarjeta de Identidad</option>
                    <option>Registro Civil</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group row">
                <label class="col-sm-2 control-label" >N°</label>
                <div class="col-md-10">
                  <input placeholder="Documento" type="text" name="ndocumento" class="form-control required"/>
                </div>
              </div>
            </div>

            <div class="row">          
             <div class="col-lg-4">
               <div class="form-group row">
                <label class="col-sm-2 control-label">Tutela</label>
                <div class="col-md-8">
                  <select class="form-control required" name="tutela">
                    <option></option>
                    <option>Tutela Pos</option>
                    <option>Tutela Nopost</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">&nbsp;</div>
            <div class="row">&nbsp;</div>

            <div class="col-lg-4">
              <div class="form-group row">
               <label class="col-sm-2 control-label">N°</label>
               <div class="col-md-10">
                 <input placeholder="Autorización" type="text" name="autorizacion" class="form-control required"/>
               </div>
             </div>
           </div>
           <div class="col-lg-4">
            <div class="form-group row">
              <label class="col-sm-2 control-label"></label>
              <div class="col-md-10">
                <textarea placeholder="Observaciones" type="textarea" name="observaciones" class="form-control"></textarea>
              </div>
            </div>
          </div>
          <button id="btn-guarda-tutela" type="submit" class="btn btn-info btn-lg">Radicar</button>
        </div>
      </div>
    </div>
  </div>
</form>
 <div id="MyModal" class="modal fade bs-example-modal-lg-new" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Registro Medico</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="frm-add-registro" name="add">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 required"> N° Registro Medico <span class="">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="name" class="form-control col-md-7 col-xs-12 required" type="text" placeholder="Numero de  Autorización">
                            </div>
                        </div>

                         <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="btn-save-data" type="submit" class="btn btn-success">Guardar</button>

                 <b><p>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->

</div>
</div>
</div>
</div>
</div>
</div>
</div><!-- /page content-->
<?php include "footer.php"; ?>ok 
<script type="text/javascript" src="js/project.js"></script>
<script>
  $( "#add" ).submit(function( event ) {
    $('#save_data').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "action/addproject.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#result").html("Mensaje: Cargando...");
      },
      success: function(datos){
        $("#result").html(datos);
        $('#save_data').attr("disabled", false);
        load(1);
      }
    });
    event.preventDefault();
  })

  // success

  $( "#upd" ).submit(function( event ) {
    $('#upd_data').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "action/updproject.php",
      data: parametros,
      beforeSend: function(objeto){
        $("#result2").html("Mensaje: Cargando...");
      },
      success: function(datos){
        $("#result2").html(datos);
        $('#upd_data').attr("disabled", false);
        load(1);
      }
    });
    event.preventDefault();
  })

  function obtener_datos(id){
    var description = $("#description"+id).val();
    var name = $("#name"+id).val();
    $("#mod_id").val(id);
    $("#mod_description").val(description);
    $("#mod_name").val(name);
  }
</script>