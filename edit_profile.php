<?php

include 'include.php';
session_start();
if(!isset($_SESSION['username']) || trim($_SESSION['username'])=='')
{
	header("location:index.php");
}
else
{
	$um_id=$_SESSION['userid'];
	$um_name=$_SESSION['username'];
	$um_type=$_SESSION['usertype'];
	$usertype=$_SESSION['usertype'];
	

}
// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$result = mysql_query("select * from user_master where um_name='$_SESSION[username]'");


if(isset($_POST['BtnSubmit']) && $_POST['BtnSubmit']=='Submit')
{
	 
	
	$um_name=$_POST['TxtUserName'];
	$um_emailid=$_POST['TxtEmailID'];
	$um_password=$_POST['TxtPassword'];

	
	//update
	$sql_update = "update user_master set um_email_id='$um_emailid',um_password='$um_password'
								where um_id=$um_id;";

		mysql_query($sql_update) or die("updation Failed:" . mysql_error());
		
		
		header("location:my_account.php");
	

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

	    if (trimAll(document.form1.TxtUserName.value).length == 0) 
	    {
	    	alert("Username can't blank." );
	    	document.form1.TxtUserName.focus();
	    	return false;
	
	    } 
	    
	    //valid email
	   if ((document.form1.TxtEmailID.value==null)||(document.form1.TxtEmailID.value==""))
	   {
	        alert("Please Enter your Email ID");
	        document.form1.TxtEmailID.focus();
	        return false;
	    }
	    if (echeck(document.form1.TxtEmailID.value)==false)
	    {
	        document.form1.TxtEmailID.value="";
	        document.form1.TxtEmailID.focus();
	        return false;
	    }
	    
	    
	    if (document.form1.TxtPassword.value.length == 0) 
	    {
	    	alert("Password can't blank." );
	    	document.form1.TxtPassword.focus();
	    	return false;
	    } 
	    if (document.form1.TxtPassword.value == document.form1.TxtConfirmPassword.value) 
	    {
	    
	    }
	    else
	    {
	    	alert("Passwords are not match." );
	    	document.form1.TxtPassword.focus();
	    	return false;
	    } 
    
    
    	return true;

	}
	
	function GoRegister()
	{
		location.href('register.php');
	}


	function echeck(str) 
	{
	 
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		alert("Invalid E-mail ID")
		return false
		}
		
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		alert("Invalid E-mail ID")
		return false
		}
		
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		alert("Invalid E-mail ID")
		return false
		}
		
		if (str.indexOf(at,(lat+1))!=-1){
		alert("Invalid E-mail ID")
		return false
		}
		
		if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		alert("Invalid E-mail ID")
		return false
		}
		
		if (str.indexOf(dot,(lat+2))==-1){
		alert("Invalid E-mail ID")
		return false
		}
		
		if (str.indexOf(" ")!=-1){
		alert("Invalid E-mail ID")
		return false
		}
		
		return true                                                     
	}

	function trimAll(sString)
{
while (sString.substring(0,1) == ' ')
{
sString = sString.substring(1, sString.length);
}
while (sString.substring(sString.length-1, sString.length) == ' ')
{
sString = sString.substring(0,sString.length-1);
}
return sString;
} 
</script>
</head>

<body>
	
<form name="form1" onsubmit="return validateForm(this)" method="post" action="edit_profile.php" >
<div align="center">
	<table border="0" width="100%" cellspacing="1" height="100%" id="table1">
		<tr>
			<td  align="center" class ="td_top">SECURE ONLINE EXAMINATION SYSTEM</td>
		</tr>
		
				<tr>
			<td  align="left" class ="td_topvav" >
			<table width ="100%" align ="left">
				<tr>
					<td width="33%" align ="left" style="padding-left: 10px" valign="top">
						Welcome <b><?php echo($um_name.'</b> ('.$um_type.')') ?>  
					</td>
					<td  width="64%" align="right" style="padding-right: 10px" valign="top">
					
					<?php
							if ($usertype=='Administrator')
							{
									  echo('<a href=my_account.php>My Account</a>
									| <a href=Exam_category.php>Exam Category</a>
									| <a href="Exam.php">Exam</a>
									| <a href="question.php">Question</a> 
									| <a href="results.php">Results</a>  
									| <a href="all_student_results.php">Student Results</a> | <a href="activate_user.php">Users</a> 
									| <a href="feedback_admin.php">Feedback</a> 
									| <a href="logout.php">Logout</a>');
									
							}
						
							if ($usertype=='Researcher')
							{
									  echo('<a href=my_account.php>My Account</a>
									| <a href=Exam_category.php>Exam Category</a>
									| <a href="Exam.php">Exam</a>
									| <a href="question.php">Question</a> 
									| <a href="results.php">Results</a>  
									| <a href="edit_profile.php">Edit Profile</a> 
									| <a href="feedback.php">Feedback</a> 
									| <a href="logout.php">Logout</a>');
									
							}
							if ($usertype=='Member')
							{
									  echo('<a href=my_account.php>My Account</a>
									| <a href="start_exam.php">Start Exam</a> 
									| <a href="edit_profile.php">Edit Profile</a> 
									| <a href="feedback.php">Feedback</a> 
									| <a href="logout.php">Logout</a>');
									
							}
					
					?>
					</td>
				</tr>


			</table>
			
			
			
			</td>
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
										<td align="left"><b>Edit Profile</b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Username</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
                                            <input type="text" name="TxtUserName" size="25" class ="TextBoxStyle" value="<?php echo mysql_result($result,0,"um_name"); ?>" disabled ></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Email ID</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px">
                                            <input type="text" name="TxtEmailID" size="25"  class ="TextBoxStyle" value="<?php echo mysql_result($result,0,"um_email_id"); ?>" ></td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            Password</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="password" name="TxtPassword" size="25"  class ="TextBoxStyle"></td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            Confirm Password</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="password" name="TxtConfirmPassword" size="25"  class ="TextBoxStyle"></td>
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