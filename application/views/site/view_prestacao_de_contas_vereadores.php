<?php $ano_url = $this->uri->segment(3); ?>
<div class=container-fluid">
<div class="row">
    <h2>Prestação de Contas dos Vereadores</h2>
    
</div>
</div>
<div class="row">
	<h3>Contas por ano</h3>
	<div class="col-md-7 image">
		
		<div class="row">
<?php if(isset($vereador)){ ?>
<?php foreach($vereador as $lista): ?>
<div class="col-md-4">	
<a href="<?php echo base_url('prestacao_de_contas/vereadores/'.$ano_url.'/'.$lista->id) ?>">
	<img src="<?php echo base_url('images/'.$lista->imagem) ?>" alt="..." class="img-thumbnail"></a>
	<p class="text-center"><?php echo $lista->nome ?></p>
</div>
<?php 
	endforeach;
} else {  ?>
<ul>
	<?php foreach ($ano as $key) { ?>
		<li><b><?php echo anchor(base_url('Prestacao_de_contas/vereadores/'.$key->ano),'Contas do ano de '.$key->ano) ?></b></li>
	<?php } ?>  
</ul>
	
<?php } ?>
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