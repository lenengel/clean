<?php
wp_enqueue_style('select2.min');
wp_enqueue_script('select2.full.min');
$data = TravelHelper::transferDestinationOptionNewFronend();
$old_data_from = STInput::get('transfer_from','');
$old_data_to = STInput::get('transfer_to','');

$enable_tree = st()->get_option('bc_show_location_tree', 'off');

$transfer_from_id = STInput::request('transfer_from', '');
if (!empty($transfer_from_id)) {
    $location_name = get_the_title($transfer_from_id);
} else {
    $location_name = __('Pick-up From','traveler');
}

$transfer_to_id = STInput::request('transfer_to', '');
if (!empty($transfer_to_id)) {
    $location_name_dropoff = get_the_title($transfer_to_id);
} else {
    $location_name_dropoff = __('Pick-off To','traveler');
}

if ($enable_tree == 'on') {
    $lists = TravelHelper::getListFullNameLocation('st_cars');
    $locations = TravelHelper::buildTreeHasSort($lists);
} else {
    $locations = TravelHelper::getListFullNameLocation('st_cars');
}
$has_icon = (isset($has_icon)) ? $has_icon : false;
?>

<div class="st-location-sidebar form-group form-extra-field dropdown clearfix field-detination field-destination-car field-destination-carstranfer destination-pickup-carstranfer <?php if ($has_icon) echo 'has-icon' ?>">
    <div class="date-wrapper destination-pickup">
        <div class="dropdown" data-bs-toggle="dropdown" id="dropdown-pickup">
            <label><?php echo __('Pick-up From', 'traveler'); ?></label>
        </div>
        
        <select class="selectpicker transfer-selectpicker" name="transfer_from"  id="transfer_from">
            <?php foreach ( $data as $point ):?>
                <option <?php selected( $old_data_from, $point['value'] ) ?> data-tokens="<?php echo esc_attr( strtolower( $point['label'] ) ); ?>"
                    value="<?php echo esc_attr( $point['value'] ); ?>">
                <?php echo esc_attr( $point['label'] ); ?>
            </option>
            <?php endforeach;?>
        </select>
        
        
    </div>
</div>

