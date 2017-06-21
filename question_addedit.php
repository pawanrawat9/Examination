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
$qm_type='';
//answer
$rightoption_1='';
$rightoption_2='';
$rightoption_3='';
$rightoption_4='';
$op_text1='';
$op_text2='';
$op_text3='';
$op_text4='';


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
			

			//get right option
			$chk_op1=0;
			if ((isset($_POST['CH1']) && $_POST['CH1']=='ON')||(isset($_POST['Rd1']) && $_POST['Rd1']=='V2'))
			{
				$chk_op1=1;
			}
			else
			{
				$chk_op1=0;
			}

			$chk_op2=0;
			if ((isset($_POST['CH2']) && $_POST['CH2']=='ON')||(isset($_POST['Rd1']) && $_POST['Rd1']=='V3'))
			{
				$chk_op2=1;
			}
			else
			{
				$chk_op2=0;
			}
			
			$chk_op3=0;
			if ((isset($_POST['CH3']) && $_POST['CH3']=='ON')||(isset($_POST['Rd1']) && $_POST['Rd1']=='V4'))
			{
				$chk_op3=1;
			}
			else
			{
				$chk_op3=0;
			}
			
			$chk_op4=0;
			if ((isset($_POST['CH4']) && $_POST['CH4']=='ON')||(isset($_POST['Rd1']) && $_POST['Rd1']=='V5'))
			{
				$chk_op4=1;
			}
			else
			{
				$chk_op4=0;
			}
			
			
		 	$result1=mysql_query("select em_id from exam_master where em_name='".$_POST['DdlExam']."'");	
		 	$em_id=mysql_result($result1,0,"em_id");
			$txt_question=$_POST['TxtQuestion'];
			$txt_type=$_POST['DdlAnswerType'];
			
		  $sql="update  question_master set q_em_id=$em_id, q_text='$txt_question', q_type='$txt_type', q_active=$chk_dis where q_create_by=".$_SESSION['userid']." and q_id=".$id; 
		  
		  echo($sql);
		  //exit();
		  
		  $result=mysql_query($sql) or die(mysql_error());
			
			//delete options
			$sql="delete from   question_options where o_q_id=".$id; 
	    $result=mysql_query($sql) or die(mysql_error()); 
	    			
			//insert options
			$result1=mysql_query("select ifnull(max(o_id)+1,1) m from question_options");	
		 	$o_id=mysql_result($result1,0,"m");
			//op 1
		 	$txt_opt=$_POST['TxtOption1'];		 	
		 	$filename = stripslashes($_FILES['File1']['name']);		 	
		 	$image_name=$filename;
			$newname="images/".$image_name;
			$copied = copy($_FILES['image']['File1'], $newname); 	
		 	$txt_image=$filename;
			$sql="insert into question_options values($o_id,$id,'$txt_opt','$txt_image',$chk_op1)";$o_id=$o_id+1;
			$result=mysql_query($sql) or die(mysql_error());
			//op 2
		 	$txt_opt=$_POST['TxtOption2'];
		 	$filename = stripslashes($_FILES['File2']['name']);		 	
		 	$image_name=$filename;
			$newname="images/".$image_name;
			$copied = copy($_FILES['image']['File2'], $newname); 	
		 	$txt_image=$filename;
			$sql="insert into question_options values($o_id,$id,'$txt_opt','$txt_image',$chk_op2)";$o_id=$o_id+1;
			$result=mysql_query($sql) or die(mysql_error());			
			//op 3
		 	$txt_opt=$_POST['TxtOption3'];
		 	$filename = stripslashes($_FILES['File3']['name']);		 	
		 	$image_name=$filename;
			$newname="images/".$image_name;
			$copied = copy($_FILES['image']['File3'], $newname); 	
		 	$txt_image=$filename; 	
			$sql="insert into question_options values($o_id,$id,'$txt_opt','$txt_image',$chk_op3)";$o_id=$o_id+1;
			$result=mysql_query($sql) or die(mysql_error());
			//op 4
		 	$txt_opt=$_POST['TxtOption4'];
		 	$filename = stripslashes($_FILES['File4']['name']);		 	
		 	$image_name=$filename;
			$newname="images/".$image_name;
			$copied = copy($_FILES['image']['File1'], $newname); 	
		 	$txt_image=$filename;
			$sql="insert into question_options values($o_id,$id,'$txt_opt','$txt_image',$chk_op4)";$o_id=$o_id+1;
			$result=mysql_query($sql) or die(mysql_error());
			
			header("location:question.php"); 

	 
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
			
			//get right option
			$chk_op1=0;
			if ((isset($_POST['CH1']) && $_POST['CH1']=='ON')||(isset($_POST['Rd1']) && $_POST['Rd1']=='V2'))
			{
				$chk_op1=1;
			}
			else
			{
				$chk_op1=0;
			}

			$chk_op2=0;
			if ((isset($_POST['CH2']) && $_POST['CH2']=='ON')||(isset($_POST['Rd1']) && $_POST['Rd1']=='V3'))
			{
				$chk_op2=1;
			}
			else
			{
				$chk_op2=0;
			}
			
			$chk_op3=0;
			if ((isset($_POST['CH3']) && $_POST['CH3']=='ON')||(isset($_POST['Rd1']) && $_POST['Rd1']=='V4'))
			{
				$chk_op3=1;
			}
			else
			{
				$chk_op3=0;
			}
			
			$chk_op4=0;
			if ((isset($_POST['CH4']) && $_POST['CH4']=='ON')||(isset($_POST['Rd1']) && $_POST['Rd1']=='V5'))
			{
				$chk_op4=1;
			}
			else
			{
				$chk_op4=0;
			}

			
		 	$result1=mysql_query("select em_id from exam_master where em_name='".$_POST['DdlExam']."'");	
		 	$em_id=mysql_result($result1,0,"em_id");
		 	
		 	$result1=mysql_query("select ifnull(max(q_id)+1,1) m from question_master ");	
		 	$q_id=mysql_result($result1,0,"m");
		 	
			$txt_question=$_POST['TxtQuestion'];
			$txt_type=$_POST['DdlAnswerType'];
			
		  $sql="insert into question_master(`q_id`,`q_em_id`,`q_text`,`q_type`,`q_create_by`,`q_active`,`q_date`) values($q_id,$em_id,'$txt_question','$txt_type',$uid,$chk_dis,sysdate()) "; 
		  $result=mysql_query($sql) or die(mysql_error());
			
			//delete options
			$sql="delete from  question_options where o_q_id=".$q_id; 
			$result=mysql_query($sql) or die(mysql_error()); 
	    			
			//insert options
			//op 1
		 	$txt_opt=$_POST['TxtOption1'];
		 	$txt_image='';
			$sql="insert into question_options(`o_q_id`,`o_text`,`o_image_path`,`o_right_option`) values($q_id,'$txt_opt','$txt_image',$chk_op1);";
			$result=mysql_query($sql) or die(mysql_error());
			//op 2
		 	$txt_opt=$_POST['TxtOption2'];
		 	$txt_image='';
			$sql="insert into question_options(`o_q_id`,`o_text`,`o_image_path`,`o_right_option`) values($q_id,'$txt_opt','$txt_image',$chk_op2);";
			$result=mysql_query($sql) or die(mysql_error());			
			//op 3
		 	$txt_opt=$_POST['TxtOption3'];
		 	$txt_image='';
			$sql="insert into question_options(`o_q_id`,`o_text`,`o_image_path`,`o_right_option`) values($q_id,'$txt_opt','$txt_image',$chk_op3);";
			$result=mysql_query($sql) or die(mysql_error());
			//op 1
		 	$txt_opt=$_POST['TxtOption4'];
		 	$txt_image='';
			$sql="insert into question_options(`o_q_id`,`o_text`,`o_image_path`,`o_right_option`) values($q_id,'$txt_opt','$txt_image',$chk_op4);";
			$result=mysql_query($sql) or die(mysql_error());
			
			header("location:question.php"); 

	
		}
		
	
	
		ob_end_flush();
	}


?>

<?php 

	
	if ($mode=='delete')
	{
			$sql="delete from  question_options where o_q_id=".$id; 
	    $result=mysql_query($sql) or die(mysql_error()); 
		
	    $sql="delete from  question_master where q_create_by=".$_SESSION['userid']." and q_id=".$id; 
	    $result=mysql_query($sql) or die(mysql_error()); 
	    
			header("location:question.php"); 
	}
	if ($mode=='edit')
	{
		$op_mode = "Edit Question";
		$sql="SELECT q.*, o.*, e.* FROM question_master q, question_options o, exam_master e 
			where q.q_em_id=e.em_id and o.o_q_id=q.q_id and q_id=".$id." and q_create_by=".$_SESSION['userid']." ";
		
		;
		
	    $result=mysql_query($sql);// or die(mysql_error());

	    $qm_id=mysql_num_rows($result);
	    $qm_id=mysql_result($result,0,"q_id");
	    $qm_text=mysql_result($result,0,"q_text");
	    if (mysql_result($result,0,"q_active")==1)
	    {
	    	$qm_active='Checked';
	    }
	    else
	    {
	    	$qm_active='';
	    }
	    $em_name=mysql_result($result,0,"em_name");
	    $em_active=" disabled ";
	    //get options 
	   
	    
	    $qm_type=mysql_result($result,0,"q_type");
	    
	   	$op_text1=mysql_result($result,0,"o_text");
	  	$op_text2=mysql_result($result,1,"o_text");
	  	$op_text3=mysql_result($result,2,"o_text");
	  	$op_text4=mysql_result($result,3,"o_text");
	  	
	  	$op_image1=mysql_result($result,0,"o_image_path");
	  	$op_image2=mysql_result($result,1,"o_image_path");
	  	$op_image3=mysql_result($result,2,"o_image_path");
	  	$op_image4=mysql_result($result,3,"o_image_path");
	  	
	  	$link1="<a href='\\Exam_images\\".$op_image1."' target=_blank>".$op_image1."</a>";
	  	$link2="<a href='\\Exam_images\\".$op_image2."' target=_blank>".$op_image2."</a>";
	  	$link3="<a href='\\Exam_images\\".$op_image3."' target=_blank>".$op_image3."</a>";
	  	$link4="<a href='\\Exam_images\\".$op_image4."' target=_blank>".$op_image4."</a>";
	    
	    if (mysql_result($result,0,"o_right_option")=="1" )
	    {
	   		$rightoption_1 ='Checked';
	   	}
	   	else
	   	{
	   		$rightoption_1 ='';
	   	}
	    if (mysql_result($result,1,"o_right_option")=="1" )
	    {
	   		$rightoption_2 ='Checked';
	   	}
	   	else
	   	{
	   		$rightoption_3 ='';
	   	}
	   	if (mysql_result($result,2,"o_right_option")=="1" )
	    {
	   		$rightoption_3 ='Checked';
	   	}
	   	else
	   	{
	   		$rightoption_3 ='';
	   	}
	   	if (mysql_result($result,3,"o_right_option")=="1" )
	    {
	   		$rightoption_4 ='Checked';
	   	}
	   	else
	   	{
	   		$rightoption_4 ='';
	   	}
  
	    
	    
	    if ($qm_type=="Single Text Selection")
	    {
	    	//style.display="none"
	    	$text_display=" ";
	    	$file_display="style='display:none'";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
	    	
		   	$link1="";
		  	$link2="";
		  	$link3="";
		  	$link4="";
		  	
		  	
	    	
	    }
	    if ($qm_type=='Single Image Selection')
			{
				$text_display="style='display:none'";
	    	$file_display=" ";
	    	$chk_display=" ";
	    	$rd_display="style='display:none'";
	  	}
	  	if ($qm_type=='Multiple Text Selection')
			{
				$text_display=" ";
	    	$file_display="style='display:none'";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
	    	
	    	$link1="";
		  	$link2="";
		  	$link3="";
		  	$link4="";
	  	}
	  	if ($qm_type=='Multiple Image Selection')
			{
				$text_display="style='display:none'";
	    	$file_display=" ";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
	  	}
	  	

	  	
	  	
	   /*
	    
	     
	    $sm_id=mysql_result($result,0,"sm_id"); 
	    $sm_category=mysql_result($result,0,"sc_name");
	    $sm_name=mysql_result($result,0,"sm_name");
	    $sm_description=mysql_result($result,0,"sm_description");
	    */
	    

	}
	if ($mode=='add')
	{
		$op_mode = "Add New Question";
		$sm_active="";
		

	    	
    	$text_display=" ";
    	$file_display="style='display:none'";
    	$chk_display="style='display:none'";
    	$rd_display=" ";
    	
	   	$link1="";
	  	$link2="";
	  	$link3="";
	  	$link4="";
	    	

	}

?>



<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>eExamination :: Questions</title>
<link href="style/Style1.css" rel="stylesheet" type="text/css" />

<script language ="javascript" type ="text/javascript" >



	function GoBack()
	{
		window.location.href="question.php";
	}
	
	function validateForm(theForm) 
	{
		

		
	    if (trimAll(document.form1.TxtQuestion.value).length == 0) 
	    {
	    	alert("Question text can't blank." );
	    	document.form1.TxtQuestion.focus();
	    	return false;
	
	    } 
    	return true;
	}
	
	function DisplayControl()
	{
		var sel_text=document.form1.DdlAnswerType.options[document.form1.DdlAnswerType.selectedIndex].text;
		
		if (sel_text=='Single Text Selection')
		{
			
			document.form1.Chk1.style.display="none";
			document.form1.Rd1.style.display="";
			document.form1.Chk2.style.display="none";
			document.form1.Rd2.style.display="";
			document.form1.Chk3.style.display="none";
			document.form1.Rd3.style.display="";
			document.form1.Chk4.style.display="none";
			document.form1.Rd4.style.display="";
			
			document.form1.TxtOption1.style.display="";
			document.form1.File1.style.display="none";
			document.form1.TxtOption2.style.display="";
			document.form1.File2.style.display="none";
			document.form1.TxtOption3.style.display="";
			document.form1.File3.style.display="none";
			document.form1.TxtOption4.style.display="";
			document.form1.File4.style.display="none";
			
			document.getElementById('div1').style.visibility = 'hidden';
			document.getElementById('div2').style.visibility = 'hidden';
			document.getElementById('div3').style.visibility = 'hidden';
			document.getElementById('div4').style.visibility = 'hidden';
			
		}
		
	
		if (sel_text=='Single Image Selection')
		{
			document.form1.Chk1.style.display="none";
			document.form1.Rd1.style.display="";
			document.form1.Chk2.style.display="none";
			document.form1.Rd2.style.display="";
			document.form1.Chk3.style.display="none";
			document.form1.Rd3.style.display="";
			document.form1.Chk4.style.display="none";
			document.form1.Rd4.style.display="";
			
			document.form1.TxtOption1.style.display="none";
			document.form1.File1.style.display="";
			document.form1.TxtOption2.style.display="none";
			document.form1.File2.style.display="";
			document.form1.TxtOption3.style.display="none";
			document.form1.File3.style.display="";
			document.form1.TxtOption4.style.display="none";
			document.form1.File4.style.display="";
			
			document.getElementById('div1').style.visibility = 'visible'; 
			document.getElementById('div2').style.visibility = 'visible'; 
			document.getElementById('div3').style.visibility = 'visible'; 
			document.getElementById('div4').style.visibility = 'visible'; 
			
		}
		
		if (sel_text=='Multiple Text Selection')
		{
			var rbtn = document.getElementById('Rd1');
			rbtn.style.display = 'none';
			document.form1.Chk1.style.display="";
			//document.form1.Rd1.style.display="none";
			document.form1.Chk2.style.display="";
			//document.form1.Rd2.style.display="none";
			document.form1.Chk3.style.display="";
			//document.form1.Rd3.style.display="none";
			document.form1.Chk4.style.display="";
			//document.form1.Rd4.style.display="none";
			
			document.form1.TxtOption1.style.display="";
			document.form1.File1.style.display="none";
			document.form1.TxtOption2.style.display="";
			document.form1.File2.style.display="none";
			document.form1.TxtOption3.style.display="";
			document.form1.File3.style.display="none";
			document.form1.TxtOption4.style.display="";
			document.form1.File4.style.display="none";
			
			document.getElementById('div1').style.visibility = 'hidden';
			document.getElementById('div2').style.visibility = 'hidden';
			document.getElementById('div3').style.visibility = 'hidden';
			document.getElementById('div4').style.visibility = 'hidden';
			
		}
		if (sel_text=='Multiple Image Selection')
		{
			document.form1.Chk1.style.display="";
			document.form1.Rd1.style.display="none";
			document.form1.Chk2.style.display="";
			document.form1.Rd2.style.display="none";
			document.form1.Chk3.style.display="";
			document.form1.Rd3.style.display="none";
			document.form1.Chk4.style.display="";
			document.form1.Rd4.style.display="none";
			
			document.form1.TxtOption1.style.display="none";
			document.form1.File1.style.display="";
			document.form1.TxtOption2.style.display="none";
			document.form1.File2.style.display="";
			document.form1.TxtOption3.style.display="none";
			document.form1.File3.style.display="";
			document.form1.TxtOption4.style.display="none";
			document.form1.File4.style.display="";
			
			
			document.getElementById('div1').style.visibility = 'visible'; 
			document.getElementById('div2').style.visibility = 'visible'; 
			document.getElementById('div3').style.visibility = 'visible'; 
			document.getElementById('div4').style.visibility = 'visible'; 
		}
	
		
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
<form name="form1" onsubmit="return validateForm(this)" method="post" action="question_addedit.php?mode=<?php echo($mode)?>&id=<?php echo($id)?>" enctype="multipart/form-data" >
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
			
			
			
<table border="0" width="497" id="table9">
					<tr>
						<td width="491">
						<table border="0" width="100%" id="table10" style="border: 1px solid #A8874A">
							<tr>
								<td>
								<table border="0" width="483" id="table11" cellpadding="2">
									<tr>
										<td align="left" class="td_tablecap1" width="475" colspan="2">
										Question Bank<b> &nbsp;&nbsp; - &nbsp;&nbsp<font color="red"> <?php echo($op_mode); ?></font></b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467" colspan="2">
										Exam :
										<select size="1" name="DdlExam"   >
										<?php
											session_start();
									    $sql1="select em_name from  exam_master where em_display=1 order by em_name " ; 
  										$result=mysql_query($sql1) or die(mysql_error());
  										$count=mysql_num_rows($result);
											$i=0;
											for($i=0;$i<$count; $i++)
											{
												$opt=mysql_result($result,$i,"em_name");

												if ($em_name==$opt)
												{
													echo("<option selected >$opt</option>");
												}
												else
												{
													echo("<option>$opt</option>");
												}

											}
											
										?>
										</select></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467" colspan="2">
										Question ID :
                                            <input type="text" name="TxtQuestionID" size="11" class ="TextBoxStyle" disabled value="<?php echo($qm_id);?>" ></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467" colspan="2">
                                            Question :</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467" colspan="2">
										    <textarea rows="3" name="TxtQuestion" cols="67" class ="TextBoxArea" ><?php echo($qm_text); ?></textarea></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="165">
                                            <input type="checkbox" name="ChkActive" value="ON" <?php echo($qm_active);?> > Active&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
										<td hidden align="left" valign="bottom" style="padding-left: 10px" width="312">
										Option Type :
										<select size="1" name="DdlAnswerType" onchange="DisplayControl()">
										<option <?php if ($qm_type=="Single Text Selection") {echo('selected');} ?> >Single Text Selection</option>
										<option <?php if ($qm_type=="Single Image Selection") {echo('selected');} ?> >Single Image Selection</option>
										<option <?php if ($qm_type=="Multiple Text Selection") {echo('selected');} ?>>Multiple Text Selection</option>
										<option <?php if ($qm_type=="Multiple Image Selection") {echo('selected');} ?>>Multiple Image Selection
										</option>
										</select> </td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467" colspan="2">
										Options</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467" colspan="2">
										<table border="0" width="100%" id="table12">
											<tr>
												<td width="4" align="left" valign="top">
                                            A.</td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk1" value="ON" <?php echo($chk_display); ?> ><input  type="radio" value="V2" name="Rd1" <?php echo($rightoption_1);?> <?php echo($rd_display); ?> ></td>
												<td align="left" valign="top">
                                            <textarea rows="3" name="TxtOption1" cols="63" class ="TextBoxArea" <?php echo($text_display); ?> ><?php echo($op_text1); ?></textarea> 
											<input type="file" name="File1" size="20" <?php echo($file_display); ?>> &nbsp; <div id="div1"><?php echo($link1); ?></div></td>
											</tr>
											<tr>
												<td width="4" align="left" valign="top">
                                            B.</td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk2" value="ON" <?php echo($chk_display); ?> ><input type="radio" value="V3" name="Rd1" <?php echo($rightoption_2);?> <?php echo($rightoption_2);?> <?php echo($rd_display); ?> ></td>
												<td align="left" valign="top">
                                            <textarea rows="3" name="TxtOption2" cols="63" class ="TextBoxArea" <?php echo($text_display); ?>><?php echo($op_text2);?></textarea> 
											<input type="file" name="File2" size="20" <?php echo($file_display); ?>> &nbsp; <div id="div2"><?php echo($link2); ?></div></td>
											</tr>
											<tr>
												<td width="4" align="left" valign="top">
                                            C.</td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk3" value="ON" <?php echo($chk_display); ?> ><input type="radio" value="V4" name="Rd1" <?php echo($rightoption_3);?> <?php echo($rd_display); ?> ></td>
												<td align="left" valign="top">
                                            <textarea rows="3" name="TxtOption3" cols="63" class ="TextBoxArea" <?php echo($text_display); ?>><?php echo($op_text3);?></textarea> 
											<input type="file" name="File3" size="20" <?php echo($file_display); ?>> &nbsp; <div id="div3"><?php echo($link3); ?></div></td>
											</tr>
											<tr>
												<td width="4" align="left" valign="top">
                                            D.</td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk4" value="ON" <?php echo($chk_display); ?> ><input type="radio" value="V5" name="Rd1" <?php echo($rightoption_4);?> <?php echo($rd_display); ?> ></td>
												<td align="left" valign="top">
                                            <textarea rows="3" name="TxtOption4" cols="63" class ="TextBoxArea" <?php echo($text_display); ?>><?php echo($op_text4);?></textarea> 
											<input type="file" name="File4" size="20" <?php echo($file_display); ?>> &nbsp; <div id="div4"><?php echo($link4); ?></div> </td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px" width="467" colspan="2">
                                            &nbsp;</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px" width="467" colspan="2">
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
		
		
	a</table>
</div>
</form>
</body>

</html>