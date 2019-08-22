<?php if ($settings['multiple']): ?>
<script type="text/javascript">
mw.lib.require('chosen');
</script>
<script type="text/javascript">
$(document).ready(function () {
	$(".js-mw-select-<?php echo $data['id']; ?>").chosen({width:'100%'}); 
});
</script>
<?php endif; ?>

<div class="mw-ui-field-holder">
	<label class="mw-ui-label"> 
	<?php echo $data['name']; ?>
	<?php if ($settings['required']): ?>
	<span style="color: red;">*</span>
	<?php endif; ?>
	</label>
	 <?php if ($data['help']): ?>
        <small class="mw-custom-field-help"><?php echo $data['help']; ?></small>
    <?php endif; ?>
	<div class="mw-ui-controls">
		<select <?php if ($settings['multiple']): ?>multiple="multiple"<?php endif; ?> class="mw-ui-field <?php echo $settings['class']; ?> js-mw-select-<?php echo $data['id']; ?>" <?php if ($settings['required']): ?>required<?php endif; ?> data-custom-field-id="<?php echo $data['id']; ?>" name="<?php echo $data['name']; ?>" />
			
			<?php foreach($data['values'] as $key=>$value): ?>
		    <option data-custom-field-id="<?php print $data["id"]; ?>" value="<?php echo $key; ?>">
		   		<?php echo $value; ?>
			</option>
		    <?php endforeach; ?>
			
		</select>
	</div>
</div>
