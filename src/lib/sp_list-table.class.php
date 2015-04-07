<?php
if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class SP_List_Table extends WP_List_Table {

    function __construct( $config ){

        //global $status, $page;
        
        $this->config = $config;

        $args = $config['labels'];
        $args[ 'ajax' ] = $config['ajax'];

        parent::__construct( $args );

        $this->columns = $this->config['columns'];
    }

    function column_default( $item, $column_name ){

        if( isset( $this->columns[$column_name] ) ){
        
            $column = $this->columns[ $column_name ];

            if( $column['callback'] != null )
                return call_user_func( $column['callback'], $this, $item, $column_name );

            return $item[ $column_name ];
        }

        return print_r( $item, true );
    }

    function column_cb($item){
        
        if( $this->config['cb'] == false )
            return null;

        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['ID']                //The value of the checkbox should be the record's id
        );
    }


    function get_columns(){
        $columns = array();

        foreach( $this->columns as $key => $value )
            $columns[ $key ] = $value['title'];

        return $columns;
    }

    function get_sortable_columns() {

        $sortable_columns = array();
        foreach( $this->columns as $key => $value ){
            if( $value['sort'] )
                $sortable_columns[ $key ] = array( $key, false );
        }
        return $sortable_columns;
    }

    function get_bulk_actions() {
        return $this->config['bulk_actions'];
    }

    function prepare_items() {

        $this->_column_headers = array( $this->get_columns(), array(), $this->get_sortable_columns() );

        $orderby = empty( $_REQUEST['orderby'] ) ? $this->config['orderby'] : $_REQUEST['orderby'];
        $order = empty( $_REQUEST['order'] ) ? $this->config['order'] : $_REQUEST['order'];

        $result = call_user_func( $this->config['prepare_items'], $this->config, $this->get_pagenum(), $this->config['per_page'], $orderby, $order );

        $this->items = $result['data'];
        $this->set_pagination_args( $result );
    }
}
