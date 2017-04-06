<div class=page-header">
    <h1>Ordem do dia</h1> 
    <p>Acompanhe o que será pauta nas sessões plenárias</p>
</div>    

<div class="row">
	<div class="col-md-11 col-md-offset-1">
		<h4>Ordem do dia: <?php echo date('d/m/Y') ?></h4>
		<br />
		<table class="table table-responsive">
			<thead>
				<tr>
					<th>Data <br />  Início | Término</th>
					<th>Descrição</th>
					<th>Local</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($ordem as $lista): ?>
				<tr>
					<td><?php echo '<strong>'.arruma_data($lista->data).'</strong><br /> '.$lista->horaInicio.' | '.$lista->horaTermino; ?></td>
					<td><?php echo $lista->evento; ?></td>
					<td><?php echo $lista->local; ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" class="text-center"><small><b>Lista de ordem do dia</b></small></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>