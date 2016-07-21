
$(document).ready(function(){
$("#submit").click(function(){
var empid = $("#empid").val();
var lastname = $("#lastname").val();
var firstname = $("#firstname").val();
var middlename = $("#middlename").val();
var gender = $("#gender").val();
var birthday = $("#birthday").val();
var marital = $("#marital").val();
var address = $("#address").val();
var email = $("#email").val();
var mobile = $("#mobile").val();
var emptype = $("#emptype").val();
var department = $("#department").val();
var jobtitle = $("#jobtitle").val();
var rate = $("#rate").val();
var taxcode = $("#taxcode").val();
var dependency = $("#dependency").val();
var sss = $("#sss").val();
var philhealth = $("#philhealth").val();
var pagibig = $("#pagibig").val();
var tin = $("#tin").val();
var shift = $("#shift").val();
var datehired = $("#datehired").val();
var city = $("#city").val();
var zip = $("#zip").val();
var restday = $("#restday").val();
var password = $("#password").val();
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'empid1='+ empid + '&lastname1='+ lastname + '&firstname1='+ firstname + '&middlename1='+ middlename + '&gender1='+ gender + '&birthday1='+ birthday + '&marital1='+ marital + '&address1='+ address + '&email1='+ email + '&mobile1='+ mobile + '&emptype1='+ emptype + '&department1='+ department + '&jobtitle1='+ jobtitle + '&rate1='+ rate + '&taxcode1='+ taxcode + '&dependency1='+ dependency + '&sss1='+ sss + '&philhealth1='+ philhealth + '&pagibig1='+ pagibig + '&tin1='+ tin + '&shift1='+ shift + '&datehired1='+ datehired + '&city1='+ city + '&zip1='+ zip + '&restday1='+ restday + '&password1='+ password;
if(lastname=='')
{
$('#warning').fadeIn(700);
$('#success').hide();
}
else
{
// AJAX Code To Submit Form.
$.ajax({
type: "POST",
url: "addnewexe.php",
data: dataString,
cache: false,
success: function(result){
$('#success').fadeIn(300).delay(3200).fadeOut(300);
 $(window).scrollTop(0);
 $('#empid').val('');
 $('#lastname').val('');
 $('#firstname').val('');
 $('#middlename').val('');
 $('#address').val('');
 $('#email').val('');
 $('#mobile').val('');
 $('#emptype').val('');
 $('#department').val('');
 $('#jobtitle').val('');
 $('#rate').val('');
 $('#taxcode').val('');
 $('#dependency').val('');
 $('#sss').val('');
 $('#philhealth').val('');
 $('#pagibig').val('');
 $('#tin').val('');
 $('#shift').val('');
 $('#datehired').val('');
 $('#city').val('');
 $('#zip').val('');
 $('#restday').val('');
 $('#password').val('');
 
}
});
}
return false;
});
});

