<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

$grupo = $this -> checkout -> get_grupo();
?>
<div class="container-fluid">	
<div class="col-md-8 produto">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
  	<?php foreach ($grupo->result() as $nav) { ?>
	<li role="presentation" class="<?php echo($nav->id == 1)? 'active' : '' ?>">
	<a href="<?php echo '#'.$nav->panel ?>" aria-controls="<?php echo $nav->panel ?>" role="tab" data-toggle="tab">
	<?php echo $nav->nome ?>
	</a>
	</li>	  
	<?php  } ?>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
  	<?php foreach($grupo->result() as $tab): 

  	?>
    <div role="tabpanel" class="tab-pane fade <?php echo($tab->id == 1)? 'in active' : '' ?>" id="<?php echo $tab->panel ?>">
    <div class="row">
    <div class="col-md-12">
    	<?php get_msg('msgok'); get_msg('msgerro'); ?>
    </div>    
    <?php    
    $produto = $this->checkout->get_produto($this->session->userdata('user_id_empresa'), $tab->id)->result();
	foreach($produto as $lista_produto){   
	$cor = explode('#', $tab->cor);
	$btn = $cor[0];	
	$borda = '#'.$cor[1];	
	?>
	
	<form method="post" action="<?php echo base_url('checkout/lanca_produto'); ?>">	 	
	<input type="hidden" name="id" value="<?php echo $lista_produto -> produto_id; ?>" />
	<input type="hidden" name="price" value="<?php echo $lista_produto->preco_venda ?>" />
	<input type="hidden" name="name" value="<?php echo $lista_produto->descricao ?>" />			
	
	<div class="col-md-3 tale" >
	<span class="badge"><?php echo $lista_produto->quantidade ?></span>	
	<div class="col-md-12  text-center imagem">
		<div class="col-md-7 col-md-offset-1 thumbnail">
			<img src="<?php echo base_url('uploads/produtos/' . $lista_produto -> thumblr); ?>" />
		</div>
	</div>
	<div class="col-md-12 descricao">
		<h5><?php echo $lista_produto -> descricao; ?></h5>
	</div>
	<div class="col-md-12 preco text-left">
		<h2>R$ <?php echo number_format($lista_produto->preco_venda,2,',','.') ?></h2>
	</div>
   <div class="col-md-10 quantidade">
   <div class="row">
	<div class="col-md-12">
    <div class="input-group">
     <select class="form-control float-left" name="qty">
      	<?php for ($i=1; $i <= 20 ; $i++): ?>
  		<option value="<?php echo $i; ?>"><?php echo $i ?></option>
  		<?php endfor; ?>
	</select>
            <span class="input-group-btn">
        <button class="btn btn-<?php echo $btn ?>" type="submit">
        	<span class="glyphicon glyphicon-shopping-cart"></span>
        </button>
      </span>
    </div>
  </div>
   </div>
   </div>
	</div>
	</form>
	<?php } ?>
	
	</div>
    </div>
    <?php endforeach; ?>

  </div>
</div>

<div class="col-md-4">
<div class="row">
	<div class="col-md-12 bobina"></div>
	<div class="col-md-12 subtotal">
		<input type="text" readonly="" name="subtotal" value="R$ <?php echo number_format($this -> cart -> total(), 2, ',', '.'); ?>" class="input-lg font-total text-center" id="subtotal" />
	</div>
	<div class="col-md-12 dados">
				<div class="col-md-12 tabela">
				<div class="row">
				<div class="col-md-12 text-center">
				<h4>CUPOM DE VENDA - <?php echo str_pad(get_num_venda(), 7, "0", STR_PAD_LEFT); ?></h4>
				</div>
				<table class="table table-hover">
					<thead>
					<tr>
					<th>Item</th>
					<th>&nbsp;</th>
					<th>Qtd x UN</th>
					<th>Descrição<br />
						Valor Unit.
					</th>
					<th>Total</th>
				</tr>
				</thead>
				<tbody>
					<?php $i = 1; 
					foreach($this->cart->contents() as $items): ?>
					<input type="hidden" name="<?php echo $i . '[rowid]'; ?>" value="<?php echo $items['rowid']; ?>" />
					<tr>
						
						<td class="item">
						<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></td>
						<td><a href="<?php echo base_url('checkout/remove/' . $items['rowid']); ?>" class="deletareg">
						<span class="glyphicon glyphicon-remove-sign"></span></a> </td>
						<td><?php echo $items['qty']; ?>xUN</td>
						<td><?php echo $items['name'] . '   / Valor Unit. R$ ' . number_format($items['price'], 2, ',', '.'); ?></td>
						<td class="text-right font-total"><?php echo number_format($items['subtotal'], 2, ',', '.'); ?></td>
					</tr>
					<?php $i++;
						endforeach;
 ?>
				</tbody>
				</table>				
			</div>
			</div>
		</div>
		<button type="button" class="btn btn-default btn-lg btn-block" <?php echo ($this->cart->total_items() == 0) ? 'disabled="disabled"' : '' ?> data-toggle="modal" data-target="#myModal">
			<span class="glyphicon glyphicon-shopping-cart"></span>
			<span class="badge"><?php echo $this -> cart -> total_items(); ?></span>
		</button>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
        	CUPOM <?php echo str_pad(get_num_venda(), 7, "0", STR_PAD_LEFT); ?>
        </h4>
      </div>
<form method="post" action="<?php echo base_url('checkout/finalizar')  ?>" class="form-horizontal">
<input type="hidden" name="code" value="<?php echo get_num_venda(); ?>" />
<input type="hidden" name="id_empresa" value="<?php echo $this->session->userdata('user_id_empresa'); ?>" />
<input type="hidden" name="id_cliente" value="1" />
<div class="modal-body">
	<div class="form-group">
		<div class="col-sm-12">
		<label class="radio-inline">
  		<input type="radio" name="id_forma_de_pagamento" class="formaPagamento" checked="" id="inlineRadio1" value="1"> Dinheiro
		</label>
		<label class="radio-inline">
  <input type="radio" name="id_forma_de_pagamento" class="formaPagamento" id="inlineRadio2" value="2"> C. Débito
</label>
<label class="radio-inline">
  <input type="radio" name="id_forma_de_pagamento" class="formaPagamento" id="inlineRadio3" value="3"> C. Crédito
</label>
	</div>
	</div>
  <div class="form-group">
  	<label class="col-sm-5 control-label">Total</label>
    <div class="col-sm-7">
      <input name="subtotal" type="text" disabled id="disabledInput" value="R$ <?php echo number_format($this -> cart -> total(), 2, ',', '.'); ?>" class="form-control input-lg text-center" id="subtotal">
    </div>
  </div>
  <div class="form-group recebido">  
  	<label class="col-sm-5 control-label">Recebido</label>  
    <div class="col-sm-7">    	
      <input type="text" name="pago" class="form-control valorFormato input-lg text-center" id="pago" autofocus="" value="R$ 0,00">
    </div>
  </div>
  <div class="form-group troco">  
  	<label class="col-sm-5 control-label">Troco</label>  
    <div class="col-sm-7">    	
      <input type="text" disabled="" class="form-control input-lg text-center valorFormato" id="troco" value="R$ 0,00">
    </div>
  </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-log-out"></span></button>
        <button type="button" class="btn btn-default cancel"><span class="glyphicon glyphicon-stop"></span></button>
        <button type="submit" class="btn btn-success pay">Finalizar Cupom</button>
      </div>
 </form>     
    </div>
  </div>
</div>		
		<div class="col-md-12 picote-final"></div>
</div>
</div>



