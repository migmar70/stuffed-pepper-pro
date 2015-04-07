<?php
if ( !defined('ABSPATH') ) { die('-1'); }

class SP_User extends SP_Model  {

	public $logged_in = false;
	public $is_visitor = true;
	public $is_admin = false;

	public $roles = array();
	public $caps = array();
	public $capabilities = array();

	public $wpuser; // just in case we need it and it's available

	public function __construct(){

		$this->logged_in = is_user_logged_in();

		if( $this->logged_in ){

			$this->is_visitor = false;

			$this->wpuser = wp_get_current_user();

			$this->id = $this->wpuser->ID;
			$this->user_login = $this->wpuser->user_login;
			$this->first_name = $this->wpuser->first_name;
			$this->last_name = $this->wpuser->last_name;
			$this->display_name = esc_html( $this->wpuser->display_name );
			$this->user_email = $this->wpuser->user_email;
			$this->user_url = $this->wpuser->user_url;
			$this->description = $this->wpuser->description;
			$this->allcaps = $this->wpuser->allcaps;
			$this->roles = $this->wpuser->roles;
			$this->is_admin = isset( $this->allcaps['administrator'] );
		}
	}
}