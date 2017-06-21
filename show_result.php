<?php
include 'include.php';
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
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
			<td align="lef"' valign="top" style="padding-left: 10px; padding-top: 10px" >
			<?php
			$id=$_GET["id"];
			$sql="select e.*, q.* from exam_master e, question_master q where q.q_em_id=e.em_id and e.em_id =".$id;
			$result=mysql_query($sql) or die(mysql_error());
			//row count
			$row_count=mysql_num_rows($result);
			if ($row_count>0)
			{
				$em_name=mysql_result($result,0,"em_name");
				echo("Exam Result for : <b>".$em_name."<br> &nbsp;</b>");
				$i=0;
				for($i=0;$i<=$row_count-1;$i++)
				{	
					$q_id=mysql_result($result,$i,"q_id");
					$q_text=mysql_result($result,$i,"q_text");
					$q_type=mysql_result($result,$i,"q_type");
					
					$sr_no=$i+1;
					
					//get the options
					$txt_op1="";
					$txt_op2="";
					$txt_op3="";
					$txt_op4="";
					
					$txt_p1="0%";
					$txt_p2="0%";
					$txt_p3="0%";
					$txt_p4="0%";
					
					$gr_width1="0";
					$gr_width2="0";
					$gr_width3="0";
					$gr_width4="0";
					
					
					$sql2="select * from question_options where o_q_id=".$q_id." order by o_id";
					$result2=mysql_query($sql2) or die(mysql_error());
					//row count
					$row_count2=mysql_num_rows($result2);
					if ($row_count2>0)
					{
						if($q_type=='Single Text Selection' || $q_type=='Multiple Text Selection')
						{
							$txt_op1=mysql_result($result2,0,"o_text"); 
							$txt_op2=mysql_result($result2,1,"o_text"); 
							$txt_op3=mysql_result($result2,2,"o_text"); 
							$txt_op4=mysql_result($result2,3,"o_text"); 
						}
						if($q_type=='Single Image Selection' || $q_type=='Multiple Image Selectio')
						{
							$txt_op1=mysql_result($result2,0,"o_image_path"); 
							$txt_op2=mysql_result($result2,1,"o_image_path"); 
							$txt_op3=mysql_result($result2,2,"o_image_path"); 
							$txt_op4=mysql_result($result2,3,"o_image_path"); 
							
							$txt_op1="<img src=Exam_images\\".$txt_op1.">";
							$txt_op2="<img src=Exam_images\\".$txt_op2.">";
							$txt_op3="<img src=Exam_images\\".$txt_op3.">";
							$txt_op4="<img src=Exam_images\\".$txt_op4.">";
							
						}
						
						//calculate results and percentage
						$sql3="SELECT * FROM user_survey_details where usd_q_id=".$q_id." order by usd_id ";
						$result3=mysql_query($sql3) or die(mysql_error());
						//row count
						$row_count3=mysql_num_rows($result3);
						if ($row_count3>0)
						{
							//user anser this questions
							$tot_count=$row_count3/4;
							$op_count1=0;
							$op_count2=0;
							$op_count3=0;
							$op_count4=0;
							
							$j=1;
							$k=0;
							for($j=0;$j<=$tot_count-1;$j++)
							{
								if (mysql_result($result3,$k,"usd_o_select")==1)
								{
									$op_count1=$op_count1+1;
								} 
								if (mysql_result($result3,$k+1,"usd_o_select")==1)
								{
									$op_count2=$op_count2+1;
								} 
								if (mysql_result($result3,$k+2,"usd_o_select")==1)
								{
									$op_count3=$op_count3+1;
								} 
								if (mysql_result($result3,$k+3,"usd_o_select")==1)
								{
									$op_count4=$op_count4+1;
								} 
								$k=$k+4;
							}	
							
							$txt_p1=round($op_count1/$tot_count*100);$txt_p1=$txt_p1."%";
							$txt_p2=round($op_count2/$tot_count*100);$txt_p2=$txt_p2."%";
							$txt_p3=round($op_count3/$tot_count*100);$txt_p3=$txt_p3."%";
							$txt_p4=round($op_count4/$tot_count*100);$txt_p4=$txt_p4."%";
							
							$gr_width1=round($op_count1/$tot_count*100);
							$gr_width2=round($op_count2/$tot_count*100);
							$gr_width3=round($op_count3/$tot_count*100);
							$gr_width4=round($op_count4/$tot_count*100);
							
							
						}
						
						
					}
					
					echo("<table border='0' width='600' id='table2'>");
					echo("<tr>");
					echo("	<td colspan='4' style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px; padding-bottom: 4px' align='left' valign='top'>");
					echo("	<b>Question ".$sr_no."</b> : ".$q_text."</td>");
					echo("</tr>");
					echo("<tr>");
					echo("	<td align='left' valign='top' width='83' style='padding-left: 6px'>");
					echo("	Option A</td>");
					echo("	<td align='left' valign='top' width='312'>".$txt_op1."</td>");					
					echo("	<td align='center' valign='top' width='93'>".$txt_p1."</td>");
					echo("	<td align='left' valign='top' width='100'>");
					echo("	<table border='0' width='100' cellspacing='0' cellpadding='0' bgcolor='#C0C0C0' id='table3' height='15'>");
					echo("		<tr>");
					echo("				<td>");
					echo("				<table border='0' width='".$gr_width1."' cellspacing='1' cellpadding='0' bgcolor='#00FFFF' height='15' id='table4'>");
					echo("					<tr>");
					echo("						<td>&nbsp;</td>");
					echo("					</tr>");
					echo("				</table>");
					echo("				</td>");
					echo("			</tr>");
					echo("		</table>");
					echo("		</td>");
					echo("	</tr>");
					echo("	<tr>");
					echo("		<td align='left' valign='top' width='83' style='padding-left: 6px'>Option B</td>");
					echo("		<td align='left' valign='top' width='312'>".$txt_op2."</td>");
					echo("		<td align='center' valign='top' width='93'>".$txt_p2."</td>");
					echo("	<td align='left' valign='top' width='100'>");
					echo("	<table border='0' width='100' cellspacing='0' cellpadding='0' bgcolor='#C0C0C0' id='table3' height='15'>");
					echo("		<tr>");
					echo("				<td>");
					echo("				<table border='0' width='".$gr_width2."' cellspacing='1' cellpadding='0' bgcolor='#00FFFF' height='15' id='table4'>");
					echo("					<tr>");
					echo("						<td>&nbsp;</td>");
					echo("					</tr>");
					echo("				</table>");
					echo("				</td>");
					echo("			</tr>");
					echo("		</table>");
					echo("		</td>");
					echo("	</tr>");
					echo("	<tr>");
					echo("		<td align='left' valign='top' width='83' style='padding-left: 6px'>Option C</td>");
					echo("		<td align='left' valign='top' width='312'>".$txt_op3."</td>"); 
					echo("	  <td align='center' valign='top' width='93'>".$txt_p3."</td>");
					echo("	<td align='left' valign='top' width='100'>");
					echo("	<table border='0' width='100' cellspacing='0' cellpadding='0' bgcolor='#C0C0C0' id='table3' height='15'>");
					echo("		<tr>");
					echo("				<td>");
					echo("				<table border='0' width='".$gr_width3."' cellspacing='1' cellpadding='0' bgcolor='#00FFFF' height='15' id='table4'>");
					echo("					<tr>");
					echo("						<td>&nbsp;</td>");
					echo("					</tr>");
					echo("				</table>");
					echo("				</td>");
					echo("			</tr>");
					echo("		</table>");
					echo("		</td>");
					echo("	 </tr>");
					echo("	 <tr>");
					echo("	 	<td align='left' valign='top' width='83' style='padding-left: 6px'>Option D</td>");
					echo("	 	<td align='left' valign='top' width='312'>".$txt_op4."</td>");
					echo("	 	<td align='center' valign='top' width='93'>".$txt_p4."</td>");
					echo("	<td align='left' valign='top' width='100'>");
					echo("	<table border='0' width='100' cellspacing='0' cellpadding='0' bgcolor='#C0C0C0' id='table3' height='15'>");
					echo("		<tr>");
					echo("				<td>");
					echo("				<table border='0' width='".$gr_width4."' cellspacing='1' cellpadding='0' bgcolor='#00FFFF' height='15' id='table4'>");
					echo("					<tr>");
					echo("						<td>&nbsp;</td>");
					echo("					</tr>");
					echo("				</table>");
					echo("				</td>");
					echo("			</tr>");
					echo("		</table>");
					echo("		</td>");
					echo("	 </tr>");
					echo("	 </table>");
					echo("	<br>");
				}
				
			}
			else
			{
				echo("No result found.");
			}
			
			?>
			
			
			
			
			<br>
			
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