<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
?>

<div class="row">
	<div class="col-md-9">
	<div class="row">
		<div class="col-sm-12">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Notícia</a></li>
    <li role="presentation" ><a href="#social" aria-controls="social" role="tab" data-toggle="tab">Redes Sociais</a></li>
    <li role="presentation" ><a href="#aovivo" aria-controls="aovivo" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-facetime-video"></span> TV Câmara</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home" >
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  	<?php
  	$active = 1;
	foreach($noticia as $news): 	 ?>
    <div class="item <?php echo ($active == 1) ? 'active' : '' ?>">
      <a href="<?php echo base_url('noticias/acesso/' . strtolower($news->slug)); ?>">
      <img src="<?php echo base_url('uploads/noticias/'.$news->url) ?>" alt="Câmara de coelho neto, MA" ></a>
  <div class="carousel-caption">
    <h4><?php echo $news -> titulo; ?></h4>
    <p><?php echo word_limiter($news -> resumo,20); ?></p>
    </div>
    </div>
    <?php $active++;

		endforeach;
 ?>

  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Próximo</span>
  </a>
</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="social">
    	<p>Siga-nos em nossas redes socias. Fique atualizado sobre tudo que acontece na câmara municipal de Coelho Neto (MA).</p><br />
<div class="row">
<div class="col-md-1 col-md-offset-4 thumbnail">
	<a href="#">
	<img class="" src="<?php echo base_url('images/social-facebook.png') ?>" />
	</a>
</div>
<div class="col-md-1 thumbnail">
	<a href="#">
	<img class="" src="<?php echo base_url('images/social-instagram.png') ?>" />
	</a>
</div>
<div class="col-md-1 thumbnail">
	<a href="#">
	<img class="" src="<?php echo base_url('images/social-twitter.png') ?>" />
	</a>
</div>
<div class="col-md-1 thumbnail">
	<a href="#">
	<img class="" src="<?php echo base_url('images/social-youtube.png') ?>" />
	</a>
</div>
</div>
    </div>
    <div class="tab-pane" role="tabpanel" id="aovivo">
    	<h4>VEJA AO VIVO</h4>
    	
    </div>
  </div>
	</div>
	</div>
</div>

<div class="col-md-3">
<div class="row agenda">
<div class="col-sm-12">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><span class="glyphicon glyphicon-calendar"></span> Agenda </h3>
  </div>
  <div class="panel-body">
      <?php foreach ($agenda as $itemAgenda) : ?>
  	<div class="row">
		<div class="col-md-12 hora">
			<h2><?php print arruma_hora($itemAgenda -> horaInicio) . ' - ' . arruma_hora($itemAgenda -> horaTermino); ?></h2>
                        <h2 style="font-size: 0.9em; margin-top: -11px"><?php print arruma_data($itemAgenda -> data); ?></h2>
		</div>
		<div class="col-md-12 evento">
			<p><?php print $itemAgenda -> evento; ?></p>
		</div>
	</div>
      <?php endforeach; ?>
    <div class="row">
    <div class="col-sm-12">
	<a href="<?php echo base_url('agenda') ?>" class="btn btn-primary">
		<span class="glyphicon glyphicon-triangle-right"></span> Veja Mais</a>
  </div>
  </div>
  </div>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6 col-sm-6">
<div class="row news">
<div class="col-sm-12">
	<h3>Últimas Noticias</h3>
<dl>
<?php foreach($noticiasmais as $mais): ?>
  <dt><span class="glyphicon glyphicon-chevron-right"></span> <?php echo arruma_data($mais -> data_postagem); ?> - <?php echo word_limiter($mais -> titulo, 7); ?></dt>
  <dd><a href="<?php echo base_url('noticias/acesso/' . strtolower($mais -> slug)); ?>"><?php echo word_limiter($mais -> resumo, 18); ?></a></dd>
  <?php endforeach; ?>
</dl>
</div>
</div>

<div class="row">	
	<div class="col-sm-12">
	<h3>Vereadores</h3>
	<?php foreach ($vereador as $value): ?>
	<div class="col-sm-4 col-xs-6">			
			<a class="thumbnail" href="<?php echo base_url('vereador/dados_e_contatos/' . codificarString($value -> id)); ?>">
			<img src="<?php echo base_url('uploads/biografias/'.$value->imagem)  ?>" alt="<?php echo $value -> nome; ?>">
			</a>			
			</div>
	<?php endforeach; ?>
</div>
</div>
</div>

<div class="col-sm-6 col-md-6">
	<div class="row">
	<div class="col-sm-12">
			<h3>Fale com a Câmara</h3>
	<form class="form-horizontal">				
	<div class="form-group">
    <label class="col-sm-3 control-label">Nome</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="" placeholder="Nome">
    </div>
  </div>	
  
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="" placeholder="Email">
    </div>
  </div>
  
  <div class="form-group">
  	<label for="inputEmail3" class="col-sm-3 control-label">Mensagem</label>
    <div class="col-sm-9">    	
     		<textarea class="form-control" placeholder="Digite sua mensagem">&nbsp;</textarea>
    </div>
  </div>
  
<div class="form-group">	
    <div class="col-sm-9 col-sm-offset-3">
      <button type="submit" class="btn btn-default">Enviar</button>
    </div>
  </div>
  
</form>
</div>
</div>
</div>
</div>

