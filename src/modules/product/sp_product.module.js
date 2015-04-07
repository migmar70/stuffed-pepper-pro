jQuery(document).ready( function($) {

  $('#sp_product_form #coupons .coupon .add-coupon').live( 'click', function ( e ){ 

    e.preventDefault();
    
    $('#sp_product_form #coupons ul>li:last')
      .clone( true )
      .insertAfter('#sp_product_form #coupons ul>li:last')
      .addClass('more')
      .find('select')
      .val('')
      .attr('name', 'coupon[]')
      .parent()
      .find('select')
      .attr('id', function( index, id ){
        return id.replace(/(\d+)/, function( fullMatch, n ){
          return Number(n) + 1;
        });
      });
  });

  $('#sp_product_form #coupons .coupon .del-coupon').live( 'click', function ( e ){ 
    e.preventDefault();

    $(this)
      .parent()
      .remove();
  });

});
