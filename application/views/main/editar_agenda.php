
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <i class="fa fa-plus"></i> Nova Agenda <small></small>                            
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-newspaper-o"></i> Nova Agenda
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<!-- AREA DE NOTIFICAÇÃO -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                    	
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="container-fluid">
                               	<form action="<?php echo current_url(); ?>" method="POST" class="form-group">
                                   <div class="row">
                                	<div class="col-md-7">
                                		<div class="form-group">
                                			<label>Tipo de Evento: </label>
                                			<?php 
                                			$opt_evento[''] = '---------- Selecione o evento ---------';
											foreach($eventos as $evento):
											$opt_evento[$evento->id] = $evento->nome;										
											endforeach;
											echo form_dropdown('p#id_evento',$opt_evento,set_value('p#id_evento',$agenda->id_evento),'class="form-control" required');
                                			
                                			 ?>
                                		</div>
                                		
                                	</div>
                                	
                                </div>
                               	<div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                            <label>Descrição do evento: </label>
                                            <textarea class="form-control" required  name="p#evento" placeholder=""><?php echo $agenda->evento ?></textarea>
                                    </div>
                                </div>
                               <div class="col-lg-3">
                                    <div class="form-group">
                                            <label>Local: </label>
                                            <textarea class="form-control" required  name="p#local" placeholder=""><?php echo $agenda->local  ?></textarea>
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2">
                                       <div class="form-group">
                                            <label>Data: </label>
                                            <input class="form-control" type="date" value="<?php echo arruma_data($agenda->data) ?>" required  name="p#data" placeholder="EX:12/01/2017">
                                        </div> 
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Hora Início: </label>
                                            <input class="form-control" required value="<?php echo $agenda->horaInicio; ?>" type="time"  name="p#horaInicio" placeholder="EX:12:00:00">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Hora Término: </label>
                                            <input class="form-control" required  type="time" value="<?php echo $agenda->horaTermino; ?>" name="p#horaTermino" placeholder="EX:13:00:00">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-12">
                                <button type="submit" class="btn btn-default"><i class="fa fa-check"></i> Avançar</button>
                                </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </form>
                            </div>
                            <!-- /.row (nested) -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->



