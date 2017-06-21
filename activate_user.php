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

<?php
	if(isset($_GET["mode"])) {
		$mode=$_GET["mode"]; 
		$id=$_GET["id"]; 
		if ($mode=='A')
		{
			$result1=mysql_query("update user_master set um_activate_date=sysdate() where um_id=".$id);
			header("location:activate_user.php"); 	

		}
		if ($mode=='D')
		{
			$result1=mysql_query("update user_master set um_activate_date=null where um_id=".$id);	
			header("location:activate_user.php"); 	

		
		}
	}	
?>


<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>SOES :: Exam</title>
<link href="style/Style1.css" rel="stylesheet" type="text/css" />

</head>

<body>
<form name="form1"   method="post" action="activate_user.php" >
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
&nbsp;<?php
				
					//get feedback
					$result = mysql_query("select * from user_master order by um_create_date desc");
					$count=mysql_num_rows($result);
					
				?>
			<table border="1" width="660" cellspacing="1" id="table12" style="border-collapse: collapse">
				<tr>
					<td colspan="4" class="td_tablecap"><?php echo($count); ?> 
					Members&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
				</tr>
				<tr>
					<td width="100" class="td_tablehead">Join Date</td>
					<td width="200" class="td_tablehead">Name</td>
					<td width="205" class="td_tablehead">User Type</td>
					<td width="98" class="td_tablehead">Activate</td>
				</tr>
				
				<?php
				
				if ($count>0)
				{
					$i=0;
					$j='';
					for($i=0;$i<$count; $i++)
					{
						$j=$i+1;
						echo("<tr>");
							echo("<td width='100' align ='center' valign ='top'>".mysql_result($result,$i,"um_create_date")."</td>");
							echo("<td width='200' align ='left' valign ='top'>".mysql_result($result,$i,"um_name")."</td>");
							echo("<td width='205' align ='left' valign ='top'>".mysql_result($result,$i,"um_type")."</td>");
							
							if (mysql_result($result,$i,"um_activate_date")=='')
							{
								if (mysql_result($result,$i,"um_type")=='Researcher' || mysql_result($result,$i,"um_type")=='Member')
								{
									$link_text="<a href='activate_user.php?mode=A&id=".mysql_result($result,$i,"um_id")."'>Activate</a>";
								}
								else
								{
									$link_text="--";
								}
							}
							else
							{
								if (mysql_result($result,$i,"um_type")=='Researcher' || mysql_result($result,$i,"um_type")=='Member' )
								{
									$link_text="<a href='activate_user.php?mode=D&id=".mysql_result($result,$i,"um_id")."'>Deactivate</a>";
								}
								else
								{
									$link_text="--";
								}
								

							}
							
							
							echo("<td width='98' align ='left' valign ='top'>".$link_text."</td>");
						echo("</tr>");
					}
				}
				else
				{
							echo("<td width='51' align ='center' valign ='top'>&nbsp;</td>");
							echo("<td width='205' align ='left' valign ='top'>&nbsp;</td>");
							echo("<td width='98' align ='left' valign ='top'>&nbsp;</td>");
				}
				
				?>
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