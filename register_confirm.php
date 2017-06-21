
<?php

session_start();
if(!isset($_SESSION['username']) || trim($_SESSION['username'])=='')
{
	header("location:index.php");
}
else
{
	$username=$_SESSION['username'];
	$usertype=$_SESSION['usertype'];

}
?>




<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>SOES :: Home</title>
<link href="style/Style1.css" rel="stylesheet" type="text/css" />

</head>

<body>
<form name="form1" onsubmit="return validateForm(this)" method="post" action="index.php" >
<div align="center">
	<table border="0" width="100%" cellspacing="1" height="100%" id="table1">
		<tr>
			<td  align="center" class ="td_top">SECURE ONLINE EXAMINATION SYSTEM</td>
		</tr>


		
		<tr >
			<td align="center" >
			&nbsp;

				<table border="0" width="455" id="table6" height="117">
					<tr>
						<td width="449">
						<p align="center"><b>Welcome to SOES</b></p>
						<p align="center"><b><font size="3"><u>
						<font color="#0000FF">S</font></u>ecure <u>
						<font color="#0000FF">O</font></u>nline <u>
						<font color="#0000FF">E</font></u>xamination <u>
						<font color="#0000FF">S</font></u>ystem</font></b></td>
					</tr>
				</table>
				<p>&nbsp;</td>
		</tr>
		
		<tr>
			<td  align="center"  height="70" valign="middle"><font color="red">Your Registration is Completed </font><br><br> <b>Click here to <a href="index.php"><b>Login</b></a><br><br><br></td>
		</tr>
		<tr>
			<td  align="center" class ="td_copyright">&nbsp;
			MCA Project by Pawan Kumar Rawat
		</tr>
		
		
	</table>
</div>
</form>
</body>

</html>