<div class="row">
<div class="col-sm-12">
 
	<?php if($this->uri->segment(3) == '') redirect(base_url('vereador/dados_e_contatdos'));	 ?>  

<div class="row">
<div class="col-sm-12">
<div class="page">
    <h1 class="text-center">Biografia</h1> 
    <hr />
</div> 	
<div class="col-sm-3">
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

<div class="col-sm-9">
<div class="row">
<dl class="dl-horizontal">
  <dt>Legislaturas</dt>
  <dd><?php echo $vereadorLinha->legislatura ?></dd>
</dl>
<dl class="dl-horizontal">
  <dt>História</dt>
  <dd><?php echo $vereadorLinha->biografia ?></dd>
</dl>
</div>
</div>
</div>
</div>
<br />
</div>
</div>