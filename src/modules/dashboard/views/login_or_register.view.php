<?php
$view = <<<EOQ
<div class="login-or-register-view">
	<div class="login-view>">
		<h2>Login</h2>
		<form action="" method="post">
			<ul>
				<li>
					<label for="uusername">User</label>
					<input type="text" id="uusername" name="uusername"/>
				</li>
				<li>
					<label for="upassword">Password</label>
					<input type="password" id="upassword" name="upassword"/>
				</li>
				<li>
					<input type="checkbox" id="userremember" name="uremember"/> Rember me
				</li>
				<li>
					<a href="">Login</a>
				</li>
			</ul>
		</form>
	</div>
	<div class="register-view">
		<h2>Register</h2>
		<form action="" method="post">
			<ul>
				<li>
					<label for="rusername">User</label>
					<input type="text" id="rusername" name="rusername"/>
				</li>
				<li>
					<label for="rpassword">Password</label>
					<input type="password" id="rpassword" name="rpassword"/>
				</li>
				<li>
					<label for="rpassword2">Confirm Password</label>
					<input type="password" id="rpassword2" name="rpassword2"/>
				</li>

				<li>
					<label for="remail">Email</label>
					<input type="text" id="remail" name="remail"/>
				</li>

				<li>
					<label for="rfname">First Name</label>
					<input type="text" id="rfname" name="rfname"/>
				</li>

				<li>
					<label for="rlname">Last Name</label>
					<input type="text" id="rlname" name="rlname"/>
				</li>

				<li>
					<input type="checkbox" id="userremember" name="uremember"/> Rember me
				</li>
				<li>
					<a href="">Login</a>
				</li>
			</ul>
		</form>
	</div>
</div>
EOQ;
?>