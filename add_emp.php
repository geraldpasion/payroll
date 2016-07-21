<?php

require "add_empcon.php";



if(isset($_POST['submit'])){

$position = $_POST['position'];
$current = date("Y-m-d");
$info_l_name =  ucfirst($_POST['info_l_name']);
$info_f_name =  ucfirst($_POST['info_f_name']);
$info_m_name =  ucfirst($_POST['info_m_name']);


$info_gender = $_POST['info_gender'];
$info_bday = date("Y-m-d",strtotime($_POST['info_bday']));
$info_status = $_POST['info_status'];
$info_pre_home_add = $_POST['info_pre_home_add'];
$info_per_add = $_POST['info_per_add'];
$info_city = $_POST['info_city'];
$info_zip = $_POST['info_zip'];
$info_email = $_POST['info_email'];
$info_mob_num = $_POST['info_mob_num'];
$info_tel_num = $_POST['info_tel_num'];
$info_nat = $_POST['info_nat'];
$info_placeofbirth = date("Y-m-d",strtotime($_POST['info_placeofbirth']));
$info_pagibigno = $_POST['info_pagibigno'];
$info_philhealth = $_POST['info_philhealth'];
$info_blodtyp = $_POST['info_blodtyp'];
$sss = $_POST['sss'];
$info_religion = $_POST['info_religion'];
$info_tin = $_POST['info_tin'];



$info_father = $_POST['info_father'];
$info_mother = $_POST['info_mother'];
$date_father = date("Y-m-d",strtotime($_POST['date_father']));
$date_mother = date("Y-m-d",strtotime($_POST['date_mother']));


$info_f_occupation = $_POST['info_f_occupation'];
$info_m_occupation = $_POST['info_m_occupation'];



$info_n_children = $_POST['info_n_children'];
$date_children = date("Y-m-d",strtotime($_POST['date_children']));
$info_n_children1 = $_POST['info_n_children1'];
$date_children1 = date("Y-m-d",strtotime($_POST['date_children1']));
$info_n_children2 = $_POST['info_n_children2'];
$date_children2 = date("Y-m-d",strtotime($_POST['date_children2']));
$info_n_siblings = $_POST['info_n_siblings'];
$date_siblings = date("Y-m-d",strtotime($_POST['date_siblings']));
$info_n_sibling1 = $_POST['info_n_sibling1'];
$date_siblings1 = date("Y-m-d",strtotime($_POST['date_siblings1']));
$info_n_siblings2 = $_POST['info_n_siblings2'];
$date_siblings2 = date("Y-m-d",strtotime($_POST['date_siblings2']));
$info_cont_person = $_POST['info_cont_person'];


$info_cont_num = $_POST['info_cont_num'];
$info_cont_add = $_POST['info_cont_add'];
$info_post = $_POST['info_post'];
$info_educ_school = $_POST['info_educ_school'];
$info_educ_course = $_POST['info_educ_course'];
$info_educ_major = $_POST['info_educ_major'];
$date_post_last = date("Y-m-d",strtotime($_POST['date_post_last']));
$info_bachelor = $_POST ['info_bachelor'];
$info_bac_school = $_POST['info_bac_school'];
$info_bac_course = $_POST['info_bac_course'];
$info_bac_major = $_POST['info_bac_major'];
$date_bac_last = date("Y-m-d",strtotime($_POST['date_bac_last']));
$info_tech = $_POST['info_tech'];
$info_tech_school = $_POST['info_tech_school'];
$info_tech_course = $_POST['info_tech_course'];
$info_tech_major = $_POST['info_tech_major'];
$date_tech_last = date("Y-m-d",strtotime($_POST['date_tech_last']));
$info_high_school = $_POST['info_high_school'];
$date_high_last = date("Y-m-d",strtotime($_POST['date_high_last']));
$info_elem_school = $_POST['info_elem_school'];
$date_elem_attend = date("Y-m-d",strtotime($_POST['date_elem_attend']));
$info_comp_name1 = $_POST['info_comp_name1'];
$date_compjoin1 = date("Y-m-d",strtotime($_POST['date_compjoin1']));
$info_comp_add1 = $_POST['info_comp_add1'];
$date_compleft1 = date("Y-m-d",strtotime($_POST['date_compleft1']));
$info_comp_prev_salry1 = $_POST['info_comp_prev_salry1'];
$info_comp_r_leavng1 = $_POST['info_comp_r_leavng1'];
$info_comp_name2 = $_POST['info_comp_name2'];
$date_compjoin2 = date("Y-m-d",strtotime($_POST['date_compjoin2']));
$info_comp_add2 = $_POST['info_comp_add2'];
$date_compleft2 = date("Y-m-d",strtotime($_POST['date_compleft2']));
$info_comp_r_leavng2 = $_POST['info_comp_r_leavng2'];
$info_comp_name3 = $_POST['info_comp_name3'];
$date_compjoin3 = date("Y-m-d",strtotime($_POST['date_compjoin3']));
$info_comp_add3 = $_POST['info_comp_add3'];
$date_compleft3 = date("Y-m-d",strtotime($_POST['date_compleft3']));
$info_comp_prev_salry3 = $_POST['info_comp_prev_salry3'];
$info_comp_r_leavng3 = $_POST['info_comp_r_leavng3'];



$info_language = $_POST['info_language'];
$info_comp_skill = $_POST['info_comp_skill'];
$info_other_tech = $_POST['info_other_tech'];
$info_inter_hobbies = $_POST['info_inter_hobbies'];
$shifting = $_POST['shifting'];
$info_train_title = $_POST['info_train_title'];
$info_train_org = $_POST['info_train_org'];
$info_train_from = $_POST['info_train_from'];
$info_train_to = $_POST['info_train_to'];
$info_train_title2 = $_POST['info_train_title2'];
$info_train_org2 = $_POST['info_train_org2'];
$info_train_from2 = $_POST['info_train_from2'];
$info_train_to2 = $_POST['info_train_to2'];
$info_train_title3 = $_POST['info_train_title3'];
$info_train_org3 = $_POST['info_train_org3'];
$info_train_from3 = $_POST['info_train_from3'];
$info_train_to3 = $_POST['info_train_to3'];
$info_char_name1 = $_POST['info_char_name1'];
$info_char_comp_add1 = $_POST['info_char_comp_add1'];
$info_char_position1 = $_POST['info_char_position1'];
$info_char_cont_num1 = $_POST['info_char_cont_num1'];
$info_char_name2 = $_POST['info_char_name2'];
$info_char_comp_add2 = $_POST['info_char_comp_add2'];
$info_char_position2 = $_POST['info_char_position2'];
$info_char_cont_num2 = $_POST['info_char_cont_num2'];
$info_char_name3 = $_POST['info_char_name3'];
$info_char_comp_add3 = $_POST['info_char_comp_add3']; 
$info_char_position3 = $_POST['info_char_position3'];
$info_char_cont_num3 = $_POST['info_char_cont_num3'];

$info_crime = $_POST['info_crime'];
$info_specify1 = $_POST['info_specify1'];
$info_specify2 = $_POST['info_specify2'];
$info_specify3 = $_POST['info_specify3'];
$info_specify4 = $_POST['info_specify4'];



$query = mysqli_query($con,"INSERT INTO emp_data SET 


		info_l_name ='$info_l_name', 
		info_f_name = '$info_f_name', 
		info_m_name = '$info_m_name',
		info_gender = '$info_gender',

		info_bday = '$info_bday',
		info_status = '$info_status',
		info_pre_home_add = '$info_pre_home_add',
		info_per_add = '$info_per_add',
		info_city = '$info_city',
		info_zip = '$info_zip',
		info_email = '$info_email',
		info_mob_num = '$info_mob_num',
		info_tel_num = '$info_tel_num',
		info_nat ='$info_nat',
		info_placeofbirth = '$info_placeofbirth',
		info_pagibigno = '$info_pagibigno',
		info_philhealth = '$info_philhealth',
		info_blodtyp = '$info_blodtyp',
		sss = '$sss',
		info_religion = '$info_religion',
		info_tin = '$info_tin',


		info_father = '$info_father',
		info_mother = '$info_father',
		date_father = '$date_father',
		date_mother = '$date_mother',
		info_f_occupation = '$info_f_occupation',
		info_m_occupation = '$info_m_occupation',

		info_n_children = '$info_n_children',
		date_children = '$date_children',
		info_n_children1 = '$info_n_children1',
		date_children1 = '$date_children1',
		info_n_children2 = '$info_n_children2',
		date_children2 = '$date_children2',
		info_n_siblings = '$info_n_siblings',
		date_siblings = '$date_siblings',
		info_n_sibling1 = '$info_n_sibling1',
		date_siblings1 = '$date_siblings1',
		info_n_siblings2 = '$info_n_siblings2',
		date_siblings2 = '$date_siblings2',
		info_cont_person = '$info_cont_person',



		info_cont_num = '$info_cont_num',
		info_cont_add = '$info_cont_add',
		info_post = '$info_post',
		info_educ_school = '$info_educ_school',
		info_educ_course = '$info_educ_course',
		info_educ_major = '$info_educ_major',
		date_post_last = '$date_post_last',
		info_bachelor = '$info_bachelor',
		info_bac_school = '$info_bac_school',
		info_bac_course = '$info_bac_course',
		info_bac_major = '$info_bac_major',
		date_bac_last = '$date_bac_last',
		info_tech = '$info_tech',
		info_tech_school = '$info_tech_school',
		info_tech_course = '$info_tech_course',
		info_tech_major = '$info_tech_major',
		date_tech_last = '$date_tech_last',
		info_high_school = '$info_high_school',
		date_high_last = '$date_high_last',
		info_elem_school = '$info_elem_school',
		date_elem_attend = '$date_elem_attend',
		info_comp_name1 = '$info_comp_name1',
		date_compjoin1 = '$date_compjoin1',
		info_comp_add1 = '$info_comp_add1',
		date_compleft1 = '$date_compleft1',
		info_comp_prev_salry1 = '$info_comp_prev_salry1',
		info_comp_r_leavng1 = '$info_comp_r_leavng1',
		info_comp_name2 = '$info_comp_name2',
		date_compjoin2 = '$date_compjoin2',
		info_comp_add2 = '$info_comp_add2',
		date_compleft2 = '$date_compleft2',
		info_comp_r_leavng2 = '$info_comp_r_leavng2',
		info_comp_name3 = '$info_comp_name3',
		date_compjoin3 = '$date_compjoin3',
		info_comp_add3 = '$info_comp_add3',
		date_compleft3 = '$date_compleft3',
		info_comp_prev_salry3 = '$info_comp_prev_salry3',
		info_comp_r_leavng3 = '$info_comp_r_leavng3',


		info_language = '$info_language',
		info_comp_skill = '$info_comp_skill',
		info_other_tech = '$info_other_tech',
		info_inter_hobbies = '$info_inter_hobbies',
		shifting = '$shifting',
		info_train_title = '$info_train_title',
		info_train_org = '$info_train_org',
		info_train_from = '$info_train_from',
		info_train_to = '$info_train_to',
		info_train_title2 = '$info_train_title2',
		info_train_org2 = '$info_train_org2',
		info_train_from2 = '$info_train_from2',
		info_train_to2 = '$info_train_to2',
		info_train_title3 = '$info_train_title3',
		info_train_org3 = '$info_train_org3',
		info_train_from3 = '$info_train_from3',
		info_train_to3 = '$info_train_to3',
		info_char_name1 = '$info_char_name1',
		info_char_comp_add1 = '$info_char_comp_add1',
		info_char_position1 = '$info_char_position1',
		info_char_cont_num1 = '$info_char_cont_num1',
		info_char_name2 = '$info_char_name2',
		info_char_comp_add2 = '$info_char_comp_add2',
		info_char_position2 = '$info_char_position2',
		info_char_cont_num2 = '$info_char_cont_num2',
		info_char_name3 = '$info_char_name3',
		info_char_comp_add3 = '$info_char_comp_add3',
		info_char_position3 = '$info_char_position3',
		info_char_cont_num3 = '$info_char_cont_num3',
		info_crime = '$info_crime',
		info_specify1 = '$info_specify1',
		info_specify2 = '$info_specify2',
		info_specify3 = '$info_specify3',
		info_specify4 = '$info_specify4',
		position = '$position',
		date_applied = '$current'


");




	if($query === true) {
		include("dbconfig.php");
		$resultb = $mysqli->query("SELECT * FROM emp_data WHERE id = (SELECT MAX(id) FROM emp_data)")->fetch_array();
		$maxes = $resultb['id'];

		require "add_empcon2.php";
		$query2 = mysqli_query($con,"INSERT INTO student SET stdname = '$info_f_name',
		emailid = '$info_email',stdid='$maxes' ");
		echo "
		<script>
			alert('Data saved')
			window.location.href='oes/stdwelcome.php?stdname=".$info_f_name."&id=".$maxes."';
		</script>
		";
	} else {
	echo "
		<script>
			alert('Error')
			history.go(-1);
		</script>
		";	
	}
	
}

?>