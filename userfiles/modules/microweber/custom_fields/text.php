<?php

$is_required = (isset($data['options']) == true and isset($data['options']["required"]) == true);

if(!isset($data['input_class'])){
	$data['input_class'] = '';
}

if(isset($data['params']) and isset($data['params']['input_class'])) {
	$data['input_class'] = $data['params']['input_class'];
}
?>

<div class="control-group form-group">
    <label class="mw-ui-label">
        <?php if (isset($data['name']) == true and $data['name'] != ''): ?>
            <?php print ucwords(str_replace('_', ' ', $data['name'])); ?>
        <?php elseif (isset($data['name']) == true and $data['name'] != ''): ?>
            <?php print $data['name'] ?>
        <?php else : ?>
        <?php endif; ?>
        <?php if (isset($data['options']) == true and isset($data['options']["required"]) == true): ?>  
        <span style="color:red;">*</span>
        <?php endif; ?>
    </label>
    <?php if (isset($data['help']) == true and $data['help'] != ''): ?>
        <small class="mw-custom-field-help"><?php print $data['help'] ?></small>
    <?php endif; ?>
    <?php if (isset($data['options']) == true and isset($data['options']["as_text_area"]) == true): ?>
        <div class="controls">
            <textarea <?php if ($is_required): ?> required="true"  <?php endif; ?> class="<?php print $data['input_class']; ?> mw-ui-field" data-custom-field-id="<?php print $data["id"]; ?>" name="<?php print $data["name"]; ?>"
                                                                                   placeholder="<?php print $data["value"]; ?>"></textarea>
        </div>
    <?php else : ?>
        <div class="controls">
            <input type="text" <?php if ($is_required): ?> required="true"  <?php endif; ?> class="<?php print $data['input_class']; ?> mw-ui-field" data-custom-field-id="<?php print $data["id"]; ?>" name="<?php print $data["name"]; ?>"
                   placeholder="<?php print $data["value"]; ?>"/>
        </div>
    <?php endif; ?>
</div>
