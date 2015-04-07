<?php
if ( !defined('ABSPATH') ) { die('-1'); }

require_once( SP_PLUGIN_LIB .'sp_list-table.class.php' );

class SP_CouponModule extends SP_Module  {

	public function __construct( $sp ) {
		parent::__construct( $sp, __FILE__, 'coupon' );
	}

	public function init() {

		add_action( 'wp_ajax_sp_coupons_get', array( &$this, 'ajax_get_coupons' ) );

		$this->_page = empty( $_GET['page'] ) ? '' : $_GET['page'];
		$this->_action = empty( $_GET['action'] ) ? '' : $_GET['action'];
		$this->_post_id = empty( $_GET['post'] ) ? '0' : absint( $_GET['post'] );

		$this->register_post_types();
	}	

	public function register_post_types(){

		$this->post_type = 'sp_coupon';

		$post_type_args = array(
			'description' => 'Stuffed Pepper Coupons',
			'public' => false,
			'rewrite' => false,
			'supports' => false
		);
		register_post_type( $this->post_type, $post_type_args );

		flush_rewrite_rules();

		$this->fields = array( 
			'code', 
			'description', 
			'type', 
			'amount_rate',

			'expiry_type', 
			'expiry_count', 
			'expiry_date', 
			'status', 
			'count', 

			'count_date'
		);

		$this->types = array( 'Amount', 'Rate' );
		$this->expiry_types = array( 'Count', 'Date' );
		$this->statuses = array( 'Active', 'Expired', 'Cancelled' );
	}

	public function add_submenu_page( $adminmenu ){
		
		$this->page_title = $adminmenu->page_title.' - Coupons';
		$this->menu_label = 'Coupons';
		$this->menu_slug = $adminmenu->menu_slug.'-coupon';
		$this->page_url = admin_url( "admin.php?page=$this->menu_slug" );

		add_submenu_page( $adminmenu->menu_slug, $this->page_title, $this->menu_label, 'administrator', $this->menu_slug, array( $this, 'admin_page' ));

		add_action( "load-stuffer-pepper_page_$this->menu_slug" , array( $this, 'on_load_page' ) );
	}

	public function admin_page() { 
		
		if( $this->_action == 'coupon_add' || $this->_action == 'coupon_edit' )
			return $this->coupon_edit();

		return $this->coupon_list();
	}

	public function coupon_list(){

		$config = array(

	        'labels' => array (
	                'singular' => __( 'Coupon', 'stuffed-pepper' ),
	                'plural' => __( 'Coupons', 'stuffed-pepper' )
	            ),

	        'ajax' => false,

	        'cb' => true,

	        'columns' => array( 
	            'cb'            => array( 'title' => '<input type="checkbox" />',               'callback' => null, 'sort' => true ),
	            'code'          => array( 'title' => __( 'Coupon', 'stuffed-pepper' ),          'callback' => array( $this, 'render_column'), 'sort' => true ),
	            'type'          => array( 'title' => __( 'Type', 'stuffed-pepper' ),            'callback' => null, 'sort' => true ),
	            'amount_rate'   => array( 'title' => __( 'Amount/Rate', 'stuffed-pepper' ),     'callback' => null, 'sort' => true ),
	            'expiry_type'   => array( 'title' => __( 'Expiry Type', 'stuffed-pepper' ),     'callback' => null, 'sort' => true ),
	            'expiry_count'  => array( 'title' => __( 'Expiry Count', 'stuffed-pepper' ),    'callback' => null, 'sort' => true ),
	            'expiry_date'   => array( 'title' => __( 'Expiry Date', 'stuffed-pepper' ),     'callback' => null, 'sort' => true ),
	            'status'        => array( 'title' => __( 'Status', 'stuffed-pepper' ),          'callback' => null, 'sort' => true ),
	            'count'         => array( 'title' => __( 'Last Count', 'stuffed-pepper' ),      'callback' => null, 'sort' => true ),
	            'count_date'    => array( 'title' => __( 'Last Count Date', 'stuffed-pepper' ), 'callback' => null, 'sort' => true ),
	        ),

	        'bulk_actions' => array(
	            'delete' => 'Delete',
	            'expire' => 'Expire',
	            'count' => 'Count',
	            'process' => 'Process'
	        ),

	        'per_page' => 10,
	        'orderby' => 'code',
	        'order' => 'desc',

	        'data' => array(),

	        'prepare_items' => array( $this, 'prepare_items' )
	    );

		$list_table = new SP_List_Table( $config );
		$list_table->prepare_items();

		$this->view( 'coupons', array( 'list_table' => $list_table ) );

		return true;
	}

	public function coupon_edit(){
		$this->view( 'coupon', $this->result );
		return true;
	}

	public function admin_enqueue_scripts(){
		wp_enqueue_script( $this->post_type, sprintf( '%s%s.module.js', $this->module_url, $this->post_type ), null, '2.0.0.1', true );
		wp_enqueue_style( $this->post_type, sprintf( '%s%s.module.css', $this->module_url, $this->post_type ) );
	}

	public function ajax_get_coupons(){
		$result = SP_Result::create();

		$result->send();
	}

	public function on_load_page(){

		$this->result = SP_Result::create();

		if( $_SERVER['REQUEST_METHOD'] == 'GET' ){

			$model = array(
				'post_id' => 0,
				'code' => '',
				'description' => '',
				'type' => 'Rate',
				'amount_rate' => '',

				'expiry_type' => 'Date', 
				'expiry_count' => '', 
				'expiry_date' => '', 
				'status' => 'Active', 

				'count' => '', 
				'count_date' => ''
			);

			if( $this->_post_id > 0 ){

				$post = get_post( $this->_post_id );

				if( $post == null )
					die( "Post # $this->_post_id not found." );

				$model['post_id'] = $post->ID;

				foreach( $this->fields as $field ){
					$model[ $field ] = get_post_meta( $post->ID, $field, true );
				}
			}

			$this->result->with_data( $model );

			return;
		}

		$model = array(
			'post_id' => SP_Helper::get_post_int( 'post_id' ),
			'code' => SP_Helper::get_post_value( 'code' ),
			'description' => SP_Helper::get_post_value( 'description' ),
			'type' => SP_Helper::get_post_value( 'type' ),
			'amount_rate' => SP_Helper::get_post_value( 'amount_rate' ),

			'expiry_type' => SP_Helper::get_post_value( 'expiry_type' ),
			'expiry_count' => SP_Helper::get_post_value( 'expiry_count' ),
			'expiry_date' => SP_Helper::get_post_value( 'expiry_date' ),
			'status' => SP_Helper::get_post_value( 'status' ),

			'count' => SP_Helper::get_post_value( 'count' ),
			'count_date' => SP_Helper::get_post_value( 'count_date' ),
		);

		$this->result->with_data( $model );

		$this->save_post( $model );
	}

	public function save_post( $model ){

		$post = array(
			'post_content' => serialize( $model ),
			'post_name' => $model['code'],
			'post_title' => wp_strip_all_tags( $model['code'] ),
			'post_status' => 'publish',
			'post_type' => $this->post_type,
			'ping_status' => 'closed',
			'comment_status' => 'closed'
		);

		if( $model['post_id'] > 0 )
			$post['ID'] = $model['post_id'];

		$result = wp_insert_post( $post, true );

		if( is_a( $result, 'WP_Error' ) ){
			var_dump( $result );
			die();
		}

		foreach( $this->fields as $field ){
			if( count( get_post_meta( $result, $field, false ) ) > 0 )
				update_post_meta( $result, $field, $model[ $field ] );
			else
				add_post_meta( $result, $field, $model[ $field ] );
		}

		if( absint( $model['post_id'] ) != absint( $result ) ){
			wp_redirect( admin_url( "admin.php?page=$this->_page&action=coupon_edit&post=$result" ) );
			exit();
		}
	}

	public function prepare_items( $config, $current_page, $posts_per_page, $orderby, $order ){
		
		$posts = get_posts( array('post_type' => $this->post_type ) );

		$total_items = count( $posts );
		$data = array();

		foreach( $posts as $post ) {

			$model['ID'] = $post->ID;

			foreach( $this->fields as $field )
				$model[ $field ] = get_post_meta( $post->ID, $field, true );

			$data[] = $model;
		}

		$result = array( 
			'data' => $data,
            'total_items' => $total_items,
            'per_page'    => $posts_per_page,
            'total_pages' => ceil( $total_items / $posts_per_page )
		);

		return $result;
	}

	public function render_column( $list_table, $item, $column_name ){

        $actions = array(
            'edit' => sprintf( '<a href="?page=%s&action=%s&post=%s">Edit</a>', $_REQUEST['page'], 'coupon_edit', $item['ID'] )
        );
        
        return sprintf( '%1$s <span style="color:silver">(id:%2$s)</span>%3$s', $item[ $column_name ], $item['ID'], $list_table->row_actions( $actions ) );
	}

}

