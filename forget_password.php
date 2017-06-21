

<?php
include 'include.php';

if(isset($_POST['BtnSubmit']) && $_POST['BtnSubmit']=='Submit')
{
	 
	

		$um_emailid=$_POST['TxtEmailID'];
		mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
		mysql_select_db("$db_name")or die("cannot select DB");
		$rs_validate = mysql_query("select * from user_master where um_email_id='$um_emailid'") or die(mysql_error());
		$total = mysql_num_rows($rs_validate);
		if ($total > 0)
		{
			$to = $um_emailid;
			$subject = "SOSIS - Password";
			$passwd=mysql_result($rs_validate,0,"um_password");
			$body = "Your Login Password is ".$passwd;
			if (mail($to, $subject, $body)) 
			{
			  echo("<p>Message successfully sent!</p>");
			 } else {
			
			  echo("<p>Message delivery failed...</p>");
			
			 }
			$err = urlencode("Password has been send to you email id.");
			header("Location:forget_password.php?msg=$err");
			exit();
		}
		else
		{
			$err = urlencode("ERROR: Email ID is not regisetred in the system.");
			header("Location:forget_password.php?msg=$err");
			exit();
		}

	
	
}


?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>SOES :: Home</title>
<link href="style/Style1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript">

	function validateForm(theForm) 
	{
		
    if (document.form1.TxtEmailID.value.length == 0) 
    {
    	alert("Eamil ID can't blank." );
    	document.form1.TxtEmailID.focus();
    	return false;

    } 

    
	}
	



</script>
</head>

<body>
<form name="form1" onsubmit="return validateForm(this)" method="post" action="forget_password.php" >
<div align="center">
	<table border="0" width="100%" cellspacing="1" height="100%" id="table1">
		<tr>
			<td  align="center" class ="td_top">SECURE ONLINE EXAMINATION SYSTEM</td>
		</tr>
		<tr >
			<td align="center" >
			&nbsp;
			<p>
				  <?php
	  /******************** ERROR MESSAGES*************************************************
	  This code is to show error messages 
	  **************************************************************************/
      if (isset($_GET['msg'])) {
	  $msg =$_GET['msg'];// mysql_real_escape_string($_GET['msg']);
	  echo "<div class=\"msg\"><p class='Errortext'>$msg</p></div>";
	  }
	  /******************************* END ********************************/
			?>
			
			</p>
				<table border="0" width="329" id="table6">
					<tr>
						<td width="323">
						<table border="0" width="100%" id="table7" style="border: 1px solid #00CC99">
							<tr>
								<td>
								<table border="0" width="100%" id="table8" cellpadding="2">
									<tr>
										<td align="left" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px">
										<b>Forgot Password</b></td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
                                            &nbsp;</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Email ID</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px">
                                            <input type="text" name="TxtEmailID" size="25"  class ="TextBoxStyle"></td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <font size="1">(Password will send 
											to your email id)</font></td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="submit" value="Submit" name="BtnSubmit" class="ButtonStyle">&nbsp; 
                                            <input type="reset" value="Reset" name="BtnReset" class="ButtonStyle"></td>
									</tr>
									<tr>
										<td align="left">
										&nbsp;</td>
									</tr>
								</table>
								</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				<p>&nbsp;</td>
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