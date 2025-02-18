<?php

if (!isset($data['id'])) {
    include(__DIR__ . DS . 'empty_field_vals.php');
}

if(!isset($data['input_class'])){
	$data['input_class'] = '';
}

if(isset($data['params']) and isset($data['params']['input_class'])) {
	$data['input_class'] = $data['params']['input_class'];
}

if (!isset($data['no-label'])) {
    $show_label = false;
} else {
    $show_label = true;
}

$is_required = (isset($data['options']) == true and is_array($data['options']) and in_array('required', $data['options']) == true);
$skips = array();
if (isset($params['skip-fields']) and $params['skip-fields'] != '') {
    $skips = explode(',', $params['skip-fields']);
    $skips = array_trim($skips);
}

if ($data['values'] == false or !is_array($data['values']) or !is_array($data['values'][0])) {
    $default_data = array('country' => 'Country', 'city' => 'City', 'zip' => 'Zip/Post code', 'state' => 'State/Province', 'address' => 'Address');
    $data['values'] = $default_data;
}

$defaults = array(
    'country' => _e('Country', true),
    'city' => _e('City', true),
    'address' => _e('Address', true),
    'state' => _e('State/Province', true),
    'zip' => _e('Zip/Postal Code', true)
);
if (!isset($data['options']) or !is_array($data['options']) or empty($data['options'])) {
    $data['options'] = $defaults;
}
?>

<?php if (is_array($data['values'])) : ?>

    <div>
        <?php if (isset($data['name']) == true and $data['name'] != ''): ?>
            <?php if ($show_label): ?>
                <label class="mw-ui-label mw-address-label"><?php _e($data['name']) ?>
                
                <?php if (isset($data['options']) == true && in_array('required', $data['options'])): ?>  
					<span style="color:red;">*</span>
					<?php endif; ?>
                
                </label>
            <?php endif; ?>
        <?php elseif (isset($data['name']) == true and $data['name'] != ''): ?>
        <?php else : ?>
        <?php endif; ?>
        <?php if (isset($data['help']) == true and $data['help'] != ''): ?>
            <small class="mw-ui-label"><?php print $data['help'] ?></small>
        <?php endif; ?>
        <?php foreach ($data['values'] as $k => $v): ?>
            <?php if (!in_array($k, $skips))  : ?>
                <?php if (is_string($v)) {
                    $kv = $v;
                } elseif (is_array($v)) {
                    $kv = $v[0];
                } else {
                    $kv = $k;
                }
                if ($kv == '') {
                    $kv = ucwords($k);
                }
                ?>
                <div class="mw-ui-field-holder control-group form-group">
                    <label class="mw-ui-label mw-ui-label-address-custom-field"><?php _e($kv); ?>
                    
                    <?php if (isset($data['options']) == true && in_array('required', $data['options'])): ?>  
					<span style="color:red;">*</span>
					<?php endif; ?>
                    
                    </label>

                    <?php if ($k == 'country')  : ?>
                        <?php $countries_all = mw()->forms_manager->countries_list(); ?>
                        <?php if ($countries_all) { ?>

                            <select name="<?php print $data['name'] ?>[country]" class="mw-ui-field field-full form-control">
                                <option value=""><?php _e('Choose country') ?></option>
                                <?php foreach ($countries_all as $country): ?>
                                    <option value="<?php print $country ?>"><?php print $country ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php } else { ?>

                            <input type="text" class="<?php print $data['input_class']; ?>" name="<?php print $data['name'] ?>[<?php print ($k); ?>]" <?php if ($is_required) { ?> required <?php } ?> data-custom-field-id="<?php print $data["id"]; ?>"/>
                        <?php } ?>


                    <?php else: ?>

                        <input type="text" class="<?php print $data['input_class']; ?>"
                               name="<?php print $data['name'] ?>[<?php print ($k); ?>]" <?php if ($is_required) { ?> required <?php } ?>
                               data-custom-field-id="<?php print $data["id"]; ?>"/>


                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
