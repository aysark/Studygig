<h2>Authorized access only - all ips are logged.</h2>

<form action="admin/newsession" method="post" name="login"/>
	<p><input type="textfield" id="user" name="user" placeholder="User name" required /></p>
	<p><input type="password" id="pass" name="pass" placeholder="Password" required /></p>
	<p><input type="submit" value="Login" /></p>
</form>

<script type="text/javascript" language="JavaScript">

document.forms['login'].elements['user'].focus();

</script>