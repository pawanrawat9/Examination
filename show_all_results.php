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
<form name="form1" method="post" action="results.php" >
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
									| <a href=exam_category.php>Exam Category</a>
									| <a href="exam.php">Exam</a>
									| <a href="question.php">Question</a> 
									| <a href="results.php">Results</a>  
									| <a href="all_student_results.php">Student Results</a> | <a href="activate_user.php">Users</a> 
									| <a href="feedback_admin.php">Feedback</a> 
									| <a href="logout.php">Logout</a>');
									
							}
						
							if ($usertype=='Researcher')
							{
									  echo('<a href=my_account.php>My Account</a>
									| <a href=exam_category.php>Exam Category</a>
									| <a href="exam.php">Exam</a>
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
								<?php
									$em_id = -1;
									if(isset($_GET["id"])) {
										$em_id = $_GET["id"];
									}
									$sql = "select * from exam_master where em_id=".$em_id;
									$result = mysql_query($sql) or die(mysql_error());
									while($row = mysql_fetch_array($result)) {
										$em_name = $row["em_name"];
									}
								?>
									
								<table border="0" width="100%" id="table11" cellpadding="2">
									<tr>
										<td align="left" class="td_tablecap1"><b>
										Exam Result - <?php echo $em_name; ?></b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										&nbsp;</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
											<table style='width:100%;'>
											<?php
											if (session_status() == PHP_SESSION_NONE) {
												session_start();
											}
											$sql="select * from  user_master order by um_name " ; 
											$result=mysql_query($sql) or die(mysql_error());
											$count=mysql_num_rows($result);
												$i=0;
												for($i=0;$i<$count; $i++)
												{
													echo("<tr style='padding:5px;'>");
													$user_name=mysql_result($result,$i,"um_name");
													$user_id=mysql_result($result,$i,"um_id");
													
													echo("<td>$user_name</td>");
													$sql2="SELECT  * FROM user_survey where us_um_id=".$user_id." and us_em_id =".$em_id;
													$result2=mysql_query($sql2) or die(mysql_error());
													$row_count2=mysql_num_rows($result2);
													if ($row_count2>0)
													{
														$us_id = mysql_result($result2,0,"us_id");
														$sql3 = "SELECT * from user_survey_details where usd_us_id =".$us_id;
														$result3=mysql_query($sql3) or die(mysql_error());
														$correct_ans = 0;
														$start = 0;
														$selected = array();
														while($row = mysql_fetch_array($result3))
														{
																if($row["usd_o_select"]==1) {
																	$selected[$row["usd_q_id"]] = (($start)%4) + 1;
																}
																$start++;
														}
														foreach ($selected as $key => $value) {
															$qid = $key;
															$sql4 = "SELECT * from question_options where o_q_id = ".$qid;
															$result4=mysql_query($sql4) or die(mysql_error());
															$correctCount = 0;
															while($row = mysql_fetch_array($result4)) {
																if($row["o_right_option"] == 1) {
																	if($value == ((($correctCount)%4) + 1)) {
																		$correct_ans++;
																	}
																}
																$correctCount++;
															}
														}
														$val = $start/4;
														echo("<td>$correct_ans / $val</td>");
													} else 
														echo("<td>NA</td>");
													echo("</tr>");

												}
												
											?>
											</table>
										</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
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