<div class=container-fluid">
<div class="row">
    <h2>Prestação de Contas</h2>
    <br/>
    
</div>
</div>
<div class="row">
	<div class="col-md-7 image">
		<div class="row">
			<p>A Câmara Municipal disponibiliza todos os meses a 
				<b><?php echo anchor('prestacao_de_contas/mesa_diretora','prestação de contas da Mesa Diretora') ?></b> cobrindo as principais ações das diversas áreas da Câmara. Além disso, os 
				munícipes podem acompanhar o <b><?php echo anchor('prestacao_de_contas/custo_mandato','custo mensal do mandato') ?></b>  de cada um dos 13 gabinetes de vereadores.</p>
		</div>
	</div>
	<div class="col-md-5">
	<div class="panel-default">
<div class="list-group">
	<?php 
	
	echo '<b>'.anchor(base_url('Prestacao_de_contas/mesa_diretora'),'MESA DIRETORA','class="list-group-item"').'</b>' ?> 

  <?php foreach ($ano as $value): ?>
  	<a href="<?php echo base_url('prestacao_de_contas/mesa_diretora/'.$value->ano) ?>" 
  	class="list-group-item"><span class="glyphicon glyphicon-calendar"></span> <?php echo $value->ano ?>
  </a>
      
 <?php endforeach; ?>

	<?php 
	echo '<b>'.anchor(base_url('Prestacao_de_contas/vereadores'),'VEREADORES','class="list-group-item"').'</b>' ?>   
</div>	

		</div>
		
	</div>
</div>