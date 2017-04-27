<div class=page-header">
    <h1 class="text-center">Dados e Contatos do Vereador</h1> 
</div>    
<div class="row">
	<?php if($this->uri->segment(3) == ''): ?>
	<div class="row">
	<?php foreach ($vereador as $value): ?>	
	<div class="col-md-2">
		<div class="thumbnail">
			<a href="<?php echo base_url('vereador/dados_e_contatos/' . codificarString($value -> id)); ?>">
			<img src="<?php echo base_url('uploads/biografias/'.$value->imagem)  ?>" alt="<?php echo $value -> nome; ?>">
			</a>
		</div>
	<!--<img src="<?php echo base_url('uploads/biografias/osmar.jpg'); ?>"  class="img-thumbnail" />-->
	</div>
	<?php
		endforeach;

		else:
 ?>
		<div class="row">
			<div class="col-sm-12">
			<div class="col-sm-3 col-sm-offset-4 col-xs-12">
				<div class="row">
				<div class="thumbnail">
				<img src="<?php echo base_url('uploads/biografias/'.$vereadorLinha->imagem)  ?>" alt="<?php echo $vereadorLinha -> nome; ?>">	
				</div>
				</div>
				<div class="row">
<address>
  <strong><?php echo $vereadorLinha -> site; ?></strong><br>
  <?php echo $vereadorLinha->logradouro ?><br>
  <?php echo $vereadorLinha -> cidade . ' - ' . $vereadorLinha -> cep; ?><br>
  <abbr title="Celular">C:</abbr> <?php echo $vereadorLinha->celular ?><br />
  <abbr title="Fixo">F:</abbr> <?php echo $vereadorLinha->telefone_fixo ?>
</address>

<address>
  <strong><?php echo $vereadorLinha -> nome; ?></strong><br>
  <a href="mailto:#"><?php echo $vereadorLinha -> email; ?></a>
  
</address>
<a href="<?php echo base_url('vereador/dados_e_contatos') ?>">Voltar</a>
				</div>
			</div>
	<?php endif; ?>
	</div>
</div>
</div>
</div>
