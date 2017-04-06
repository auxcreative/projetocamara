<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');?>
<div class="row">
	<div class="col-md-9">
	<div class="row">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Notícia</a></li>
    <li role="presentation"><a href="#plenario" aria-controls="plenario" role="tab" data-toggle="tab">Plenário</a></li>
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
      <img src="<?php echo base_url('uploads/noticias/'.$news->url) ?>" alt="Câmara de coelho neto, MA" >
  <div class="carousel-caption">
    <h4><?php echo $news->titulo; ?></h4>
    <p><?php echo $news->resumo; ?></p>
  </div>
    </div>
    <?php $active++; endforeach; ?>
      
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
    <div role="tabpanel" class="tab-pane" id="plenario">
    	<p>É o órgão deliberativo e soberano da Câmara constituído pela reunião dos 
    		vereadores no exercício de suas atribuições, detentor de atribuições deliberativas e legislativas. 
    		Os trabalhos da Câmara desenvolvem-se no período de quatro anos chamado Legislatura, 
    		composto de quatro sessões legislativas anuais. Cada sessão legislativa anual (ou ordinária) é 
    		interrompida durante os períodos de recesso, 
    		conforme disposto na Lei Orgânica do Município e no Regimento Interno.
    	</p>
   <blockquote class="blockquote-reverse">
  <p>Veja mais sobre o funcionamento do plenário </p>
  <footer>Clique abaixo e conheça</footer>
	</blockquote>

<ul class="list-unstyled pull-right">
  <li><a href="<?php base_url('plenario/ordem_do_dia') ?>"><span class="glyphicon glyphicon-triangle-right"></span> Ordem do dia</a></li>
  <li><a href="<?php base_url('plenario/atas_das_sessoes') ?>"><span class="glyphicon glyphicon-triangle-right"></span> Atas das sessões plenárias</a></li>
  <li><a href="<?php base_url('plenario/videos_das_sessoes') ?>"><span class="glyphicon glyphicon-triangle-right"></span> Vídeos das sessões plenárias</a></li>
</ul>
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
<div class="col-md-3">
<div class="row agenda">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><span class="glyphicon glyphicon-calendar"></span> Agenda Semanal</h3>
  </div>
  <div class="panel-body">
      <?php foreach ($agenda as $itemAgenda) : ?>
  	<div class="row">
		<div class="col-md-12 hora">
			<h2><?php print arruma_hora($itemAgenda->horaInicio).' - '.arruma_hora($itemAgenda->horaTermino); ?></h2>
                        <h2 style="font-size: 0.9em; margin-top: -11px"><?php print arruma_data($itemAgenda->data); ?></h2>
		</div>
		<div class="col-md-12 evento">
			<p><?php print $itemAgenda->evento; ?></p>
		</div>
	</div>
      <?php endforeach; ?>
	<a href="<?php echo base_url('agenda') ?>" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-right"></span> Agenda Completa</a>
  </div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-5">
		<div class="row news">
			<h3>Últimas Noticias</h3>
<dl>
<?php foreach($noticiasmais as $mais): ?>
  <dt><span class="glyphicon glyphicon-chevron-right"></span> <?php echo arruma_data($mais->data_postagem); ?> - <?php echo word_limiter($mais->titulo,4); ?></dt>
  <dd><a href="<?php echo base_url('noticias/acesso/'.strtolower($mais->slug)); ?>"><?php echo word_limiter($mais->resumo,12); ?></a></dd>
  <?php endforeach; ?>

  
</dl>
		</div>
</div>
<div class="col-md-3">
	<h3>Saiba Mais</h3>
<div class="row">
<div class="plano-diretor thumbnail">
			<a href="<?php echo base_url('noticias/destaque/') ?>"><span class="glyphicon glyphicon-chevron-right"> Acesse</span></a>
			<img src="<?php echo base_url('images/plano-diretor.jpg') ?>" />
	</div>
	</div>
</div>
<div class="col-md-4">
	<h3>Fique por Dentro</h3>
	
<ul class="list-unstyled">
  <li><a href="<?php base_url('plenario/ordem_do_dia') ?>"><span class="glyphicon glyphicon-list-alt"></span> Ordem do dia</a></li>
  <li><a href="<?php base_url('plenario/prejetos_de_lei_proposicoes') ?>"><span class="glyphicon glyphicon-duplicate"></span> Projetos de Lei e Proposições</a></li>
  <li><a href="<?php base_url('plenario/legislacao') ?>"><span class="glyphicon glyphicon-book"></span> Legislação </a></li>
  <li><a href="<?php base_url('plenario/lei_de_acesso_a_informacao') ?>"><span class="glyphicon glyphicon-info-sign"></span> Lei de Acesso a informação </a></li>
 
  <li><a href="<?php base_url('plenario/orcamento_municipal') ?>"><span class="glyphicon glyphicon-usd"></span> Orçamento Municipal</a></li>
  <li><a href="<?php base_url('plenario/prejetos_de_lei_proposicoes') ?>"><span class="glyphicon glyphicon-duplicate"></span> Projetos de Lei e Proposições</a></li>
  <li><a href="<?php base_url('plenario/legislacao') ?>"><span class="glyphicon glyphicon-book"></span> Legislação </a></li>
  <li><a href="<?php base_url('plenario/lei_de_acesso_a_informacao') ?>"><span class="glyphicon glyphicon-info-sign"></span> Lei de Acesso a informação </a></li>
	

</ul>	
	
	
	
	<!--<form action="" method="post" >
	<div class="form-group">
		<input type="text" id="nome" class="form-control" name="nome" placeholder="Seu nome" value="" />
	</div>		
	<div class="form-group">
		<input type="text" id="contato" class="form-control" name="contato" placeholder="Email ou Telefone" value="" />
	</div>
		<div class="form-group">
		<textarea id="assunto" class="form-control" name="assunto" placeholder="Digite o seu assunto" value=""></textarea>
	</div>
	</form>-->
	</div>
	<!--	<div class="row breaking-news thumbnail">
			<h3>Últimas noticias</h3>
			<a href="<?php echo base_url('noticias/destaque/') ?>"><p>Título da matéria sobre a imagem com alinhamento à esquerda.</p></a>
			<img src="<?php echo base_url('uploads/noticias/rodoviaria.jpg') ?>" />
	</div> -->
</div>

