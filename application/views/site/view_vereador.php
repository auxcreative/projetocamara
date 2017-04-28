<div class="row">
<div class="col-sm-12">
 
	<?php if($this->uri->segment(3) == ''): ?>  
<div class="page">
    <h1 class="text-center">Vereadores 2017-2020</h1> 
    <hr />
</div> 
<div class="row">
	<?php foreach ($vereador as $value): ?>	
	<div class="col-sm-2">
		<div class="thumbnail">
			<a href="<?php echo base_url('vereador/dados_e_contatos/' . codificarString($value -> id)); ?>">
			<img src="<?php echo base_url('uploads/biografias/'.$value->imagem)  ?>" alt="<?php echo $value -> nome; ?>">
			</a>
		</div>
	<!--<img src="<?php echo base_url('uploads/biografias/osmar.jpg'); ?>"  class="img-thumbnail" />-->
	</div>

	<?php endforeach; ?>
</div>
<?php else: ?>
<div class="row">
<div class="col-sm-12">
<div class="page">
    <h1 class="text-center">Dados do Vereador</h1> 
    <hr />
</div> 	
<div class="col-sm-4 col-sm-offset-4 col-xs-12">
				<div class="row">
				<div class="thumbnail">
				<img src="<?php echo base_url('uploads/biografias/'.$vereadorLinha->imagem)  ?>" alt="<?php echo $vereadorLinha -> nome; ?>">	
				</div>
				</div>
				<div class="row">
<address>
  <strong><?php echo $vereadorLinha -> site; ?></strong><br>
  <?php echo $vereadorLinha->logradouro ?>,&nbsp;<?php echo $vereadorLinha -> cidade . '<br /> CEP: ' . $vereadorLinha -> cep; ?><br>
  <abbr title="Celular">Cel:</abbr> <?php echo $vereadorLinha->celular ?><br />
  <abbr title="Fixo">Fixo:</abbr> <?php echo $vereadorLinha->telefone_fixo ?>
</address>
<address>
  <strong><?php echo $vereadorLinha -> nome; ?></strong><br>
  <a href="mailto:#"><?php echo $vereadorLinha -> email; ?></a>  
</address>
<a class="btn-default btn" href="<?php echo base_url('vereador/dados_e_contatos') ?>">Voltar</a>
<a class="btn-primary btn" href="<?php echo base_url('vereador/biografia/'.$this->uri->segment(3)) ?>">Biografia</a>
				
			</div>
			</div>
	</div>
</div>
<br />
	<?php endif; ?>
</div>
</div>