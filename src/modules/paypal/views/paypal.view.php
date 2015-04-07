<form id="sp_paypal_form" method="post" action="<?php echo "$this->page_url&action=$this->_action&post=$this->_post_id"; ?>">

	<input type="hidden" id="post_id" name="post_id" value="<?php echo $model->data['post_id']; ?>" />

	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="post_title"><?php echo __('Config','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="text" class="widefat" id="post_title" name="post_title" value="<?php echo $model->data['post_title']; ?>"/>
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
					<label for="user"><?php echo __('User','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="text" id="user" name="user" value="<?php echo $model->data['user']; ?>"/>
				</td>
			</tr>
			<tr>
				<th>
					<label for="password"><?php echo __('Password','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="text" id="password" name="password" value="<?php echo $model->data['password']; ?>"/>
				</td>
			</tr>
			<tr>
				<th>
					<label for="signature"><?php echo __('Signature','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="text" class="widefat" id="signature" name="signature" value="<?php echo $model->data['signature']; ?>"/>
				</td>
			</tr>
			<tr>
				<th>
					<label for="cancel_page"><?php echo __('Cancel Page','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="text" class="widefat" id="cancel_page" name="cancel_page" value="<?php echo $model->data['cancel_page']; ?>"/>
				</td>
			</tr>
			<tr>
				<th>
					<label for="cancel_psuccess_pageage"><?php echo __('Success Page','stuffed-pepper'); ?></label>
				</th>
				<td>
					<input type="text" class="widefat" id="success_page" name="success_page" value="<?php echo $model->data['success_page']; ?>"/>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td><?php submit_button( 'Save' ); ?><a href="<?php echo $this->page_url; ?>">Done</a></td>
			</tr>
		</tbody>
	</table>
</form>