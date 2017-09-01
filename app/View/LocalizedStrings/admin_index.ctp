<h2>Localized Strings</h2>
<?php echo $this->Html->link('add string', array('controller'=>'/localized_strings/', 'action'=>'admin_edit'), array()); ?>
<table>
	<thead>
		<tr>
			<th width="70">
				Id
			</th>
			<th width="70">
				Key
			</th>
			<th>
				Text
			</th>
			<th width="70"></th>
			<th width="70"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($stringKeys as $stringKey) { ?>
		<?php foreach ($stringKey["LocalizedString"] as $localizedString) { ?>
			<tr>
				<td>
					<?php echo($stringKey["StringKey"]["id"]) ?>
				</td>
				<td>
					<?php echo($stringKey["StringKey"]["string_key"]) ?>
				</td>
				<td>
					<?php echo($localizedString["text"]) ?>
				</td>
				<td>
					<?php echo $this->Html->link('edit', array('controller'=>'/localized_strings/', 'action'=>'admin_edit', $stringKey["StringKey"]["id"])); ?>
				</td>
				<td>
					<?php echo $this->Html->link('delete', array('controller'=>'/localized_strings/', 'action'=>'admin_delete', $stringKey["StringKey"]["id"]), array(), __('Are you sure you want to delete', true)); ?>
				</td>
			</tr>
		<?php }} ?>
	</tbody>
</table>
