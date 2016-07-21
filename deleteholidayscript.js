$(document).ready(function() {
$(".delbutton").click(function(){
var del_id = element.attr("id");
var info = 'id=' + del_id;
if(confirm("Sure you want to delete this update? There is NO undo!"))
{
$.ajax({
type: "POST",
url: "delete.php",
data: info,
success: function(){
}
});
$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
.animate({ opacity: "hide" }, "slow");
}
return false;
});
});