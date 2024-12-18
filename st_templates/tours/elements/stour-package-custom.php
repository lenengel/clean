<?php
$tour_package_custom = get_post_meta($post_id, 'tour_packages_custom', true);
?>
<div class="custom-hotel-data-item">
    <table class="wp-list-table widefat fixed striped stour-list-custom-hotel" data-type="hotel">
        <thead>
        <tr>
            <td class="manage-column column-cb check-column"></td>
            <td><?php echo __('Hotel name', 'traveler'); ?></td>
            <td><?php echo __('Hotel star', 'traveler'); ?></td>
            <td><?php echo __('Hotel price', 'traveler'); ?></td>
        </tr>
        </thead>
        <tbody>
        <tr class="parent-row">
            <td>
                <a href="#del-item" class="hotel-del">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </td>
            <td data-name="<?php echo __('Hotel name', 'traveler'); ?>"><input type="text" class="hotel-name" value=""/></td>
            <td data-name="<?php echo __('Hotel star', 'traveler'); ?>">
				<select class="hotel-star">
					<option value="1"><?php echo __('1', 'traveler'); ?></option>
					<option value="2"><?php echo __('2', 'traveler'); ?></option>
					<option value="3"><?php echo __('3', 'traveler'); ?></option>
					<option value="4"><?php echo __('4', 'traveler'); ?></option>
					<option value="5"><?php echo __('5', 'traveler'); ?></option>
				</select>
			</td>
            <td data-name="<?php echo __('Hotel price', 'traveler'); ?>"><input type="text" class="hotel-price" value=""/></td>
        </tr>
        <?php
        if(is_object($tour_package_custom)) {
            if (!empty((array)$tour_package_custom)) {
                foreach ($tour_package_custom as $k => $v) {
                    ?>
                    <tr>
                        <td>
                            <a href="#del-item" class="hotel-del">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td data-name="<?php echo __('Hotel name', 'traveler'); ?>"><input type="text" class="hotel-name" value="<?php echo esc_html($v->hotel_name); ?>"/></td>
                        <td data-name="<?php echo __('Hotel star', 'traveler'); ?>">
							<select class="hotel-star">
								<option value="1" <?php selected( $v->hotel_star, 1 ); ?>><?php echo __('1', 'traveler'); ?></option>
								<option value="2" <?php selected( $v->hotel_star, 2 ); ?>><?php echo __('2', 'traveler'); ?></option>
								<option value="3" <?php selected( $v->hotel_star, 3 ); ?>><?php echo __('3', 'traveler'); ?></option>
								<option value="4" <?php selected( $v->hotel_star, 4 ); ?>><?php echo __('4', 'traveler'); ?></option>
								<option value="5" <?php selected( $v->hotel_star, 5 ); ?>><?php echo __('5', 'traveler'); ?></option>
							</select>
						</td>
                        <td data-name="<?php echo __('Hotel price', 'traveler'); ?>"><input type="text" class="hotel-price" value="<?php echo esc_html($v->hotel_price); ?>"/></td>
                    </tr>
                    <?php
                }
            }
        }
        ?>
        </tbody>
    </table>
    <input type="submit" class="option-tree-ui-button button button-primary btn-add-custom-package btn btn-primary btn-sm"
           value="<?php echo __('Add new', 'traveler'); ?>">
</div>
