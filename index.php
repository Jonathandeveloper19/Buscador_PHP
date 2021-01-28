

<?php

  //...Incluyendo la conexión a la base de datos...

  include("php/conexion_bd.php");


  //---INICIO Filtro de busueda por ciudad y tipo---

  //(search) variable utilizada para almacenar y mostrar los datos encontrados.
    $search = "";
      
   //Se trae el método (submit) del boton con el name(buscar).
    if(isset($_POST['buscar'])){

      //Campos seleccionados, recibidos por el metodo(POST).
      $ciudad = htmlspecialchars($_POST['ciudad']);
      $tipo = htmlspecialchars($_POST['tipo']);

      //Determina si el campo seleccionado esta vacio o no.
      if(empty($_POST['ciudad'])){

        $search="where tipo like '".$tipo."%'";

      }elseif(empty($_POST['tipo'])){

        $search="where ciudad='".$ciudad."'";
      }else{
        $search="where tipo like '".$tipo."%' and ciudad='".$ciudad."'";
      }
    }


    // Se realiza una consulta SQL

    $registros="SELECT * FROM datos_generales $search";
    $resultado=$conexion->query($registros);

    // Sentencia SQL que determina que no hay registros al realizar el filtro de busqueda.
    if(mysqli_num_rows($resultado)==0){
      $mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
    }

  //---FIN Filtro de busueda por ciudad y tipo---

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulario</title>
</head>

<body>
  

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">
      <form method="post">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
            <select name="ciudad">
              <option value="" selected>Elige una ciudad</option>

                <!-- INICIO Sentencia PHP -->

                <?php 
                //Se realiza una consulta SQL.

                $ciudades="SELECT DISTINCT ciudad FROM datos_generales";
                $r_ciudad=$conexion->query($ciudades);

                // array numérico y asociativo
                while ($rciudad = $r_ciudad->fetch_array(MYSQLI_BOTH)){
                  echo '<option value="'.$rciudad['ciudad'].'">'.$rciudad['ciudad'].'</option>';
                }
                 ?>
             
                <!-- FIN Sentencia PHP -->

            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo">
              <option value="">Elige un tipo</option>

                <!-- INICIO Sentencia PHP -->

                <?php 

                //Se realiza una consulta SQL.

                $tipos="SELECT DISTINCT tipo FROM datos_generales";
                $r_tipo=$conexion->query($tipos);

                // array numérico y asociativo
                while ($rtipo = $r_tipo->fetch_array(MYSQLI_BOTH)){
                  echo '<option value="'.$rtipo['tipo'].'">'.$rtipo['tipo'].'</option>';
                }
                 ?>

                <!-- FIN Sentencia PHP -->

            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="submit" name="buscar" class="btn white" value="Buscar">
          </div>
        </div>
      </form>
    </div>
    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles</a></li>
        <li><a href="#tabs-2">Mis bienes</a></li>
        <li><a href="#tabs-3">Reportes</a></li>
      </ul>
      <div id="tabs-1">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            
                  <!-- INICIO Sentencia PHP -->

                  <?php
                    // array numérico y asociativo
                     while ($dato = $resultado->fetch_array(MYSQLI_BOTH)) { ?>

                      <!-- Visualización en pantalla de todos los datos de (Bienes Disponibles) -->
                      <div class="row">
                        <div class="col s12 card" style="background-color: #f2f2f2;">
                          <img align="left" src="img/home.jpg" style="width: 300px; height: 290px;">
                          <p><b>Dirección: </b><?php echo $dato['direccion']; ?></p>
                          <p><b>Ciudad: </b><?php echo $dato['ciudad']; ?></p>
                          <p><b>Teléfono: </b><?php echo $dato['telefono']; ?></p>
                          <p><b>Codigo Postal: </b><?php echo $dato['codigo_postal']; ?></p>
                          <p><b>Tipo: </b><?php echo $dato['tipo']; ?></p>
                          <p><b>Precio: </b><?php echo $dato['precio']; ?></p>

                          <!-- Etiqueta que encapsula el (id) del registro-->
                          <?php 
                            echo "<a href='php/insertar_bienes.php?id=".$dato['id']."'><button>Guardar</button></a>"
                           ?>
                          
                        </div>
                      </div>
                  <?php } ?>

                 <!-- FIN Sentencia PHP -->
                 
            <div class="divider"></div>
          </div>
        </div>
      </div>

      
      <div id="tabs-2" >
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>

            <!-- INICIO Sentencia PHP -->

            <?php

            // Se realiza una consulta SQL
             $registros="SELECT * FROM intelcost_bienes";
             $resultado2=$conexion->query($registros);

            // array numérico y asociativo
             while ($dato = $resultado2->fetch_array(MYSQLI_BOTH)) { ?>
                <!-- Visualización en pantalla de todos los datos de (Bienes Guardados) -->
                <div class="row">
                  <div class="col s12 card" style="background-color: #f2f2f2;">
                    <img align="left" src="img/home.jpg" style="width: 300px; height: 290px;">
                    <p><b>Dirección: </b><?php echo $dato['direccion']; ?></p>
                    <p><b>Ciudad: </b><?php echo $dato['ciudad']; ?></p>
                    <p><b>Teléfono: </b><?php echo $dato['telefono']; ?></p>
                    <p><b>Codigo Postal: </b><?php echo $dato['codigo_postal']; ?></p>
                    <p><b>Tipo: </b><?php echo $dato['tipo']; ?></p>
                    <p><b>Precio: </b><?php echo $dato['precio']; ?></p>
                    <?php 
                      echo "<a href='php/eliminar_bienes.php?id=".$dato['id']."'><button>Eliminar</button></a>"
                     ?>
                  </div>
                </div>
            <?php } ?>

            <!-- FIN Sentencia PHP -->

            <div class="divider"></div>
          </div>
        </div>
      </div>

      <div id="tabs-3" >
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center; text-align: center;">
            <form action="php/generar_excel.php" method="post">
              
               <h5>Exportar reporte:</h5>

            <select name="ciudad2" style="margin-top: 30px; width: 70%;">
              <option value="" selected>Elige una ciudad</option>

                <!-- INICIO Sentencia PHP -->

                <?php

                //Se realiza una consulta SQL. 

                $ciudades="SELECT DISTINCT ciudad FROM datos_generales";
                $r_ciudad=$conexion->query($ciudades);

                // array numérico y asociativo
                while ($rciudad = $r_ciudad->fetch_array(MYSQLI_BOTH)){
                  echo '<option value="'.$rciudad['ciudad'].'">'.$rciudad['ciudad'].'</option>';
                }
                 ?>
            </select>

            <select name="tipo2" style="margin-top: 10px; width: 70%;">
              <option value="">Elige un tipo</option>

                <?php 

                //Se realiza una consulta SQL.

                $tipos="SELECT DISTINCT tipo FROM datos_generales";
                $r_tipo=$conexion->query($tipos);

                // array numérico y asociativo
                while ($rtipo = $r_tipo->fetch_array(MYSQLI_BOTH)){
                  echo '<option value="'.$rtipo['tipo'].'">'.$rtipo['tipo'].'</option>';
                }
                 ?>

                <!-- FIN Sentencia PHP -->
            </select>

              <button type="submit" class="btn_excel">Generar Excel</button>
            </form>
            <div class="divider"></div>
          </div>
        </div>
      </div>
    </div>



    <!------------------------- Scripts ---------------------------->

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    
    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
          $( "#tabs" ).tabs();
      });
    </script>
  </body>
  </html>
