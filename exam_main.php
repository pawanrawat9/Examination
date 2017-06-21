<?php
include 'include.php';
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$sc_id=''; 
$sc_name='';
$sc_description='';
$sc_active='';
$op_mode='';

//question
$qm_id='';
$qm_text='';
$qm_active='';
$sm_active='';
//answer
$row_count=0;

session_start();
if(!isset($_SESSION['username']) || trim($_SESSION['username'])=='')
{
	header("location:index.php");
}
else
{
	$uid=$_SESSION['userid'];
	$username=$_SESSION['username'];
	$usertype=$_SESSION['usertype'];

}
?>

<?php
	$currind=0;
	$currind=$_SESSION['currind'];
	$next_id=$currind;//$_GET["next_id"]; 
	$id=$_GET["id"]; 
	
	if(isset($_POST['BtnNext']) && $_POST['BtnNext']=='  Next >  ')
	{
		$row_count=0;
		$next_id=0;
		$currind=0;
		$currind=$_SESSION['currind'];
		$next_id=$currind;
		

	
	
		$next_id=$next_id+1;
		$_SESSION['currind']=$next_id;
		
		
		$sql="SELECT  q.*,e.* FROM question_master q, exam_master e 
		where q.q_em_id=e.em_id and e.em_id=".$id."";
    //echo($id);
    $result=mysql_query($sql) or die(mysql_error());
		//row count
		$row_count=mysql_num_rows($result);
		//echo($row_count-1);
		
		
		//-----------------
			//update Exam details
			$qm_id=mysql_result($result,$next_id-1,"q_id");
			$qm_type=mysql_result($result,$next_id-1,"q_type");
			$sql="SELECT * FROM user_survey  
			where us_um_id=".$uid." and us_em_id=".$id."";
			//echo($sql);				
			$result1=mysql_query($sql) or die(mysql_error());
			$row_count1=mysql_num_rows($result1);
			
			//echo($row_count1);
			if ($row_count1<=0)
			{ 				 
				$sql="SELECT IFNULL(max(us_id)+1,1) m FROM user_survey  ";
				$result2=mysql_query($sql) or die(mysql_error());				
				$last_id=mysql_result($result2,0,"m");				
				//insert user Exam
				$sql="insert into  user_survey(`us_id`,`us_em_id`,`us_um_id`,`us_date`) values ($last_id,$id,$uid,sysdate())";
				//echo($sql);				
				$result1=mysql_query($sql) or die(mysql_error());							
				//insert user Exam details
				$sql="SELECT IFNULL(max(usd_id)+1,1) m FROM user_survey_details  ";
				$result1=mysql_query($sql) or die(mysql_error());
				$last_detail_id=mysql_result($result1,0,"m");								
				//get the options				
				//echo($_POST['Rd1']."   ".$_POST['Chk1'].' -- '.$_POST['Rd2']."   ".$_POST['Chk2']);
				$i=0;
				for($i=1;$i<=4;$i++)
				{					
					$checkbox="Chk".$i;
					$radiobutton="Rd".$i;
					 
					//if ( $_POST[$radiobutton]!='' || $_POST[$checkbox]!='' )
					if ( (isset($_POST['Rd1']) && $_POST['Rd1']==$i) || (isset($_POST[$checkbox]) && $_POST[$checkbox]=='1') )
					{
						$chk_dis=1;
					}
					else
					{
						$chk_dis=0;
					}
					
					 $sql="insert into  user_survey_details(`usd_us_id`, `usd_q_id`, `usd_o_select`, `usd_text`) values ($last_id,$qm_id,$chk_dis,null)";//echo($sql);
					$result1=mysql_query($sql) or die(mysql_error());	
					$last_detail_id=$last_detail_id+1;					
				}													
			}
			else
			{				
				$userExamid=mysql_result($result1,0,"us_id");								
				$sql="delete FROM user_survey_details  
				where usd_us_id=".$userExamid." and usd_q_id=".$qm_id;				
				//echo($sql);
				//die();
				$result1=mysql_query($sql) or die(mysql_error());
				//get the options		
				//echo($_POST['Rd1']."   ".$_POST['Chk1'].' -- '.$_POST['Rd2']."   ".$_POST['Chk2']);		
				$i=0;
				for($i=1;$i<=4;$i++)
				{					
					$checkbox="Chk".$i;
					$radiobutton="Rd".$i;
					//check the question type and save					
					//if ( $_POST[$radiobutton]='ON' || $_POST[$checkbox]!='' )
					if ( $_POST['Rd1']==$i || $_POST[$checkbox]=='1' )
					{
						$chk_dis=1;
					}
					else
					{
						$chk_dis=0;
					}
					 $sql="insert into  user_survey_details(`usd_us_id`, `usd_q_id`, `usd_o_select`, `usd_text`) values ($userExamid,$qm_id,$chk_dis,null)";echo($sql);
					$result1=mysql_query($sql) or die(mysql_error());	
					//s.`usd_id`, s.`usd_us_id`, s.`usd_o_id`, s.`usd_o_select`, s.`usd_text` 
				}				 
			} 						
			//----------------
		
		
		
		if($next_id> $row_count-1)
		{

			header("location:exam_complete.php?id=1"); 
			 
		}
		


		
		
	}
	
	if(isset($_POST['BtnPrevious']) && $_POST['BtnPrevious']=='< Previous')
	{
		
		$currind=0;
		$currind=$_SESSION['currind'];
		$next_id=$currind;
		if ($next_id>0)
		{
		
			$next_id=$next_id-1;
			$_SESSION['currind']=$next_id;
			
		}

	}
	


?>

<?php 
		$id=$_GET["id"];
		//session_start();
		$currind=0;
		$currind=$_SESSION['currind'];
		$next_id=$currind;
		 
		
		//$sql="SELECT q.*, o.*, s.* FROM s_question_master q, s_question_options o, s_Exam_master s 
		//where q.q_sm_id=s.sm_id and o.o_q_id=q.q_id and s.sm_id=".$id."";
    $sql="SELECT  q.*,e.* FROM question_master q, exam_master e 
		where q.q_em_id=e.em_id and e.em_id=".$id."";
    //echo($id);
    $result=mysql_query($sql) or die(mysql_error());
		//row count
		$row_count=mysql_num_rows($result);
		
    $qm_id=mysql_num_rows($result);
    $qm_id=mysql_result($result,$next_id,"q_id");
    $qm_text=mysql_result($result,$next_id,"q_text");
    $qm_type=mysql_result($result,$next_id,"q_type");
    $em_name=mysql_result($result,$next_id,"em_name");
    //echo($sql);
    
    $sql="SELECT  * FROM question_options  
		where o_q_id=".$qm_id."";
		$result=mysql_query($sql) or die(mysql_error());
		
		$op_text1=mysql_result($result,0,"o_text");
  	$op_text2=mysql_result($result,1,"o_text");
  	$op_text3=mysql_result($result,2,"o_text");
  	$op_text4=mysql_result($result,3,"o_text");
  	
  	$op_image1=mysql_result($result,0,"o_image_path");
  	$op_image2=mysql_result($result,1,"o_image_path");
  	$op_image3=mysql_result($result,2,"o_image_path");
  	$op_image4=mysql_result($result,3,"o_image_path");
  	
  	$link1="<img src='\\Exam_images\\".$op_image1."'>";
  	$link2="<img src='\\Exam_images\\".$op_image2."'>";
  	$link3="<img src='\\Exam_images\\".$op_image3."'>";
  	$link4="<img src='\\Exam_images\\".$op_image4."'>";
		
		$is_checked1="";
		$is_checked2="";
		$is_checked3="";
		$is_checked4="";
		
		$sql2=" select us.*,usd.* from user_survey us, user_survey_details usd
					where usd.usd_us_id=us.us_id and us_um_id=".$uid." and usd_q_id=".$qm_id ;
		$result2=mysql_query($sql2) or die(mysql_error());
		$row_count2=mysql_num_rows($result2);
		//echo($row_count2);
		if ($row_count2>0)
		{
			if (mysql_result($result2,0,"usd_o_select")==1)
			{
				$is_checked1="checked";
			}
			if (mysql_result($result2,1,"usd_o_select")==1)
			{
				$is_checked2="checked";
			}
			if (mysql_result($result2,2,"usd_o_select")==1)
			{
				$is_checked3="checked";
			}
			if (mysql_result($result2,3,"usd_o_select")==1)
			{
				$is_checked4="checked";
			}
			
		}
		
		if ($qm_type=='Single Text Selection')
		{
	    	$text_display=" ";
	    	$file_display="style='display:none'";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
			
				$link1=" ";
		  	$link2=" ";
		  	$link3=" ";
		  	$link4=" ";
		}
		
		if ($qm_type=='Single Image Selection')
		{
				$text_display="style='display:none'";
	    	$file_display=" ";
	    	$chk_display=" ";
	    	$rd_display="style='display:none'";
	    	
				$op_text1="";
				$op_text2="";
				$op_text3="";
				$op_text4="";
			
		}
		if ($qm_type=='Multiple Text Selection')
		{
				$text_display=" ";
	    	$file_display="style='display:none'";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
			
				$link1=" ";
		  	$link2=" ";
		  	$link3=" ";
		  	$link4=" ";
			
		}
		if ($qm_type=='Multiple Image Selection')
		{
				$text_display="style='display:none'";
	    	$file_display=" ";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
	    	
				$op_text1="";
				$op_text2="";
				$op_text3="";
				$op_text4="";
			
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
<form name="form1"  method="post" action="exam_main.php?id=<?php echo($id)?>&next_id=<?php echo($next_id)?>" >
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
			
			
			
<table border="0" width="497" id="table9">
					<tr>
						<td width="491">
						<table border="0" width="100%" id="table10" style="border: 1px solid #00CC99">
							<tr>
								<td>
								<table border="0" width="483" id="table11" cellpadding="2">

									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467" class="td_tablecap1" >
										<b>Exam</b> :  <?php  echo($em_name) ?>
										</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467">
										<b>Question ID</b> : <?php echo($qm_id);?>
                                            </td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467">
                                            <b>Question</b> : <?php echo($qm_text); ?></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467">
										&nbsp;
										</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467">
										<u><b>Options</b></u></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467">
										<table border="0" width="100%" id="table12">
											<tr>
												<td width="4" align="left" valign="top">
                                            <b>A.</b></td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk1" value="1"  <?php echo($chk_display); echo(" "); echo($is_checked1);?> ><input type="radio" value="1" name="Rd1"  <?php echo($rd_display); echo(" "); echo($is_checked1);?> ></td>
												<td align="left" valign="top"> <?php echo($op_text1); ?> <div id="div1"><?php echo($link1); ?></div></td>
											</tr>
											<tr>
												<td width="4" align="left" valign="top">
                                            <b>B.</b></td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk2" value="1" <?php echo($chk_display); echo(" "); echo($is_checked2); ?> ><input type="radio" value="2" name="Rd1"  <?php echo($rd_display); echo(" "); echo($is_checked2); ?> ></td>
												<td align="left" valign="top"> <?php echo($op_text2);?><div id="div2"><?php echo($link2); ?></div> </td>
											</tr>
											<tr>
												<td width="4" align="left" valign="top">
                                            <b>C.</b></td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk3" value="1" <?php echo($chk_display); echo(" "); echo($is_checked3); ?> ><input type="radio" value="3" name="Rd1"  <?php echo($rd_display); echo(" "); echo($is_checked3); ?> ></td>
												<td align="left" valign="top"><?php echo($op_text3);?><div id="div3"><?php echo($link3); ?>
												</td>
											</tr>
											<tr>
												<td width="4" align="left" valign="top">
                                            <b>D.</b></td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk4" value="1" <?php echo($chk_display); echo(" "); echo($is_checked4); ?> ><input type="radio" value="4" name="Rd1"  <?php echo($rd_display); echo(" "); echo($is_checked4); ?> ></td>
												<td align="left" valign="top"> <?php echo($op_text4);?><div id="div4"><?php echo($link4); ?></div>
												 </td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px" width="467">
                                            &nbsp;</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px" width="467">
                                            <input type="submit" value="< Previous" name="BtnPrevious" class="ButtonStyle">&nbsp; &nbsp; <?php echo(($next_id+1)."/".$row_count) ?> &nbsp; &nbsp; 
                                            <input type="submit" value="  Next >  " name="BtnNext" class="ButtonStyle">&nbsp;&nbsp; 
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