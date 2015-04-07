<form id="sp_product_form" method="post" action="<?php echo "$this->page_url&action=$this->_action&post=$this->_post_id"; ?>">

	<input type="hidden" id="post_id" name="post_id" value="<?php echo $model->data['post_id']; ?>" />

	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="post_title"><?php echo __('Product','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="text" class="widefat" id="post_title" name="post_title" value="<?php echo $model->data['post_title']; ?>"/>
				</td>
			</tr>
			<tr>
				<th>
					<label for="post_content"><?php echo __('Description','stuffed-pepper'); ?></label>
				</th>
				<td>
					<textarea class="widefat" id="post_content" name="post_content"><?php echo $model->data['post_content']; ?></textarea>
				</td>
			</tr>
			<tr>
				<th>
					<label for="type"><?php echo __('Type','stuffed-pepper'); ?></label>
				</th>
				<td>
					<select id="type" name="type"><?php
						foreach ( $this->types as $type )
							echo '<option '.($model->data['type'] == $type ? 'selected' : '').' value="'.$type.'">'.$type.'</option>';?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="format"><?php echo __('Format','stuffed-pepper'); ?></label>
				</th>
				<td>
					<select id="format" name="format"><?php
						foreach ( $this->formats as $format )
							echo '<option '.($model->data['format'] == $format ? 'selected' : '').' value="'.$format.'">'.$format.'</option>';?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="price"><?php echo __('Price','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="text" id="price" name="price" value="<?php echo $model->data['price']; ?>"/>
				</td>
			</tr>
			<tr>
				<th>
					<label for="paypal"><?php echo __('PayPal','stuffed-pepper'); ?></label>
				</th>
				<td>
					<select id="paypal" name="paypal"><?php
						foreach( $model->data['paypals'] as $key => $value ){
							$selected = $key == $model->data['paypal'] ? ' selected ' : '';
							echo '<option '. $selected .'value="'.$key.'">'. $value .'</option>';
						}?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="mailchimp"><?php echo __('MailChimp','stuffed-pepper'); ?></label>
				</th>
				<td>
					<select id="mailchimp" name="mailchimp"><?php
						foreach( $model->data['mailchimps'] as $key => $value ){
							$selected = $key == $model->data['mailchimp'] ? ' selected ' : '';
							echo '<option '. $selected .'value="'.$key.'">'. $value .'</option>';
						}?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="pdf"><?php echo __('PDF','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="text" class="widefat" id="pdf" name="pdf" value="<?php echo $model->data['pdf']; ?>"/>
				</td>
			</tr>
			<tr>
				<th>
					<label for="coupon"><?php echo __('Coupon','stuffed-pepper'); ?></label>
				</th>
				<td id="coupons">
					<ul><?php
						$coupons = $model->data['coupon'];

						if( count( $coupons ) == 0 )
							$coupons[] = '';
						$more = '';
						foreach( $coupons as $coupon ) {?>
							<li class="coupon  <?php echo $more; ?>">
								<select class="coupon" id="coupon-0" name="coupon[]"><?php
									foreach( $model->data['coupons'] as $key => $value ){
										$selected = $key == $coupon ? ' selected ' : '';
										echo '<option '. $selected .'value="'.$key.'">'. $value .'</option>';
									}?>
								</select>
								<a href="#" class="add-coupon">Add</a>
								<a href="#" class="del-coupon">Delete</a>
							</li><?php
							$more = ' more ';
						}?>
					</ul>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td><?php submit_button( 'Save' ); ?><a href="<?php echo $this->page_url; ?>">Done</a></td>
			</tr>
		</tbody>
	</table>
</form>