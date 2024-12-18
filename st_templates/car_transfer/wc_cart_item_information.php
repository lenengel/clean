<?php
    /**
     * Created by PhpStorm.
     * User: MSI
     * Date: 02/06/2015
     * Time: 3:32 CH
     */

    $selected_equipments = $selected_extras = array();
    if ( !empty( $st_booking_data[ 'data_equipment' ] ) ) {
        $selected_equipments = $st_booking_data[ 'data_equipment' ];
    }
    if ( !empty( $st_booking_data[ 'extras' ] ) ) {
        $selected_extras = $st_booking_data[ 'extras' ];
    }

    $pick_up_date  = $st_booking_data[ 'check_in_timestamp' ];
    $drop_off_date = $st_booking_data[ 'check_out_timestamp' ];
    $passenger = $st_booking_data[ 'passenger' ];
    $format        = TravelHelper::getDateFormat();
    $div_id        = "st_cart_item" . md5( json_encode( $st_booking_data[ 'cart_item_key' ] ) );
?>
<p class="booking-item-description">
    <?php echo __( 'Date:', 'traveler' ); ?> <?php echo date_i18n( $format . ' H:i A', $pick_up_date );
        if(!empty($st_booking_data['roundtrip']) && $st_booking_data['roundtrip'] === 'yes'){
            echo ' ('.esc_html__('Return','traveler').')';
        }
    ?>
    <br/>
    <?php echo __( 'Transfer:', 'traveler' ); ?>
    <?php if ( !empty( $st_booking_data[ 'pick_up' ] ) && !empty( $st_booking_data[ 'drop_off' ] ) ): ?>
        <?php echo esc_html($st_booking_data[ 'pick_up' ]); ?>
		-
		<?php echo esc_html($st_booking_data[ 'drop_off' ]); ?>
    <?php else: ?>
        <?php echo __( 'None', 'traveler' ); ?>
    <?php endif; ?>
	<br/>
	<?php echo __( 'Distance:', 'traveler' ); ?>
	<?php
        if ( !empty( $st_booking_data[ 'distance' ] ) ):
            $time   = $st_booking_data[ 'distance' ];
            $hour   = ( $time[ 'hour' ] >= 2 ) ? $time[ 'hour' ] . ' ' . esc_html__( 'hours', 'traveler' ) : $time[ 'hour' ] . ' ' . esc_html__( 'hour', 'traveler' );
            $minute = ( $time[ 'minute' ] >= 2 ) ? $time[ 'minute' ] . ' ' . esc_html__( 'minutes', 'traveler' ) : $time[ 'minute' ] . ' ' . esc_html__( 'minute', 'traveler' );
            echo esc_attr( $hour ) . ' ' . esc_attr( $minute ) . ' - ' . esc_html($time[ 'distance' ]) . __( 'Km', 'traveler' );
        endif;
    ?>
</p>

<?php
	$class          = '';
	$class_collapse = '';
	$id_collapse    = '';
	if ( apply_filters( 'st_woo_cart_is_collapse', false ) ) {
		$class          = 'collapse';
		$class_collapse = 'collapseBookingDetail';
		$id_collapse    = 'collapse_' . md5( json_encode( $st_booking_data['cart_item_key'] ) );
	}
?>

<div id="<?php echo esc_attr( $div_id ); ?>" >
	<p class="accordion-button collapsed <?= esc_attr( $class_collapse ) ?>"
		data-bs-toggle="collapse"
		data-bs-target="#<?= esc_attr( $id_collapse ) ?>"
		aria-expanded="true"
		aria-controls="<?= esc_attr( $id_collapse ) ?>"
	>
		<a data-toggle="collapse" href="#<?= esc_attr( $id_collapse ) ?>" aria-expanded="true">
			<?php echo __( 'Booking Details', 'traveler' ); ?>
		</a>
	</p>

	<div id="<?= esc_attr( $id_collapse ) ?>"
		class="accordion-collapse <?= esc_attr( $class ) ?>"
	>
		<div class="cart_item_group" style='margin-bottom: 10px'>
			<?php
			$price_type = get_post_meta( $st_booking_data['car_id'], 'price_type', true );
			$price_unit = '';
			switch ($price_type) {
				case 'distance':
					$price_unit = __(' Per Km', 'traveler');
					break;
				case 'passenger':
					$price_unit = __(' Per Person', 'traveler');
					break;
				case 'fixed':
					$price_unit = __('', 'traveler');
					break;
			}
			?>

			<p class="booking-item-description">
				<b><?php echo __( "Direction Price", 'traveler' ) . '(' . esc_html($time[ 'distance' ]) . __( 'Km', 'traveler' ) . ')'; ?></b>
				:
				<?php echo TravelHelper::format_money($st_booking_data['price']). $price_unit ?>
			</p>
		</div>

		<?php if ( !empty( $st_booking_data['has_return'] ) ) : ?>
		<div class="cart_item_group" style='margin-bottom: 10px'>
			<p class="booking-item-description">
				<b><?php echo __( "Towards Price", 'traveler' ) . '(' . esc_html($time[ 'distance_return' ]) . __( 'Km', 'traveler' ) . ')'; ?></b>
				:
				<?php echo TravelHelper::format_money($st_booking_data['price_return']) . $price_unit ?>
			</p>
		</div>
		<?php endif; ?>

		<div class="cart_item_group" style='margin-bottom: 10px'>
			<p class="booking-item-description">
				<?php
					if ( isset( $selected_equipments ) and $selected_equipments and !empty( $selected_equipments ) ) {
						echo "<b class='booking-cart-item-title'>" . __( 'Equipment(s):', 'traveler' ) . "</b>";
						echo "</br>";
						foreach ( $selected_equipments as $key => $data ) {
							$number_item = (int)$data->number_item;
							if ( $number_item < 2 ) {
								$number_item = 1;
							}
							$price_unit      = $data->price_unit;
							$price_unit_html = '';
							switch ( $price_unit ) {
								case "per_hour":
									$price_unit_html = __( '/hour', 'traveler' );
									break;
								case "per_day":
									$price_unit_html = __( '/day', 'traveler' );
									break;
								default:
									$price_unit_html = '';
									break;
							}
							echo "&nbsp;&nbsp;&nbsp;- " . esc_html($data->title) . ": " . TravelHelper::format_money( $data->price ) . esc_html($price_unit_html) . " (x" . esc_html($number_item) . ")" . " <br>";

						}
						echo "";
					}
				?>
			</p>
			<p class="booking-item-description">
				<?php
					if ( isset( $selected_extras ) and $selected_extras and !empty( $selected_extras ) ) {
						echo "<b class='booking-cart-item-title'>" . __( 'Extras(s):', 'traveler' ) . "</b>";
						echo "</br>";
						foreach ( $selected_extras as $key => $data ) {
							echo "&nbsp;&nbsp;&nbsp;- " . esc_html($data["title"]) . ": " . TravelHelper::format_money( $data["price"] ) ." (x" . esc_html($data["number"]) . ")" . " <br>";
						}
						echo "</br>";
					}
				?>
				<?php
					if ( isset($passenger ) and ($passenger > 0) ) {
						echo __( 'Passenger(s) : ', 'traveler' ) . "&nbsp;&nbsp;&nbsp;" . esc_html($passenger);
						echo "<br>";
					}
				?>
			</p>
		</div>
		<div class="cart_item_group" style='margin-bottom: 10px'>
			<?php
				$discount = $st_booking_data[ 'discount_rate' ];
				if ( !empty( $discount ) ) { ?>
					<b class='booking-cart-item-title'><?php echo __( "Discount", 'traveler' ); ?>: </b>
					<?php echo esc_attr( $discount ) . "%" ?>
				<?php }
			?>
		</div>
		<div class="cart_item_group" style='margin-bottom: 10px'>
			<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) {
				$wp_cart = WC()->cart->cart_contents;
				$item    = $wp_cart[ $st_booking_data[ 'cart_item_key' ] ];
				$tax     = $item[ 'line_tax' ];
				if ( !empty( $tax ) ) { ?>
					<b class='booking-cart-item-title'><?php echo __( "Tax", 'traveler' ); ?>: </b>
					<?php echo TravelHelper::format_money( $tax ); ?>
				<?php }
			} else {
				$tax = 0;
			}
			?>
		</div>
		<div class="cart_item_group" style='margin-bottom: 10px'>
			<b class='booking-cart-item-title'><?php echo __( "Total amount", 'traveler' ); ?>:</b>
			<?php echo TravelHelper::format_money( $st_booking_data[ 'price_with_tax' ] + $tax ) ?>
		</div>
	</div>
</div>