<style>
	form div.joe {float:left; clear:none;}
	form div.adjz {float:left; clear:none;}
</style>
<h2>StringKey</h2>
<?php echo $this->Html->link('Back to String Keys', array('controller'=>'/localized_strings/', 'action'=>'index'), array()); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<br/><br/>
<?php echo $this->Form->create('StringKey'); ?>
	<?php if (isset($this->data["StringKey"])) {echo $this->Form->hidden('id', array('value'=>$this->data["StringKey"]["id"])); }?>
	<?php echo $this->Form->input('string_key'); ?>
	<?php echo $this->Form->input('LocalizedString.text', array('value'=>$this->data["LocalizedString"][0]['text'])); ?>
	<?php echo $this->Form->submit(); ?>
<?php echo $this->Form->end(); ?>