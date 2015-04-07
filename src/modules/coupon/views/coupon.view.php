<form id="coupon_form" name="coupon_form" method="post" action="<?php echo "$this->page_url&action=coupon_add"; ?>">

	<input type="hidden" id="post_id" name="post_id" value="<?php echo $model->data['post_id']; ?>" />

	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="code"><?php echo __('Code','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="text" id="code" name="code" value="<?php echo $model->data['code']; ?>"/>
				</td>
			</tr>
			<tr>
				<th>
					<label for="description"><?php echo __('Description','stuffed-pepper'); ?></label>
				</th>
				<td>
					<textarea class="widefat" id="description" name="description"><?php echo $model->data['description']; ?></textarea>
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
					<label for="amount_rate"><?php echo __('Discount Amount/Rate','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="text" id="amount_rate" name="amount_rate" value="<?php echo $model->data['amount_rate']; ?>"/>
				</td>
			</tr>
			<tr>
				<th>
					<label for="expiry_type"><?php echo __('Expiry Type','stuffed-pepper'); ?></label>
				</th>
				<td>
					<select id="expiry_type" name="expiry_type"><?php
						foreach ( $this->expiry_types as $expiry_type )
							echo '<option '.($model->data['expiry_type'] == $expiry_type ? 'selected' : '').' value="'.$expiry_type.'">'.$expiry_type.'</option>';?>
					</select>
					<span class="description">Will coupon expire based on count or date?</span>
				</td>
			</tr>
			<tr>
				<th>
					<label for="expiry_count"><?php echo __('Expiry Count','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="text" id="expiry_count" name="expiry_count" value="<?php echo $model->data['expiry_count']; ?>"/>
					<span class="description">The number of times this coupon can be used before expiring.</span>
				</td>
			</tr>

			<tr>
				<th>
					<label for="expiry_date"><?php echo __('Expiry Date','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="date" id="expiry_date" name="expiry_date" value="<?php echo $model->data['expiry_date']; ?>"/>
				</td>
			</tr>
			<tr>
				<th>
					<label for="status"><?php echo __('Status','stuffed-pepper'); ?></label>
				</th>
				<td>
					<select id="status" name="status"><?php
						foreach ( $this->statuses as $status )
							echo '<option '.($model->data['status'] == $status ? 'selected' : '').' value="'.$status.'">'.$status.'</option>';?>
					</select>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td><?php submit_button( 'Save' ); ?><a href="<?php echo $this->page_url; ?>">done</a></td>
			</tr>
		</tbody>
	</table>
</form>