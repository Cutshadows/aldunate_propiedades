<?
$limit_end = 25;

		if($pg==0){ 

            $pg=0; 
            $inicio = $pg * $limit_end; 

			$pagina = 1;

		} else {

			$inicio = ($pg-1) * $limit_end;

			$pagina = $pg;

		}

		
			if($sql==false){
				
			} 


			$qryLim = $qry."  Limit ".$inicio.",".$limit_end." ;";
			

			$r=mysql_query($qryLim);				

			$r_contador=mysql_query($qry);

			$num_contador=mysql_num_rows($r_contador);
			

		/* estado */
		$qry_est="SELECT * FROM `estado`";

		$r_est=mysql_query($qry_est);

		while($d_est=mysql_fetch_array($r_est)){

			$estados[$d_est['CodigoEstado']]=$d_est['Descripcion'];

		}	

		/* tipo Detalle (Destinos)*/

		$qry_tip="SELECT * FROM `tipo` ";

		$r_tip=mysql_query($qry_tip);

		while($d_tipos=mysql_fetch_array($r_tip)){

			$tipos_[$d_tipos['T_Codigo']]=$d_tipos['T_Descripcion'];

		}

		

		
		 

		echo '<div class="col-md-6">
		       		<div class="text-center"><label for="" id="TipoGrafico1"></label></div> 
		       		<div id="box-one-content1" style="min-height: 350px;"></div>
		       		<!--div id="enlaceLink1" class="text-center"><a href="javascript:void(0)" id="toImg1" data-t="1">Descargar Image </a></div-->
		       </div>';	

		 echo '<div class="form-group">

		 			<label for="">Listado de Registros con Respuestas Ingresadas.</label>

		 		</div>';

		 echo '<table class="table table-bordered">

					<thead>

						<tr>

							<td>Numero</td>

							<td>Detalle</td>

							<td>Tipo de Detalle</td>

							<td>Fecha Documento</td>

							<td>Fecha Ingreso</td>

							<td>Estado Documento</td>

							<!--td>Acciones</td>-->

						</tr>

						<tbody>
						';



						while($row=mysql_fetch_array($r)){							

							echo '<tr>										

										<td> <a href="javascript:void(0);" title="ver Información Registro" onclick="abreModalInformacion('.$row['id_correspondencia'].')">'.$row['Numero'].'</a></td>

										<td><a href="javascript:void(0);" title="ver Información Registro" onclick="abreModalInformacion('.$row['id_correspondencia'].')">'.cortar_cadena($row['Detalle'],50).'</a></td>

										<td class="text-center"><a href="javascript:void(0);" title="ver Información Registro" onclick="abreModalInformacion('.$row['id_correspondencia'].')">'.$tipos_[$row['Tipo']].'</a></td>

										<td class="text-center"><a href="javascript:void(0);" title="ver Información Registro" onclick="abreModalInformacion('.$row['id_correspondencia'].')">'.fecha_formato_espanol_($row['FechaDoc']).'</a></td>

										<td class="text-center"><a href="javascript:void(0);" title="ver Información Registro" onclick="abreModalInformacion('.$row['id_correspondencia'].')">'.fecha_formato_espanol_($row['FechaIng']).'</a></td>

										<td class="text-center"><a href="javascript:void(0);" title="ver Información Registro" onclick="abreModalInformacion('.$row['id_correspondencia'].')">'.$estados[$row['Estado']].'</a></td>

										<!--td class="text-center"> 

													<!--a href="javascript:void(0);" onclick="cargaFormulario('.$row['id_correspondencia'].',\''.basename($_SERVER['PHP_SELF']).'\')" title="Ver/Editar">	<i class="glyphicon glyphicon-pencil"></i> </a>	

													<a href="javascript:void(0);" class="btn btn-default" title="Imprimir Registro" onclick="window.open(\'vistas/imprimir_ficha.php?id='.$row['id_correspondencia'].'\',\'_blank\',\'toolbar=no,status=no,menubar=no,location=no\');"><i class="glyphicon glyphicon-print" ></i></a-->

										</td-->
							</a>

									</tr>';

								}

							echo '

						</tbody>


					</thead>
	

		 		</table>'		;

		$total = ceil($num_contador/$limit_end);

		$html = "";

		echo '<nav class="text-center">
			  <ul class="pagination">
			   
			';
 
        //página actual
        $actual_pag = $pagina;
 
        $limit = $limit_end;
 
        $totalPag = floor($num_contador/$limit);
        $pagVisibles = 3;
 
        if($actual_pag <= $pagVisibles)
        {
            $primera_pag = 1;   
        }else{
            $primera_pag = $actual_pag - $pagVisibles; 
        }
 
        if($actual_pag + $pagVisibles <= $totalPag)
        {
            $ultima_pag = $actual_pag + $pagVisibles;
        }else{
            $ultima_pag = $totalPag;
        }
        for($i=$primera_pag; $i<=$ultima_pag; $i++) 
        {
            $html .= ($i == $actual_pag) ? 
            ' <li class="active"><a href="#">'.$i.'</a></li>' : 
            ' <li><a href=javascript:void(0) onclick='.$funcionJS.'('.$i.',"'.basename($_SERVER['PHP_SELF']).'",'.$id.',\'frmBuscarConsulta\')>'.$i.'</a></li>';
        }
         
        $html .= ($actual_pag < $totalPag) ? 
        '<li><a href=javascript:void(0) onclick='.$funcionJS.'('.($pg+1).',"'.basename($_SERVER['PHP_SELF']).'",'.$id.',\'frmBuscarConsulta\')>Siguiente</a></li>' : 
        '';
        $html .= ($actual_pag < $totalPag) ? 
        '<li> <a href=javascript:void(0) onclick='.$funcionJS.'('.$total.',"'.basename($_SERVER['PHP_SELF']).'",'.$id.',\'frmBuscarConsulta\')>Última »</a></li>' : 
        '';
		if($pg==1){ ?>
						<li><span>« Primera</span></li>
                        <?php } else {  ?>
                        <li><a href="javascript:void(0)" onclick="<?php echo $funcionJS; ?>(1,'<?=basename($_SERVER['PHP_SELF']); ?>','<?=$id;?>','frmBuscarConsulta')">« Primera</a></li>
                        <?php
						}
		echo $html;		
			
            	
		echo '	</nav>
				</div>
					<div class="sep"></div>	                    
					<a class="btn btn-default" href="javascript:void(0)" onclick="cargaFormularioId(\'\',\''.basename($_SERVER['PHP_SELF']).'\','.$id.',\'frmBuscarConsulta\')"><i class="glyphicon glyphicon-plus"></i> Nuevo Registro</a>                    
				</div>'; 