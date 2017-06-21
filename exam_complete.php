<?php
include 'include.php';

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

<script language ="javascript" type ="text/javascript" >



	function GoBack()
	{
	
		location.href("my_account.php");
	
	}
	

	
	

</script>



</head>

<body>
<form name="form1" method="post" action="start_exam.php" >
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
						Welcome <b><?php echo($username.'</b> ('.$usertype.')') ?>  
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

				
				<br>

			<p>

			
			
<table border="0" width="329" id="table9">
					<tr>
						<td width="323">
						<table border="0" width="100%" id="table10" style="border: 1px solid #00CC99">
							<tr>
								<td >

									
								<table border="0" width="100%" id="table11" cellpadding="2">
									<tr>
										<td align="left" class="td_tablecap1">
										<b>
										Congratulation </b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										&nbsp;</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										<p align="center"><b>Thanks for 
										participation of the Exam.</b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										<p align="center">&nbsp;</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
                                            <p align="center">Click here to go
											<a href="my_account.php"><u>back</u></a> 
											to Main Page</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            &nbsp; 
                                            </td>
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