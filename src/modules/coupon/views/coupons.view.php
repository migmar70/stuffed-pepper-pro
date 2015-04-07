<!--
<div class="ng-app">
	<label>Name:</label>
	<input type="text" ng-model="yourName" placeholder="Enter a name here">
	<hr>
	<h1>Hello {{yourName}}!</h1>

	<a id="coupon_add" href="<?php echo "$this->page_url&action=coupon_add"; ?>">Add Coupon</a>	
</div>
-->
<a id="coupon_add" href="<?php echo "$this->page_url&action=coupon_add"; ?>">Add Coupon</a>	

<?php

$model['list_table']->display();
