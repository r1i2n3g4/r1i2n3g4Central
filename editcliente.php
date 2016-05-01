            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Editar Cliente
                        <small>Clientes</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Edición de Clientes</li>
                    </ol>
                </section>
				<?php
                $reg = $db->get("clientes", "*", ["id" => $_GET["id"] ]);
				?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6" style="float:none !important; margin: auto;">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Datos del Cliente</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" action="includes/functions.php?op=editCliente&id=<?=$_GET["id"]?>" method="post">
                                    <div class="box-body">
                                        
                                        <div class="form-group">
                                        	<label for="txtNombre">Nombre del Cliente</label>
	                                        <input type="text" name="txtNombre" value="<?=$reg["nombre"];?>" id="txtNombre" class="form-control" placeholder="Nombre">
	                                    </div>                                     
                                        <div class="form-group">
	                                        <label for="txtRif">RIF</label>
	                                        <input type="text" name="txtRif" id="txtRif" value="<?=$reg["rif"];?>" class="form-control" placeholder="RIF">
	                                    </div>
	                                    <?php
	                                    $datas = $db->select("localidades",["id", "nombre"], ["tabla" => "estado", "ORDER" => "nombre ASC"]);
	                                    ?>
	                                    <label for="cmbEstado">Estado</label>
	                                    <select name="cmbEstado" id="cmbEstado" class="form-control">
	                                    	<option value="0">-- SELECCIONE --</option>
	                                        <?php
	                                        foreach ( $datas as $data ) {
	                                        ?>
	                                        	<option <?=($reg["idEstado"] == $data["id"])?"selected":""?> value="<?=$data["id"]?>"><?=$data["nombre"]?></option>
	                                        <?php
											}
	                                        ?>
	                                    </select>
	                                    <label for="cmbMunicipio">Municipio</label>
	                                    <select name="cmbMunicipio" id="cmbMunicipio" class="form-control">
	                                        <option value="0">-- SELECCIONE --</option>
	                                    </select>
                                        <div class="form-group">
											<label for="txtDireccion">Dirección</label>
	                                        <textarea class="form-control" name="txtDireccion" id="txtDireccion" rows="3" placeholder="Dirección..."><?=$reg["direccion"];?></textarea>
	                                    </div>
                                        <div class="form-group">
	                                        <label for="txtTelefono">Teléfono</label>
	                                        <input type="text" name="txtTelefono" value="<?=$reg["telefono"];?>" id="txtTelefono" class="form-control" placeholder="Teléfono">
	                                    </div>
                                        <div class="form-group">
	                                        <label for="txtPersonaContacto">Persona Contacto</label>
	                                        <input type="text" name="txtPersonaContacto" value="<?=$reg["personaContacto"];?>" id="txtPersonaContacto" class="form-control" placeholder="Persona Contacto">
	                                    </div>
	                                    <div class="form-group">
	                                        <label for="txtDuracionOperaciones">Duración de Operaciones</label>
	                                        <input type="text" name="txtDuracionOperaciones" value="<?=$reg["duracionOperaciones"];?>" id="txtDuracionOperaciones" class="form-control" placeholder="Duración en Horas de las Operaciones">
	                                    </div>
	                                    <div class="form-group">
	                                        <label for="txtNumeroUsuarios">Numero de Usuarios</label>
	                                        <input type="text" name="txtNumeroUsuarios" value="<?=$reg["numeroUsuarios"];?>" id="txtNumeroUsuarios" class="form-control" placeholder="Máximo de usuarios permitidos">
	                                    </div>
	                                    <?php
	                                    $datas = $db->select("tipo_cobranza",["id", "nombre"], ["estatus" => "1", "ORDER" => "nombre ASC"]);
	                                    ?>
	                                    <label for="cmbTipoCobranza">Tipo de Cobranza</label>
	                                    <select name="cmbTipoCobranza" id="cmbTipoCobranza" class="form-control">
	                                        <option value="0">-- SELECCIONE --</option>
	                                        <?php
	         			                    foreach ( $datas as $data ) {
	                                        ?>
	                                        	<option <?=($reg["idTipoCobranza"] == $data["id"])?"selected":""?> value="<?=$data["id"]?>"><?=$data["nombre"]?></option>
	                                        <?php
											}
	                                        ?>
	                                    </select>
	                                    <div class="form-group">
	                                        <label for="txtTasa">Tasa</label>
	                                        <input type="text" name="txtTasa" value="<?=$reg["tasa"];?>" id="txtTasa" class="form-control" placeholder="Tasa segun Tipo de Cobranza">
	                                    </div>
	                                    <div class="form-group">
	                                        <label for="txtIntervalo">Intervalo de cobro (Meses)</label>
	                                        <input type="text" name="txtIntervalo" value="<?=$reg["intervalo"];?>" id="txtIntervalo" class="form-control" placeholder="Intervalo de cobro expresado en Meses.">
	                                    </div>
	                                    <div class="form-group">
	                                        <label for="txtFecActivacion">Fecha Activacion (Ciclo de Facturación)</label>
	                                        <input type="text" name="txtFecActivacion" value="<?=$reg["fecActivacion"];?>" id="txtFecActivacion" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask placeholder="Fecha en que el cliente entra en producción.">
	                                    </div>
	                                    <div class="form-group">
	                                        <label for="txtMontoAfiliacion">Monto de Afiliación</label>
	                                        <input type="text" name="txtMontoAfiliacion" value="<?=$reg["montoAfiliacion"];?>" id="txtMontoAfiliacion" class="form-control" placeholder="Monto de afiliacion del servicio">
	                                    </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" id="btnSiguiente" class="btn btn-primary">Agregar</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#cmbEstado").trigger("change");

		$("#txtFecActivacion").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	});
</script>