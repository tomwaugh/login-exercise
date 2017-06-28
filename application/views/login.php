<h2>Please enter your login details</h2>

<?php echo form_open('form'); ?>

<label>Username:</label>
<input type="text" name="username" id="username">
<br/>

<label>Password:</label>
<input type="password" name="password" id="password">
<br/>

<input type="submit" value="Login">

<?php echo validation_errors(); ?>
<?php echo form_close(); ?>