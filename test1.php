<!DOCTYPE html>
<html>

<head>
	<script src="js/keypress.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Personal Information Form</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<!-- Include requiredd Prerequisites -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	
	<!-- Include Date Range Picker -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


	<style>
					.form-horizontal .control-label{
			/* text-align:right; */
			text-align:left;
			}
		</style>
	</style>
<script type="text/javascript">
		$(function() {
			$('input[id="daterange"]').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true
			});
		});
		</script>
</head>



<body class="white-bg">

        <div class="row">
            <div class="col-md-12">
                <div class="ibox-content">
					<div class="col-md-12">



<div class="panel panel-default">
<div class="container">
 
  <h1>ICONNECT Global Communications<small> Application form</small></h1>
</div>
  <div class="ibox-content">


								
									<form id = "myForm" action="add_emp.php" method="post" class="form-horizontal">
								<br><br><br>
									<div class="form-group">
										<label class="col-md-2 control-label">Position applied for</label>
										<div class="col-md-4"><input type="text" id = "position" class="form-control" name = "position" onpaste="return false" required = "" onDrop="return false"   required="" onKeyPress="return lettersonly(this, event)"></div></div>
									<div class="form-group">
									<h2>Personal Information<h2>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Last name</label>
										<div class="col-md-4"><input type="text" id = "lastname" class="form-control" name = "info_l_name" onpaste="return false" onDrop="return false"   required="" onKeyPress="return lettersonly(this, event)"></div>


										<label class="col-md-2 control-label">First name</label>
										<div class="col-md-4"><input type="text" id = "firstname" class="form-control" name = "info_f_name" onpaste="return false" onDrop="return false"   required="" onKeyPress="return lettersonly(this, event)"></div></div>

										<div class="form-group">	
										<label class="col-md-2 control-label">Middle name</label>
										<div class="col-md-4"><input type="text" id = "middlename" class="form-control" name = "info_m_name" onpaste="return false" onDrop="return false"   required=""onKeyPress="return lettersonly(this, event)"></div>
									
										<label class="col-md-2 control-label">Gender</label>
										<div class="col-md-4"><select class = "form-control" name ="info_gender" id = "gender"  required="" data-default-value="z" ><option selected="true" disabled="disabled" value = "">Select gender...</option> <option value = "Male">Male</option><option value = "Female">Female</option></select></div></div>

										<div class="form-group">
									<label class="col-md-2 control-label">Birthdate</label>
										<div class="col-md-4"><input id = "daterange"  type="text"  class="form-control" name="info_bday" onpaste="return false" onDrop="return false"   required="" onKeyPress="return noneonly(this, event)"/></div>
										<label class="col-md-2 control-label">Marital Status</label>
										<div class="col-md-4"><select class = "form-control" name="info_status" id = "info_status" required="" data-default-value="z" ><option selected="true" disabled="disabled" value = "" >Select marital status...</option><option value = "Single">Single</option><option value = "Married">Married</option><option value = "Widowed">Widowed</option><option value = "Separated">Separated</option><option value = "Divorced">Divorced</option></select></div>
									</div>


									 <div class="hr-line-dashed"></div>
									<div class="form-group">
									<h2>Contact Information<h2>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Present Home Address</label>
										<div class="col-md-10"><input id = "info_pre_home_add" type="text" class="form-control" name = "info_pre_home_add" required=""></div>
									</div>
<div class="form-group">
										<label class="col-md-2 control-label">Permanent Address</label>
										<div class="col-md-10"><input id = "info_per_add" type="text" class="form-control" name = "info_per_add" required=""></div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">City</label>
										<div class="col-md-4"><input type="text" id = "info_city" class="form-control" name = "info_city" onpaste="return false" onDrop="return false"   onKeyPress="return lettersonly(this, event)"></div>
										<label class="col-md-2 control-label">ZIP</label>
										<div class="col-md-4"><input type="text" id = "info_zip" class="form-control" name = "info_zip" data-mask="9999" onpaste="return false" onDrop="return false"   onKeyPress="return numbersonly(this, event)"></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Email</label>
										<div class="col-md-4"><input type="email" id = "info_email" class="form-control" name = "info_email" required="" ></div>
										<label class="col-md-2 control-label">Mobile number</label>
										<div class="col-md-4"><input type="text" id = "info_mob_num" class="form-control" name = "info_mob_num" required="" onpaste="return false" onDrop="return false"   onKeyPress="return numbersonly(this, event)"></div>
									</div>
<div class="form-group">
										<label class="col-md-2 control-label">Telephone Number</label>
										<div class="col-md-4"><input id = "info_tel_num" type="text" class="form-control" name = "info_tel_num" required="" onpaste="return false" onDrop="return false"   onKeyPress="return numbersonly(this, event)"></div>
									</div>

									
									 <div class="hr-line-dashed"></div>
									<div class="form-group">
									<h2>Employee Information<h2>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label">Nationality</label>
										<div class="col-md-4"><input id ="info_nat" type="text" nationality = "emptype" class="form-control" name = "info_nat" onpaste="return false" onDrop="return false"   required="" onKeyPress="return lettersonly(this, event)"></div>
										<label class="col-md-2 control-label">Place of Birth</label>
										<div class="col-md-4"><input type="text" id = "info_placeofbirth" class="form-control" name = "info_placeofbirth" onpaste="return false" onDrop="return false"   required="" onKeyPress="return lettersonly(this, event)"></div>
									</div>									
									<div class="form-group">
										<label class="col-md-2 control-label">Pag-ibig-no.</label>
										<div class="col-md-4"><input type="text" id = "info_pagibigno" class="form-control" name = "info_pagibigno" onpaste="return false" onDrop="return false" data-mask="999-999-999"  placeholder=""></div>
										<label class="col-md-2 control-label">Philhealth no.</label>
										<div class="col-md-4"><input type="text" name="info_philhealth" id = "info_philhealth" class="form-control" onpaste="return false" onDrop="return false" data-mask="999-999-999"  placeholder=""></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Blood type</label>
										<div class="col-md-4"><select class = "form-control" name="info_blodtyp" id = "info_blodtyp"  data-default-value="z" ><option selected="true" readonly value = "z" >Select Blood Type...</option><option value = "A">A</option><option value = "A+">A+</option><option value = "A-">A-</option><option value = "B">B</option><option value = "B+">B+</option><option value = "B-">B-</option><option value = "O">O</option><option value = "O+">O+</option><option value = "O-">O-</option><option value = "AB">AB</option><option value = "AB+">AB+</option><option value = "AB-">AB-</option></select></div>

										<label class="col-md-2 control-label">SSS no.</label>
										<div class="col-md-4"><input type="text" id = "sss" class="form-control" data-mask="9999-9999-9999" name="sss" onpaste="return false"  onDrop="return false" data-mask="999-999-999"  placeholder=""></div>
									
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Religion.</label>
										<div class="col-md-4"> <input type="text" id = "info_religion" class="form-control" name = "info_religion" placeholder="" onKeyPress="return lettersonly(this, event)"></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Tin number</label>
										<div class="col-md-4"><input type="text" id = "info_tin" class="form-control" data-mask="9999-9999-9999" name="info_tin" onpaste="return false"  onDrop="return false" data-mask="999-999-999"  placeholder=""></div>
									</div>
							

									 <div class="hr-line-dashed"></div>
							<div class="form-group">
									<h2>Family Information<h2>
									</div>
									



									<div class="form-group">
										<label class="col-md-2 control-label">Father's Name</label>
										<div class="col-md-4"><input type="text" id = "info_father" class="form-control" name = "info_father" onpaste="return false" onDrop="return false"  required="" onKeyPress="return lettersonly(this, event)"></div>
										<label class="col-md-2 control-label">Mother's Name</label>
										<div class="col-md-4"><input type="text" id = "info_mother" class="form-control" name = "info_mother" onpaste="return false" onDrop="return false"  required="" onKeyPress="return lettersonly(this, event)"></div>
									</div>									
									<div class="form-group">
										<label class="col-md-2 control-label">Birthdate</label>
										<div class="col-md-4"><input id = "daterange" type="text"  class="form-control" name="date_father" onpaste="return false" onDrop="return false" onKeyPress="return noneonly(this, event)"/></div>
										<label class="col-md-2 control-label">Birthdate</label>
										<div class="col-md-4"><input id = "daterange"  type="text"  class="form-control" name="date_mother" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"/></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Occupation</label>
										<div class="col-md-4"><input type="text" id = "info_f_occupation" class="form-control" name = "info_f_occupation" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>

										<label class="col-md-2 control-label">Occupation</label>
										<div class="col-md-4"><input type="text" id = "info_m_occupation" class="form-control" name = "info_m_occupation" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>									
									</div>


									 <div class="hr-line-dashed"></div>
									<div class="form-group">
									<h2>Name Of Children/s<h2></div>
									<div class="form-group">
										<label class="col-md-2 control-label">Children's Name</label>
										<div class="col-md-4"><input type="text" id = "info_n_children" class="form-control" name = "info_n_children" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>
									<label class="col-md-2 control-label">Birthdate</label>
										<div class="col-md-4"><input id = "daterange"  type="text"  class="form-control" name="date_children" bonpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"/></div>
									</div>		
										<div class="hr-line-dashed"></div>
										<div class="form-group">
										<label class="col-md-2 control-label">Children's Name</label>
										<div class="col-md-4"><input type="text" id = "info_n_children1" class="form-control" name = "info_n_children1" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>
									<label class="col-md-2 control-label">Birthdate</label>
										<div class="col-md-4"><input id = "daterange" type="text"  class="form-control" name="date_children1" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"/></div>
									</div>					
									<div class="hr-line-dashed"></div>
										<div class="form-group">
										<label class="col-md-2 control-label">Children's Name</label>
										<div class="col-md-4"><input type="text" id = "info_n_children2" class="form-control" name = "info_n_children2" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>
									<label class="col-md-2 control-label">Birthdate</label>
										<div class="col-md-4"><input id = "daterange"  type="text"  class="form-control" name="date_children2" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"/></div>
									</div>											
								


									 <div class="hr-line-dashed"></div>
									<div class="form-group"><h2>Name Of Sibling/s<h2></div>
									<div class="form-group">
										<label class="col-md-2 control-label">Sibling's Name</label>
										<div class="col-md-4"><input type="text" id = "info_n_siblings" class="form-control" name = "info_n_siblings" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>
									<label class="col-md-2 control-label">Birthdate</label>
										<div class="col-md-4"><input id = "daterange" type="text"  class="form-control" name="date_siblings" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"/></div>
									</div>		
										<div class="hr-line-dashed"></div>
										<div class="form-group">
										<label class="col-md-2 control-label">Sibling's Name</label>
										<div class="col-md-4"><input type="text" id = "info_n_sibling1" class="form-control" name = "info_n_sibling1" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>
									<label class="col-md-2 control-label">Birthdate</label>
										<div class="col-md-4"><input id = "daterange" type="text"  class="form-control" name="date_siblings1"/ onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"></div>
									</div>				
										<div class="hr-line-dashed"></div>
										<div class="form-group">
										<label class="col-md-2 control-label">Sibling's Name</label>
										<div class="col-md-4"><input type="text" id = "info_n_siblings2" class="form-control" name = "info_n_siblings2" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>
									<label class="col-md-2 control-label">Birthdate</label>
										<div class="col-md-4"><input id = "daterange"  type="text"  class="form-control" name="date_siblings2" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)" /></div>
									</div>		




									 <div class="hr-line-dashed"></div>
									<div class="form-group"><h2>In Case Of Emergency<h2></div>
									<div class="form-group">
										<label class="col-md-2 control-label">Contact Person</label>
										<div class="col-md-4"><input id ="info_cont_person" type="text" nationality = "emptype" class="form-control" name = "info_cont_person" onpaste="return false" onDrop="return false" required="" onKeyPress="return lettersonly(this, event)"></div>
										<label class="col-md-2 control-label">Contact Number</label>
										<div class="col-md-4"><input type="text" id = "info_cont_num" class="form-control"  name="info_cont_num" onpaste="return false" onDrop="return false" required="" onKeyPress="return numbersonly(this, event)"></div>
									</div>									
									<div class="form-group">
										<label class="col-md-2 control-label">Address</label>
										<div class="col-md-4"><input type="text" id = "info_cont_add" class="form-control" name = "info_cont_add"  required="" ></div></div>


										 <div class="hr-line-dashed"></div>
									<div class="form-group"><h2>Educational Attainment<h2></div>
									<div class="form-group">
										<label class="col-md-2 control-label">Post Graduate Diploma</label>
										<div class="col-md-4"><select class = "form-control" id = "info_post" name="info_post" data-default-value="z" ><option selected="true" value = "blank" >Select Post Graduate Diploma...</option><option value = "Graduate">Graduate</option><option value = "Undergraduate">Undergraduate</option></select></div>
				
									
										<label class="col-md-2 control-label">School</label>
										<div class="col-md-4"><input type="text" id = "info_educ_school" class="form-control" name = "info_educ_school" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div></div>

										<div class="form-group">
											<label class="col-md-2 control-label">Course</label>
										<div class="col-md-4"><input type="text" id = "info_educ_course" class="form-control" name = "info_educ_course" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>		

											<label class="col-md-2 control-label">Major/Specialization</label>
										<div class="col-md-4"><input type="text" id = "info_educ_major" class="form-control" name = "info_educ_major" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div></div>

									<div class="form-group">
									<label class="col-md-2 control-label">Date last Attended</label>
										<div class="col-md-4"><input id = "daterange" type="text"  class="form-control" name="date_post_last"  onpaste="return false" onDrop="return false"   onKeyPress="return noneonly(this, event)"/></div></div>




										<!--bachelors degree-->
										 <div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-2 control-label">Bachelors' Degree</label>
										<div class="col-md-4"><select class = "form-control" id = "info_bachelor" name="info_bachelor" data-default-value="z" ><option selected="true" value = "blank" >Select Bachelors' Degree...</option><option value = "Graduate">Graduate</option><option value = "Undergraduate">Undergraduate</option></select></div>
				
									
										<label class="col-md-2 control-label">School</label>
										<div class="col-md-4"><input type="text" id = "info_bac_school" class="form-control" name = "info_bac_school" onpaste="return false" onDrop="return false" onKeyPress="return lettersonly(this, event)"></div></div>

										<div class="form-group">
											<label class="col-md-2 control-label">Course</label>
										<div class="col-md-4"><input type="text" id = "info_bac_course" class="form-control" name = "info_bac_course" onpaste="return false" onDrop="return false" onKeyPress="return lettersonly(this, event)"></div>		

											<label class="col-md-2 control-label">Major/Specialization</label>
										<div class="col-md-4"><input type="text" id = "info_bac_major" class="form-control" name = "info_bac_major" onpaste="return false" onDrop="return false" onKeyPress="return lettersonly(this, event)"></div></div>

									<div class="form-group">
									<label class="col-md-2 control-label">Date last Attended</label>
										<div class="col-md-4"><input id = "daterange" type="text"  class="form-control" name="date_bac_last" onpaste="return false" onDrop="return false" onKeyPress="return noneonly(this, event)"/></div></div>




										 <div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-2 control-label">Technical/Vocational Degree</label>
										<div class="col-md-4"><select class = "form-control" id = "info_tech" name="info_tech" data-default-value="z" ><option selected="true" value = "blank" >Select Technical/Vocational Degree...</option><option value = "Graduate">Graduate</option><option value = "Undergraduate">Undergraduate</option></select></div>
				
									
										<label class="col-md-2 control-label">School</label>
										<div class="col-md-4"><input type="text" id = "info_tech_school" class="form-control" name = "info_tech_school" onpaste="return false" onDrop="return false" onKeyPress="return lettersonly(this, event)"></div></div>

										<div class="form-group">
											<label class="col-md-2 control-label">Course</label>
										<div class="col-md-4"><input type="text" id = "info_tech_course" class="form-control" name = "info_tech_course" onpaste="return false" onDrop="return false" onKeyPress="return lettersonly(this, event)"></div>		

											<label class="col-md-2 control-label">Major/Specialization</label>
										<div class="col-md-4"><input type="text" id = "info_tech_major" class="form-control" name = "info_tech_major" onpaste="return false" onDrop="return false" onKeyPress="return lettersonly(this, event)"></div></div>

									<div class="form-group">
									<label class="col-md-2 control-label">Date last Attended</label>
										<div class="col-md-4"><input id = "daterange" type="text"  class="form-control" name="date_tech_last" onpaste="return false" onDrop="return false" onKeyPress="return noneonly(this, event)"/></div></div>




										<!--highschool-->


										 <div class="hr-line-dashed"></div>
										 <div class="form-group"><h2>High School<h2></div>
				
									<div class="form-group">
										<label class="col-md-2 control-label">School</label>
										<div class="col-md-4"><input type="text" id = "info_high_school" class="form-control" name = "info_high_school" onpaste="return false" onDrop="return false"   onKeyPress="return lettersonly(this, event)"></div>

										
									<label class="col-md-2 control-label">Date last Attended</label>
										<div class="col-md-4"><input id = "daterange" type="text"  class="form-control" name="date_high_last" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"/></div></div>


										 <div class="hr-line-dashed"></div>
									<div class="form-group"><h2>Elementary<h2></div>
				
									<div class="form-group">
										<label class="col-md-2 control-label">School</label>
										<div class="col-md-4"><input type="text" id = "info_elem_school" class="form-control" name = "info_elem_school" onpaste="return false" onDrop="return false" onKeyPress="return lettersonly(this, event)"></div>

										
									<label class="col-md-2 control-label">Date last Attended</label>
										<div class="col-md-4"><input id = "daterange"  type="text"  class="form-control" name="date_elem_attend" onpaste="return false" onDrop="return false" onKeyPress="return noneonly(this, event)"/></div></div>


										 <div class="hr-line-dashed"></div>
										<div class="form-group"><h2>Employment History(Start with most recent job)<h2></div>
									

								
				
									<div class="form-group">
										<label class="col-md-2 control-label">Company Name</label>
										<div class="col-md-4"><input type="text" id = "info_comp_name1" class="form-control" name = "info_comp_name1" ></div>

										
									<label class="col-md-2 control-label">Date Joined</label>
										<div class="col-md-4"><input id = "daterange"  type="text"  class="form-control" name="date_compjoin1" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"/></div></div>


									<div class="form-group">
										<label class="col-md-2 control-label">Address/Contact#</label>
										<div class="col-md-4"><input type="text" id = "info_comp_add1" class="form-control" name = "info_comp_add1"></div>



									<label class="col-md-2 control-label">Date Left</label>
										<div class="col-md-4"><input id = "daterange"  type="text"  class="form-control" name="date_compleft1" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)" /></div></div>
									

										<div class="form-group">
										<label class="col-md-2 control-label">Previous Salary</label>
										<div class="col-md-4"><input type="text" id = "info_comp_prev_salry1" class="form-control" name = "info_comp_prev_salry1" onpaste="return false" onDrop="return false" placeholder=""></div>

										
										<label class="col-md-2 control-label">Reason For Leaving</label>
										<div class="col-md-4"><input type="text" id = "info_comp_r_leavng1" class="form-control" name = "info_comp_r_leavng1" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>
										</div>											



										<div class="hr-line-dashed"></div>
								
				
									<div class="form-group">
										<label class="col-md-2 control-label">Company Name</label>
										<div class="col-md-4"><input type="text" id = "info_comp_name2" class="form-control" name = "info_comp_name2"></div>

										
									<label class="col-md-2 control-label">Date Joined</label>
										<div class="col-md-4"><input id = "daterange" type="text"  class="form-control" name="date_compjoin2" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"/></div></div>


									<div class="form-group">
										<label class="col-md-2 control-label">Address/Contact#</label>
										<div class="col-md-4"><input type="text" id = "info_comp_add2" class="form-control" name = "info_comp_add2" ></div>



									<label class="col-md-2 control-label">Date Left</label>
										<div class="col-md-4"><input id = "daterange"  type="text"  class="form-control" name="date_compleft2" onpaste="return false" onDrop="return false"   onKeyPress="return noneonly(this, event)"/></div></div>
									

										<div class="form-group">
										<label class="col-md-2 control-label">Previous Salary</label>
										<div class="col-md-4"><input type="text" id = "info_comp_prev_salry2" class="form-control" name = "info_comp_prev_salry2" onpaste="return false" onDrop="return false" placeholder=""></div>

										
										<label class="col-md-2 control-label">Reason For Leaving</label>
										<div class="col-md-4"><input type="text" id = "info_comp_r_leavng2" class="form-control" name = "info_comp_r_leavng2" onpaste="return false" onDrop="return false" onKeyPress="return lettersonly(this, event)"></div>
										</div>	

								


									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-2 control-label">Company Name</label>
										<div class="col-md-4"><input type="text" id = "info_comp_name3" class="form-control" name = "info_comp_name3" ></div>

										
									<label class="col-md-2 control-label">Date Joined</label>
										<div class="col-md-4"><input id = "daterange" type="text"  class="form-control" name="date_compjoin3" onpaste="return false" onDrop="return false"   onKeyPress="return noneonly(this, event)"/></div></div>


									<div class="form-group">
										<label class="col-md-2 control-label">Address/Contact#</label>
										<div class="col-md-4"><input type="text" id = "info_comp_add3" class="form-control" name = "info_comp_add3" ></div>



									<label class="col-md-2 control-label">Date Left</label>
										<div class="col-md-4"><input id = "daterange"  type="text"  class="form-control" name="date_compleft3" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"/></div></div>
									

										<div class="form-group">
										<label class="col-md-2 control-label">Previous Salary</label>
										<div class="col-md-4"><input type="text" id = "info_comp_prev_salry3" class="form-control" name = "info_comp_prev_salry3" onpaste="return false" onDrop="return false"  placeholder=""></div>

										
										<label class="col-md-2 control-label">Reason For Leaving</label>
										<div class="col-md-4"><input type="text" id = "info_comp_r_leavng3" class="form-control" name = "info_comp_r_leavng3" onpaste="return false" onDrop="return false" onKeyPress="return lettersonly(this, event)"></div>
										</div>




											 <div class="hr-line-dashed"></div>
											<div class="form-group"><h2>Other Qualification<h2></div>
									

								
				
									<div class="form-group">
										<label class="col-md-2 control-label">Language (Written/Oral)</label>
										<div class="col-md-10"><input type="text" id = "info_language" class="form-control" name = "info_language" onpaste="return false"  onDrop="return false" ></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Computer Skills</label>
										<div class="col-md-10"><input type="text" id = "info_comp_skill" class="form-control" name = "info_comp_skill" onpaste="return false"  onDrop="return false" ></div></div>

									<div class="form-group">
										<label class="col-md-2 control-label">Other Technical/Professional Skills</label>
										<div class="col-md-10"><input type="text" id = "info_other_tech" class="form-control" name = "info_other_tech" onpaste="return false"  onDrop="return false" ></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Interest/Hobbies</label>
										<div class="col-md-10"><input type="text" id = "info_inter_hobbies" class="form-control" name = "info_inter_hobbies" onpaste="return false"  onDrop="return false" ></div></div>


									<div class="form-group">
										<label class="col-md-2 control-label">Are you willing to work in shifting schedule?</label>
										<div class="col-md-2"><select class = "form-control" id = "shifting" name="shifting" data-default-value="z" ><option selected="true" value = "blank" >Select Answer...</option><option value = "Male">Yes</option><option value = "Female">No</option></select></div></div>



											 <div class="hr-line-dashed"></div>
											<div class="form-group"><h2>Training/Seminars Attended<h2></div>
									

								
				
									<div class="form-group">
										<label class="col-md-2 control-label">Title</label>
										<div class="col-md-4"><input type="text" id = "info_train_title" class="form-control" name = "info_train_title" ></div>
									
										<label class="col-md-2 control-label">Institution/Organization</label>
										<div class="col-md-4"><input type="text" id = "info_train_org" class="form-control" name = "info_train_org" onpaste="return false" onDrop="return false"   onKeyPress="return lettersonly(this, event)"></div></div>


										<div class="form-group">
										<label class="col-md-2 control-label">From</label>
										<div class="col-md-4"><input id = "daterange"  type="text" class="form-control" name = "info_train_from" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"></div>
								
										<label class="col-md-2 control-label">To</label>
										<div class="col-md-4"><input id = "daterange"  type="text" class="form-control" name = "info_train_to" onpaste="return false" onDrop="return false"   onKeyPress="return noneonly(this, event)"></div></div>


										<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-2 control-label">Title</label>
										<div class="col-md-4"><input type="text" id = "info_train_title2" class="form-control" name = "info_train_title2" ></div>
									
										<label class="col-md-2 control-label">Institution/Organization</label>
										<div class="col-md-4"><input type="text" id = "info_train_org2" class="form-control" name = "info_train_org2" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div></div>


										<div class="form-group">
										<label class="col-md-2 control-label">From</label>
										<div class="col-md-4"><input id = "daterange"  type="text" class="form-control" name = "info_train_from2" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"></div>
								
										<label class="col-md-2 control-label">To</label>
										<div class="col-md-4"><input id = "daterange"  type="text" class="form-control" name = "info_train_to2" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"></div></div>


										<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-2 control-label">Title </label>
										<div class="col-md-4"><input type="text" id = "info_train_title3" class="form-control" name = "info_train_title3"  ></div>
									
										<label class="col-md-2 control-label">Institution/Organization</label>
										<div class="col-md-4"><input type="text" id = "info_train_org3" class="form-control" name = "info_train_org3" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div></div>


										<div class="form-group">
										<label class="col-md-2 control-label">From</label>
										<div class="col-md-4"><input id = "daterange"  type="text" class="form-control" name = "info_train_from3" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"></div>
								
										<label class="col-md-2 control-label">To</label>
										<div class="col-md-4"><input id = "daterange"  type="text" class="form-control" name = "info_train_to3" onpaste="return false" onDrop="return false"  onKeyPress="return noneonly(this, event)"></div></div>




										 <div class="hr-line-dashed"></div>
											<div class="form-group"><h2>Character References<h2></div>
									

								
									
									<div class="form-group">
										<label class="col-md-2 control-label">Name </label>
										<div class="col-md-4"><input type="text" id = "info_char_name1" class="form-control" name = "info_char_name1" onpaste="return false" onDrop="return false" onKeyPress="return lettersonly(this, event)"></div>
									
										<label class="col-md-2 control-label">Company/Address</label>
										<div class="col-md-4"><input type="text" id = "info_char_comp_add1" class="form-control" name = "info_char_comp_add1"></div></div>


										<div class="form-group">
										<label class="col-md-2 control-label">Position</label>
										<div class="col-md-4"><input type="text" id = "info_char_position1" class="form-control" name = "info_char_position1" onpaste="return false" onDrop="return false" onKeyPress="return lettersonly(this, event)"></div>
								
										<label class="col-md-2 control-label">Contact Number</label>
										<div class="col-md-4"><input type="text" id = "info_char_cont_num1" class="form-control" name = "info_char_cont_num1" onpaste="return false" onDrop="return false"   onKeyPress="return numbersonly(this, event)"></div></div>


											<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-2 control-label">Name </label>
										<div class="col-md-4"><input type="text" id = "info_char_name2" class="form-control" name = "info_char_name2" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>
									
										<label class="col-md-2 control-label">Company/Address</label>
										<div class="col-md-4"><input type="text" id = "info_char_comp_add2" class="form-control" name = "info_char_comp_add2" ></div></div>


										<div class="form-group">
										<label class="col-md-2 control-label">Position</label>
										<div class="col-md-4"><input type="text" id = "info_char_position2" class="form-control" name = "info_char_position2" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>
								
										<label class="col-md-2 control-label">Contact Number</label>
										<div class="col-md-4"><input type="text" id = "info_char_cont_num2" class="form-control" name = "info_char_cont_num2" onpaste="return false" onDrop="return false"  onKeyPress="return numbersonly(this, event)"></div></div>


										<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-md-2 control-label">Name </label>
										<div class="col-md-4"><input type="text" id = "info_char_name3" class="form-control" name = "info_char_name3" onpaste="return false" onDrop="return false"  onKeyPress="return lettersonly(this, event)"></div>
									
										<label class="col-md-2 control-label">Company/Address</label>
										<div class="col-md-4"><input type="text" id = "info_char_comp_add3" class="form-control" name = "info_char_comp_add3"></div></div>


										<div class="form-group">
										<label class="col-md-2 control-label">Position</label>
										<div class="col-md-4"><input type="text" id = "info_char_position3" class="form-control" name = "info_char_position3" onpaste="return false" onDrop="return false" onKeyPress="return lettersonly(this, event)"></div>
								
										<label class="col-md-2 control-label">Contact Number</label>
										<div class="col-md-4"><input type="text" id = "info_char_cont_num3" class="form-control" name = "info_char_cont_num3" onpaste="return false" onDrop="return false"  onKeyPress="return numbersonly(this, event)"></div></div>
	

										 <div class="hr-line-dashed"></div>

									<div class="form-group">
										<label class="col-md-4 control-label">Have you been convicted of any crime?</label>
										<div class="col-md-2"><select class = "form-control" id = "info_crime" name="info_crime" data-default-value="z" required="" ><option selected="true" value = "blank" >Select Answer...</option><option value = "Male">Yes</option><option value = "Female">No</option></select></div>
										<label class="col-md-2 control-label">(if yes please specify)</label>
										<div class="col-md-4"><input type="text" id = "info_specify1" class="form-control" name = "info_specify1"></div></div>



									<div class="form-group">
										<label class="col-md-4 control-label">State any major illness, surgery or hospitalization in the last two years</label>
										<div class="col-md-8"><input type="text" id = "info_specify2" class="form-control" name = "info_specify2" onpaste="return false" onDrop="return false"  ></div></div>


									<div class="form-group">
										<label class="col-md-4 control-label">State all known allergies (i.e. dust, antibiotics, etc)</label>
										<div class="col-md-8"><input type="text" id = "info_specify3" class="form-control" name = "info_specify3" onpaste="return false" onDrop="return false"  ></div></div>



									<div class="form-group">
										<label class="col-md-4 control-label">Do you have any physical limitations? Please specify</label>
										<div class="col-md-8"><input type="text" id = "info_specify4" class="form-control" name = "info_specify4" onpaste="return false" onDrop="return false"  ></div></div>



										 <div class="hr-line-dashed"></div>
										
										<div class="form-group">
											<label class="col-md-12 control-label">I declare that the information given by me in this form is correct and true to the best of my knowledge. I have not willfully suppressed any facts. i fully understand and accept that is any time after engagement, it is found that a false declaration has been made in this form, the Company has the absolute right to terminate my employment without assigning any reason.</label>

										
										<label class="col-md-12 control-label"> the company and its representatives likewise authorized to obtain such information as it may required for evaluating my application, employment, personal information form.</label></div>	

										<div class="col-md-8">
										</div>
									<div class="col-md-2">
									<button id ="submit" type="submit" name="submit" class="btn btn1 btn-w-m btn-primary">Submit</button>
									</div>
									<div class="col-md-1">
										<button type="button" onclick = "myFunction()" class="btn btn2 btn-w-m btn-white">Reset</button>
										</form></form>
								
            </div>
        </div>
        <hr/>
		</div>
		</div>
		<!-- Date range picker -->
    <script src="js/plugins/daterangepicker/daterangepicker.js"></script>
     <!-- Input Mask-->
    <script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>
</body>

</html>
