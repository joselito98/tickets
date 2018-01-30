<?php
    /* este archivo me permite enviar un  correo electronico */

  /*Destino: direcciond del correo al que se le envian estos datos*/
  
     $destino= "alohamudanzas@gmail.com";
     error_reporting(0);

    /*Recepcion de varaibles del form principal*/

     $nombre = $_POST["nombre"];
     $celular = $_POST["celular"];
     $empresa = $_POST["empresa"];
     $correo = $_POST["correo"];

    /*variables del segundo form*/
     $fecha_pedido = $_POST["fecha_pedido"];
     $hora_pedido = $_POST["hora_pedido"];
     $tipo = $_POST["tipo"];
     $peso_carga = $_POST["peso_carga"];
     $volumen_carga = $_POST["volumen_carga"];

     $punto_partida = $_POST["punto_partida"];
     $punto_llegada = $_POST["punto_llegada"];
     $tipo_servicio = $_POST["tipo_servicio"];

     $distrito_salida = $_POST["distrito_salida"];
     $distrito_llegada = $_POST["distrito_llegada"];
     $cant_estibadores = $_POST["cant_estibadores"];

     /*Envio de los datos al correo */

     $contenido = "nombre: " . $nombre .
      "\ncelular: " . $celular . 
      "\nempresa :" . $empresa ;
      
      $envio= mail($destino,"¡ALOHA CARGA!", $contenido);

    /*------------------------------------------------*/

    /*Declaracion de la zona horaria */
      date_default_timezone_set('America/Lima');
     /*$horaActual: obtiene la hora del sistema en formato 12 horas*/               
      $horaActual=date("h:i"); 
      /* declaracion de horas no ingresadas ne el moento por lo cual se definen  y  se envia a la bd */
      $hora_solicitud="0:00";
      $estado="espera";  
        
      $tipo_usuario="empresa";
      $ruc="ninguno";
      /*La conexion se realiza con msqli*/

      /*Declaracion de la zona horaria*/
      date_default_timezone_set('America/Lima'); 
      /*Variable que me guarda la hora actual del sistema*/
      $horaActual=date("h:i");
      $fecha_solicitud= date("Y-m-d");
      /*Var que que le asigno un estado para enviarlo a la consulta*/
      $estado="espera"; 

      /*La conexion se realiza con msqli*/

       $conexion = new mysqli("localhost", "root", "root", "aloha_bd");

            #Comprobar la conexión a la bd
          if ($conexion->connect_errno) {
                  printf("Conexión fallida: %s
                  ", $conexion->connect_error);
                  exit();
          }

            if($nombre !=null && $empresa !=null && $correo !=null){
            #Insertar datos a través de la sentencia INSERT en la tabla usuarios
            $consulta = "INSERT INTO usuarios(nombre, celular,razon_social,tipo_usuario,ruc,email) VALUES('$nombre','$celular','$empresa','$tipo_usuario','$ruc','$correo')";
            $resultado = $conexion -> query($consulta)|| 
            die("Ha ocurrido un error al guardar los datos de la persona");

          }
          
            /*Consulto el ulimo id que fue ingresado en la bd para pider enviarlo a la consulta*/
            $result = mysqli_query($conexion, "SELECT id_usuario FROM usuarios order by id_usuario desc limit 1");
            mysqli_data_seek ($result, 0);
              /*Extraido: variable que e trae los datos de la consulta en forma de arreglo */
            $extraido= mysqli_fetch_array($result);
              /*Lo recorro para poderlo estraer del arreglo de datos*/
            foreach ($extraido as $key => $ultReg) {
              /*ultReg: variable que me trae el ultio registro isertado */
                      $ultReg=$ultReg;
            }
              /*Insertando en la tabla solcitud de pedidos*/
            $consulta = "INSERT INTO pedidos(fecha_solicitud_pedido, hora_solicitud_pedido, fk_usuario) VALUES('$fecha_solicitud','$horaActual','$ultReg')";
              
            $resultado = $conexion -> query($consulta)|| 
            die("Ha ocurrido un error al guardar pedidos los datos");

              /*Insert a la tabla direccion de salidas*/
              $consulta = "INSERT INTO  informacion_salidas(direccion_salida,distrito_salida) VALUES('$punto_partida','$distrito_salida')";
              $resultado = $conexion -> query($consulta)|| 
              die("Ha ocurrido un error al guardar los datos de la salida"); 

              /*Insert a la tabla informacion de llegadas*/
              $consulta = "INSERT INTO  informacion_llegadas(direccion_llegada,distrito_llegada) VALUES('$punto_llegada','$distrito_llegada')";
              $resultado = $conexion -> query($consulta)|| 
              die("Ha ocurrido un error al guardar los datos de la llegada");

              /*Consuta del ultimo id_ de pedido ingresado*/
              $result = mysqli_query($conexion, "SELECT id_pedido from  pedidos order by id_pedido desc limit 1");

              mysqli_data_seek ($result, 0);
              $extraido= mysqli_fetch_array($result);

              /*Lo recorro para poderlo estraer del arreglo de datos*/
              foreach ($extraido as $key => $id_solcitud_pedido) {

                /*idPedido: variable que me trae el la id del ultimo pedido isertado */    
                     $id_solcitud_pedido=$id_solcitud_pedido;
              }

                
              if($volumen_carga<=10 && $peso_carga <=1.5 || $volumen_carga>10 && $peso_carga>1.5){


                    $tipoCamion="10m3/1.5";
                    $zona="Puente piedra";

                    $result = mysqli_query($conexion, 
                        " select  id_tarifa
                          from tarifas
                          inner join tipo_camion
                          on tipo_camion.id_camion= tarifas.fk_camion
                          inner join zonas 
                          on zonas.id_zona= id_zona
                          where zonas.distrito= '".$distrito_llegada."' and tipo='".$tipoCamion."' ");
                   

                    mysqli_data_seek ($result, 0);
                    $extraido= mysqli_fetch_array($result); 

                    foreach ($extraido as $key => $id) {
                    
                            $id_tarifa=$id;                
                    }

                    /*Insert a la tabla descripcion pedido*/
                    
                    $consulta = "INSERT INTO descripcion_pedidos(peso_carga,fk_pedido,tipo_carga,volumen_carga,tipo_servicio,hora, fecha,estado,cantidad_estibadores,fk_tarifa)
                     VALUES('$peso_carga','$id_solcitud_pedido','$tipo','$volumen_carga','$tipo_servicio','$hora_pedido','$fecha_pedido','$estado','$cant_estibadores','$id_tarifa')";
                                                    
                    $resultado = $conexion -> query($consulta)|| 
                    die("Ha ocurrido un error al guardar pedidos_descripcion los datos");                    

                    }
                      elseif ( $volumen_carga<=15 && $peso_carga <=2 && $volumen_carga>15 || $peso_carga>2) {
             
                          $tipoCamion="15m3/2";                                

                         $tipoCamion="10m3/1.5";
                    $zona="Puente piedra";

                    $result = mysqli_query($conexion, 
                        " select  id_tarifa
                          from tarifas
                          inner join tipo_camion
                          on tipo_camion.id_camion= tarifas.fk_camion
                          inner join zonas 
                          on zonas.id_zona= id_zona
                          where zonas.distrito= '".$distrito_llegada."' and tipo='".$tipoCamion."' ");
                   

                    mysqli_data_seek ($result, 0);
                    $extraido= mysqli_fetch_array($result); 

                    foreach ($extraido as $key => $id) {
                    
                            $id_tarifa=$id;                
                    }

                    /*Insert a la tabla descripcion pedido*/
                    
                    $consulta = "INSERT INTO descripcion_pedidos(peso_carga,fk_pedido,tipo_carga,volumen_carga,tipo_servicio,hora, fecha,estado,cantidad_estibadores,fk_tarifa)
                     VALUES('$peso_carga','$id_solcitud_pedido','$tipo','$volumen_carga','$tipo_servicio','$hora_pedido','$fecha_pedido','$estado','$cant_estibadores','$id_tarifa')";
                                                    
                    $resultado = $conexion -> query($consulta)|| 
                    die("Ha ocurrido un error al guardar pedidos_descripcion los datos");                    


                        }
                          elseif ($volumen_carga<=20 && $peso_carga <=3 && $volumen_carga>20 && $peso_carga>3) {

                              $tipoCamion="20m3/3";
                              
                                          
                              $tipoCamion="10m3/1.5";
                    $zona="Puente piedra";

                    $result = mysqli_query($conexion, 
                        " select  id_tarifa
                          from tarifas
                          inner join tipo_camion
                          on tipo_camion.id_camion= tarifas.fk_camion
                          inner join zonas 
                          on zonas.id_zona= id_zona
                          where zonas.distrito= '".$distrito_llegada."' and tipo='".$tipoCamion."' ");
                   

                    mysqli_data_seek ($result, 0);
                    $extraido= mysqli_fetch_array($result); 

                    foreach ($extraido as $key => $id) {
                    
                            $id_tarifa=$id;                
                    }

                    /*Insert a la tabla descripcion pedido*/
                    
                    $consulta = "INSERT INTO descripcion_pedidos(peso_carga,fk_pedido,tipo_carga,volumen_carga,tipo_servicio,hora, fecha,estado,cantidad_estibadores,fk_tarifa)
                     VALUES('$peso_carga','$id_solcitud_pedido','$tipo','$volumen_carga','$tipo_servicio','$hora_pedido','$fecha_pedido','$estado','$cant_estibadores','$id_tarifa')";
                                                    
                    $resultado = $conexion -> query($consulta)|| 
                    die("Ha ocurrido un error al guardar pedidos_descripcion los datos");                    

                       
                         } 
                          elseif ($volumen_carga<=30 && $peso_carga <=5  || $volumen_carga>30 && $peso_carga>5) {

                              $tipoCamion="30m3/5";

                              $tipoCamion="10m3/1.5";
                    $zona="Puente piedra";

                    $result = mysqli_query($conexion, 
                        " select  id_tarifa
                          from tarifas
                          inner join tipo_camion
                          on tipo_camion.id_camion= tarifas.fk_camion
                          inner join zonas 
                          on zonas.id_zona= id_zona
                          where zonas.distrito= '".$distrito_llegada."' and tipo='".$tipoCamion."' ");
                   

                    mysqli_data_seek ($result, 0);
                    $extraido= mysqli_fetch_array($result); 

                    foreach ($extraido as $key => $id) {
                    
                            $id_tarifa=$id;                
                    }

                    /*Insert a la tabla descripcion pedido*/
                    
                    $consulta = "INSERT INTO descripcion_pedidos(peso_carga,fk_pedido,tipo_carga,volumen_carga,tipo_servicio,hora, fecha,estado,cantidad_estibadores,fk_tarifa)
                     VALUES('$peso_carga','$id_solcitud_pedido','$tipo','$volumen_carga','$tipo_servicio','$hora_pedido','$fecha_pedido','$estado','$cant_estibadores','$id_tarifa')";
                                                    
                    $resultado = $conexion -> query($consulta)|| 
                    die("Ha ocurrido un error al guardar pedidos_descripcion los datos");                    

                         
                        }
                          elseif ($volumen_carga<=60 && $peso_carga <=10 || $volumen_carga>30 && $peso_carga>10) {

                              $tipoCamion="60m3/10";

                              $tipoCamion="10m3/1.5";
                    $zona="Puente piedra";

                    $result = mysqli_query($conexion, 
                        " select  id_tarifa
                          from tarifas
                          inner join tipo_camion
                          on tipo_camion.id_camion= tarifas.fk_camion
                          inner join zonas 
                          on zonas.id_zona= id_zona
                          where zonas.distrito= '".$distrito_llegada."' and tipo='".$tipoCamion."' ");
                   

                    mysqli_data_seek ($result, 0);
                    $extraido= mysqli_fetch_array($result); 

                    foreach ($extraido as $key => $id) {
                    
                            $id_tarifa=$id;                
                    }

                    /*Insert a la tabla descripcion pedido*/
                    
                    $consulta = "INSERT INTO descripcion_pedidos(peso_carga,fk_pedido,tipo_carga,volumen_carga,tipo_servicio,hora, fecha,estado,cantidad_estibadores,fk_tarifa)
                     VALUES('$peso_carga','$id_solcitud_pedido','$tipo','$volumen_carga','$tipo_servicio','$hora_pedido','$fecha_pedido','$estado','$cant_estibadores','$id_tarifa')";
                                                    
                    $resultado = $conexion -> query($consulta)|| 
                    die("Ha ocurrido un error al guardar pedidos_descripcion los datos");                    

                             }
      //----------------------------------------------------------------------------

            /*Envio de los datos del segundo form al correo */

            $titulo="Solicitud de carga";
            $nombre="ninguno";

            $datos = " " . $titulo .
                          "\nNombre : " . $nombre . 
                          "\nfecha  : " . $fecha_pedido . 
                          "\nhora   : " . $hora_pedido . 
                          "\ntipo de carga     : " . $tipo . 
                           "\npeso de carga    : " . $peso_carga .
                           "\nvolumen de carga : " . $volumen_carga .
                           "\npunto de partida : " . $punto_partida .
                           "\npunto de llegada : " . $punto_llegada .
                           "\ntipo de servicio : " . $tipo_servicio;
    
            $envio= mail($destino,"¡ALOHA CARGA!", $datos);


     
?>