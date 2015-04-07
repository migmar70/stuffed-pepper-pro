<form id="sp_mailchimp_form" method="post" action="<?php echo "$this->page_url&action=$this->_action&post=$this->_post_id"; ?>">

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
				<th>&nbsp;</th>
				<td><?php submit_button( 'Save' ); ?><a href="<?php echo $this->page_url; ?>">Done</a></td>
			</tr>
		</tbody>
	</table>
</form>