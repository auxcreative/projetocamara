<div class=container-fluid">
<div class="row">
    <h2>Prestação de Contas da Mesa Diretora</h2>
    <br/>
    
</div>
</div>
<div class="row">
	<div class="col-md-7 image">

		<div class="row">
<?php if($this->uri->segment(3) == ''){ ?>
<p>
Mensalmente, a Mesa Diretora da Câmara Municipal de Coelho Neto 
vai apresentar uma síntese das atividades da Casa, prestando contas aos 
cidadãos e cidadãs das realizações do Parlamento municipal.
Para a prestação de contas de forma mais ampla e minuciosa, 
os coelhonetenses têm todas as informações no portal publicadas 
em dois formatos distintos. Primeiramente, no jornalístico, 
como notícias do dia a dia, e de forma institucional, nos vários itens dispostos no menu à esquerda.
Verifique ao lado a prestação de contas da Mesa Diretora desde quando começou a ser feita, em 2017.
</p>
<?php } else if ($this->uri->segment(3) != '' && $this->uri->segment(4) == '') {  ?>
<ul>
	<?php foreach ($mes as $key) { ?>
		<li><b>Conta do mês de <?php echo anchor(base_url('prestacao_de_contas/mesa_diretora/'.$key->ano.'/'.$key->mes),$key->mes.' do ano de '.$key->ano) ?></b></li>
	<?php } ?>  
</ul>
	
<?php } else {?>
	<ul>
	<?php foreach ($prestacao as $prestacao_mes) { ?>
		<li><b><?php echo $prestacao_mes->texto; echo anchor(base_url('prestacao_de_contas/dowload/'.$prestacao_mes->arquivo),'Arquivo') ?></b></li>
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