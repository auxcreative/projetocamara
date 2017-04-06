<div class=container-fluid">
    <h2><i class="fa fa-calendar"></i>Agenda</h2>
    <br/>
    
</div>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Panel heading</div>

  <!-- Table -->
  <table class="table table-striped table-responsive">
             <thead>
                                            <tr>
                                            	<th width="">Evento</th>
                                            	<th width="">Local</th>
                                                <th width="100">Data</th>
                                                <th width="150">Hora</th>
                                             <!--   <th class="text-center" width="150">Status</span></th> -->
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($agenda as $evento): ?>
                                            <tr>
                                                <td><?php echo $evento -> nome_evento; ?></td>
                                                <td><?php print $evento -> local; ?></td>
                                                <td><?php print arruma_data($evento -> data); ?></td>
                                                <td><?php print $evento -> horaInicio . ' - ' . $evento -> horaTermino; ?></td>
                                              <!--  <td class="text-center">
                                                	<?php 
                                                	
                                                	if($evento->data < date('Y-m-d')):														
														echo '<span class="glyphicon glyphicon-ok"> Encerrado</span>';
													else:
														echo ($evento -> horaTermino < date('H:i:s')) ? '<span class="glyphicon glyphicon-ok"> Encerrado</span>' : '<span class="glyphicon glyphicon-hourglass"> Aberto</span>';
													endif;?>
                                                	
                                              </td> -->
                                            </tr>
                                       	<?php endforeach; ?>
                                        </tbody>
        </table>
</div>