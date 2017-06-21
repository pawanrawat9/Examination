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
	$username=$_SESSION['username'];
	$usertype=$_SESSION['usertype'];
	$ec_id=''; 
	$ec_name='';
	$ec_description='';
	$ec_active='';
}
?>

<?php
	$mode=$_GET["mode"]; 
	$id=$_GET["id"]; 
	if(isset($_POST['BtnSubmit']) && $_POST['BtnSubmit']=='Submit')
	{
		ob_start();
		if ($mode=='edit')
		{
		 

			$chk_dis=0;	
			if ($_POST['ChkActive']=='ON')
			{
				$chk_dis=1;
			}
			else
			{
				$chk_dis=0;
			}
			$txt_name=$_POST['TxtCategory'];
			$txt_desc=$_POST['TxtDescription'];
			if ($usertype=='Administrator')
			{
				$cond=" ";
			}
			else
			{
				$cond="and ec_create_by=".$_SESSION['userid'];
			}
			
		    $sql="update  exam_category set ec_name='$txt_name', ec_description='$txt_desc', ec_display=$chk_dis where ec_id=".$id." ".$cond; 
		    $result=mysql_query($sql) or die(mysql_error());
			
			header("location:exam_category.php"); 

	 
		}
		if ($mode=='add')
		{
		
			$chk_dis=0;	
			if ($_POST['ChkActive']=='ON')
			{
				$chk_dis=1;
			}
			else
			{
				$chk_dis=0;
			}
			
			$txt_name=$_POST['TxtCategory'];
			$txt_desc=$_POST['TxtDescription'];
			
			$uid=$_SESSION['userid'];
			
		    $sql="insert into exam_category(`ec_name`,`ec_description`,`ec_create_by`,`ec_display`) values('$txt_name', '$txt_desc',$uid,$chk_dis)"; 
		    
		    $result=mysql_query($sql) or die(mysql_error());
			
			header("location:exam_category.php"); 

	
		}
		
	
	
		ob_end_flush();
	}


?>

<?php 
	if ($usertype=='Administrator')
	{
		$cond=" ";
	}
	else
	{
		$cond="and ec_create_by=".$_SESSION['userid'];
	}
	
	if ($mode=='delete')
	{
	    $sql="delete from  exam_category  where ec_id=".$id." ".$cond; 
	    $result=mysql_query($sql) or die(mysql_error()); 
	    
		header("location:exam_category.php"); 
	}
	if ($mode=='edit')
	{
		$op_mode = "Edit Category";
	    $sql="select * from  exam_category where ec_id=".$id." ".$cond; 
	    $result=mysql_query($sql) or die(mysql_error());
	    $ec_id=mysql_result($result,0,"ec_id"); 
	    $ec_name=mysql_result($result,0,"ec_name");
	    $ec_description=mysql_result($result,0,"ec_description");
	    if (mysql_result($result,0,"ec_display")==1)
	    {
	    	$ec_active='Checked';
	    }
	    else
	    {
	    	$ec_active='';

	    }
	}
	if ($mode=='add')
	{
		$op_mode = "Add New Category";

	}

?>



<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>eExamination :: Exam Category</title>
<link href="style/Style1.css" rel="stylesheet" type="text/css" />

<script language ="javascript" type ="text/javascript" >



	function GoBack()
	{
		
		window.location.href="exam_category.php";
	
	}
	
	function validateForm(theForm) 
	{
		
	    if (trimAll(document.form1.TxtCategory.value).length == 0) 
	    {
	    	alert("Category can't blank." );
	    	document.form1.TxtCategory.focus();
	    	return false;
	
	    } 
    	return true;
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
<form name="form1" onsubmit="return validateForm(this)" method="post" action="exam_category_addedit.php?mode=<?php echo($mode)?>&id=<?php echo($id)?>" >
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
								<td>
								<table border="0" width="100%" id="table11" cellpadding="2">
									<tr>
										<td align="left" class="td_tablecap1">
										Exam<b> Category &nbsp;&nbsp; - &nbsp;&nbsp<font color="red"> <?php echo($op_mode); ?></font></b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Category ID</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
                                            <input type="text" name="TxtCatID" size="25" class ="TextBoxStyle" disabled value="<?php echo($ec_id);?>" ></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Category</td>
									</tr>	
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
                                            <input type="text" name="TxtCategory" size="25" class ="TextBoxStyle" value="<?php echo($ec_name);?>" ></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Description</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px">
                                            <textarea rows="3" name="TxtDescription" cols="24" class ="TextBoxArea" ><?php echo($ec_description);?></textarea></td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="checkbox" name="ChkActive" value="ON" <?php echo($ec_active);?> >Active</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="submit" value="Submit" name="BtnSubmit" class="ButtonStyle">&nbsp; 
                                            <input type="reset" value="Reset" name="BtnReset" class="ButtonStyle">&nbsp;&nbsp; 
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
			<td  align="center" class ="td_copyright">
						<?php 
			include 'footer.php';
			?>			
			</td>
		</tr>
		
		
	</table>
</div>
</form>
</body>

</html>