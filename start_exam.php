<?php
include 'include.php';
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$sc_id=''; 
$sc_name='';
$sc_description='';
$sc_active='';
$op_mode='';

session_start();
if(!isset($_SESSION['username']) || trim($_SESSION['username'])=='')
{
	header("location:index.php");
}
else
{
	$userid=$_SESSION['userid'];
	$username=$_SESSION['username'];
	$usertype=$_SESSION['usertype'];

}
?>

<?php


	if(isset($_POST['BtnSubmit']) && $_POST['BtnSubmit']=='Start Exam')
	{
	 	$result1=mysql_query("select em_id from exam_master where em_name='".$_POST['DdlExam']."'");	
	 	$em_id=mysql_result($result1,0,"em_id");
		
		$sql="SELECT  q.*,e.* FROM question_master q, exam_master e 
		where q.q_em_id=e.em_id and e.em_id=".$em_id."";
    //echo($id);
    $result=mysql_query($sql) or die(mysql_error());
		//row count
		$row_count=mysql_num_rows($result);
		if ($row_count>0)
		{
			//alreday enter
			$sql2="SELECT  * FROM user_survey where us_um_id=".$userid." and us_em_id =".$em_id;
	    echo($sql2);
	   
	    $result2=mysql_query($sql2) or die(mysql_error());
			
			$row_count2=mysql_num_rows($result2);
			echo $row_count2;
			if ($row_count2>0)
			{
				$msg = urlencode("Sorry you already answerd this Exam. ");
				header("Location:start_exam.php?msg=$msg");
				exit();
			}
		
			session_start();
			$_SESSION['currind']=0;
			header("location:exam_main.php?id=$em_id&next_id=0"); 
		}
		else
		{
			$msg = urlencode("Sorry no question avaialble for this Exam. ");
			header("Location:start_exam.php?msg=$msg");
		}
		
		
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
									| <a href="student_results.php">Results</a> 
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
			
			
<table border="0" width="329" id="table9">
					<tr>
						<td width="323">
						<table border="0" width="100%" id="table10" style="border: 1px solid #00CC99">
							<tr>
								<td >

									
								<table border="0" width="100%" id="table11" cellpadding="2">
									<tr>
										<td align="left" class="td_tablecap1"><b>
										Start Exam </b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										&nbsp;</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Select Exam</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										<select size="1" name="DdlExam">
										<?php
										session_start();
									    $sql="select em_name from  exam_master order by em_name " ; 
  										$result=mysql_query($sql) or die(mysql_error());
  										$count=mysql_num_rows($result);
											$i=0;
											for($i=0;$i<$count; $i++)
											{
												$opt=mysql_result($result,$i,"em_name");

												echo("<option>$opt</option>");
												

											}
											
										?>
										</select></td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
                                            &nbsp;</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="submit" value="Start Exam" name="BtnSubmit" class="ButtonStyle">&nbsp; 
                                            <input type="button" value=" Back " name="BtnBack" class="ButtonStyle" onclick="GoBack()"></td>
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