<?
ob_start();
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
header("Pragma: no-cache");
header("Cache: no-cahce");
?>

<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--script src="js/jquery.cookie.js"></script-->
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Objednávky</title>
</head>
<body>
<script type="text/javascript">

$(document).ready(function() {
	$('#db_status').delay(1000).fadeOut('slow', function() {
        // Animation complete
      });
});

function zmena(id, p) {
	priority_val=$('#priority_'+id).val();
	if (p==1) { // zmena priority
		if (priority_val==1) { priority_val=0; }
		else { priority_val=1; }
		$('#priority_'+id).val=priority_val;
	}
	change_status_val=0;
	if (p==2) { // zmena status
		change_status_val=1;
	}
	design_val=$('#design_'+id).val();
	model_val=$('#model_'+id).val();
	format_val=$('#format_'+id).val();
	newPrinter_val=$('#newPrinter_'+id).val();
	status_val=$('#status_'+id).val();
	ebay_val=$('#ebay_'+id).val();
	notes_val=$('#notes_'+id).val();
	payment_val=$('#payment_'+id).val();

	design_val=design_val.replace(/\"/g, "&#34;");
	model_val=model_val.replace(/\"/g, "&#34;");
	notes_val=notes_val.replace(/\"/g, "&#34;");
	payment_val=payment_val.replace(/\"/g, "&#34;");

	design_val=design_val.replace(/\'/g, "&#39;");
	model_val=model_val.replace(/\'/g, "&#39;");
	notes_val=notes_val.replace(/\'/g, "&#39;");
	payment_val=payment_val.replace(/\'/g, "&#34;");


	if (priority_val==1) { $('#priority_img_'+id).attr("src", "images/red.png"); }
	else { $('#priority_img_'+id).attr("src", "images/green.png"); }

	$.post("save.php", {id: id, priority: priority_val, design: design_val, model: model_val, format: format_val, status: status_val, ebay: ebay_val, notes: notes_val, payment: payment_val, newPrinter: newPrinter_val, change_status: change_status_val}, function(data){
		$('#db_status').html(data);
		$('#db_status').fadeIn('slow', function() {
			$('#db_status').delay(1000).fadeOut('slow', function() {
				// Animation complete
				// alert(data);
				if (p==2) { // zmena status
					location.reload();
				}
			});
		});
	});


}

function novy() {
	$.post("new.php", {design: "new"}, function(data){
		$('#db_status').html(data);
		$('#db_status').fadeIn('fast', function() {
			$('#db_status').fadeOut('slow', function() {
				location.reload();
			});
		});
	});
}

function vymaz(id, design) {
	var answer = confirm ('Really archive ' + design + ' ?')
	if (answer) {
		$.post("delete.php", {id: id}, function(data){
			$('#db_status').html(data);
			$('#db_status').fadeIn('fast', function() {
				$('#db_status').fadeOut('slow', function() {
					location.reload();
				});
			});
		});
	}
}


function nastav_filter(filter) {
	/*f_none_val=$('#f_none').attr('checked');
	f_printed_val=$('#f_printed').attr('checked');
	f_up_val=$('#f_up').attr('checked');
	f_done_val=$('#f_done').attr('checked');
	f_hold_val=$('#f_hold').attr('checked');
	f_priority_val=$('#f_priority').attr('checked');
	f_search_val=$('#f_search').val();
	f_archive_val=$('#f_archive').attr('checked');

	$.cookie('f_none', f_none_val, { expires: 365 });
	$.cookie('f_printed', f_printed_val, { expires: 365 });
	$.cookie('f_up', f_up_val, { expires: 365 });
	$.cookie('f_done', f_done_val, { expires: 365 });
	$.cookie('f_hold', f_hold_val, { expires: 365 });
	$.cookie('f_priority', f_priority_val, { expires: 365 });
	$.cookie('f_search', f_search_val, { expires: 365 });
	$.cookie('f_archive', f_archive_val, { expires: 365 });
*/

	location.reload();

}


</script>

<?php

include 'db_connect.php';

$login_ok=$_COOKIE["LoginOK"];
//echo "<".$login_ok.">";

if (isset($_COOKIE['f_none'])==FALSE) { setcookie("f_none", "true", time()+60*60*24*30); }
if (isset($_COOKIE['f_printed'])==FALSE) { setcookie("f_printed", "true", time()+60*60*24*30); }
if (isset($_COOKIE['f_up'])==FALSE) { setcookie("f_up", "true", time()+60*60*24*30); }
if (isset($_COOKIE['f_done'])==FALSE) { setcookie("f_done", "true", time()+60*60*24*30); }
if (isset($_COOKIE['f_hold'])==FALSE) { setcookie("f_hold", "true", time()+60*60*24*30); }
if (isset($_COOKIE['f_priority'])==FALSE) { setcookie("f_priority", "false", time()+60*60*24*30); }
if (isset($_COOKIE['f_search'])==FALSE) { setcookie("f_search", "null", time()+60*60*24*30); }
if (isset($_COOKIE['f_archive'])==FALSE) { setcookie("f_archive", "false", time()+60*60*24*30); }


if ($login_ok==1) {

//echo $meno_login."-".$heslo_login."<br>";

$sql    = 'SELECT * FROM production ';
$where  = " where (1=0 ";
/*
if ($_COOKIE["f_archive"]=="true") {
	$where = $where . " or status='archive' ";
} else {
	if ($_COOKIE["f_none"]=="true") { $where = $where . " or status='none' "; }
	if ($_COOKIE["f_printed"]=="true") { $where = $where . " or status='printed' "; }
	if ($_COOKIE["f_up"]=="true") { $where = $where . " or status='up' "; }
	if ($_COOKIE["f_done"]=="true") { $where = $where . " or status='done' "; }
	if ($_COOKIE["f_hold"]=="true") { $where = $where . " or status='hold' "; }
}*/
$where = $where . " )";
/*
if ($_COOKIE["f_priority"]=="true") { $where = $where . " and priority=1 "; }
if ($_COOKIE["f_search"]<>"null") { $where = $where . " and design like '%".$_COOKIE["f_search"]."%'"; }
*/

$sql=$sql.$where." order by id desc";
//echo $sql;
$result = $mysqli -> query($sql);

if (!$result) {
    echo "DB Error, could not query the database\n";
    echo("Error description: " . $mysqli -> error);
    exit;
}

function select_class($status, $priorita, $format) {
	$class="bunka";
	//if ($priorita==1) { $class="priority"; }
	if ($status=="printed") { $class="printed"; }
	if ($status=="up") { $class="up"; }
	if ($status=="done") { $class="done"; }
	if ($status=="hold") { $class="hold"; }
	if ($format=="EPS Problem") { $class="eps_problem"; }

	return $class;
}

//echo $_COOKIE["f_search"]." ".$_COOKIE["f_printed"]." ".$_COOKIE["f_up"]." ".$_COOKIE["f_done"];
?>

<div align="center"><h2>FOR PRODUCTION</h2></div>

<div id="filters" class="db">
Search: <input autocomplete="off" type="text" maxlength="20" id="f_search" value="<?php if ($_COOKIE["f_search"]<>"null") { echo $_COOKIE["f_search"]; } ?>" onchange="nastav_filter('search');" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Filters:<input type="checkbox" id="f_none" value="1" onclick="nastav_filter('none');" <?php if ($_COOKIE["f_none"]=="true") { echo "checked"; } ?>/>None
<input type="checkbox" id="f_printed" value="1" onclick="nastav_filter('printed');" <?php if ($_COOKIE["f_printed"]=="true") { echo "checked"; } ?> />Printed
<input type="checkbox" id="f_up" value="1" onclick="nastav_filter('up');" <?php if ($_COOKIE["f_up"]=="true") { echo "checked"; } ?> />Up
<input type="checkbox" id="f_done" value="1" onclick="nastav_filter('done');" <?php if ($_COOKIE["f_done"]=="true") { echo "checked"; } ?> />Done
<input type="checkbox" id="f_hold" value="1" onclick="nastav_filter('hold');" <?php if ($_COOKIE["f_hold"]=="true") { echo "checked"; } ?> />Hold
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="f_priority" value="1" onclick="nastav_filter('priority');" <?php if ($_COOKIE["f_priority"]=="true") { echo "checked"; } ?> />Only priority
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="f_archive" value="1" onclick="nastav_filter('archive');" <?php if ($_COOKIE["f_archive"]=="true") { echo "checked"; } ?> />Archive

<img align="right" style="cursor:pointer;" src="images/insert.jpg" title="new design" alt="new design" onclick="novy();" /><img align="right" style="cursor:pointer;" src="images/refresh.jpg" width="32" title="refresh" alt="refresh" onclick="location.reload();" />
</div>
<div id="db" class="db">Message: <span id="db_status">Loading...</span></div>
<table class="tabulka" cellspacing="0">
<tr>
<td class="nadpis" width="30">Pr.</td>
<td class="nadpis" width="350">Design No.</td>
<td class="nadpis" width="200">Model</td>
<td class="nadpis" width="130">Format</td>
<td class="nadpis" width="70">Printer</td>
<td class="nadpis" width="100">Status</td>
<td class="nadpis" width="130">Date of status</td>
<td class="nadpis" width="150">eBay</td>
<td class="nadpis" width="400">Notes</td>
<td class="nadpis" width="110">Payment</td>
<td class="nadpis" width="20">&nbsp;</td>
</tr>
<?php

while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
<?php  $class=select_class($row['status'],$row['priority'],$row['format']); ?>
<td class="<?php  echo $class; ?>"><img id="priority_img_<?php  echo $row['id']; ?>" style="cursor:pointer;" src="<?php  if ($row['priority']==1) { echo "images/red.png"; } else { echo "images/green.png"; } ?>" onclick="zmena(<?php  echo $row['id']; ?>,1);" /><input id="priority_<?php  echo $row['id']; ?>" type="hidden" value="<?php if ($row['priority']==1) { echo "1"; } else { echo "0"; } ?>" /></td>
<td class="<?php  echo $class; ?>"><input autocomplete="off" id="design_<?php  echo $row['id']; ?>" onchange="zmena(<?php  echo $row['id']; ?>);" maxlength="500" class="<?php  echo $class; ?>" type="text" value="<?php echo $row['design']; ?>"></td>
<td class="<?php  echo $class; ?>"><input autocomplete="off" id="model_<?php  echo $row['id']; ?>" onchange="zmena(<?php  echo $row['id']; ?>);" maxlength="20" class="<?php  echo $class; ?>" type="text" value="<?php echo $row['model']; ?>"></td>
<td class="<?php  echo $class; ?>">
<select autocomplete="off" id="format_<?php  echo $row['id']; ?>" onchange="zmena(<?php  echo $row['id']; ?>);"  class="<?php  echo $class; ?>"  style="width:110px;">
<option <?php if ($row['format']=="none") { echo "selected"; } ?>>none</option>
<option <?php if ($row['format']=="EPS") { echo "selected"; } ?>>EPS</option>
<option <?php if ($row['format']=="PDF") { echo "selected"; } ?>>PDF</option>
<option <?php if ($row['format']=="other") { echo "selected"; } ?>>other</option>
<option <?php if ($row['format']=="EPS Problem") { echo "selected"; } ?>>EPS Problem</option>
</select>
</td>
<td class="<?php  echo $class; ?>">
<select autocomplete="off" id="newPrinter_<?php  echo $row['id']; ?>" onchange="zmena(<?php  echo $row['id']; ?>);"  class="<?php  echo $class; ?>"  style="width:50px;">
<option <?php if ($row['new_printer']=="Old") { echo "selected"; } ?>>Old</option>
<option <?php if ($row['new_printer']=="New") { echo "selected"; } ?>>New</option>
</select>
</td>

<td class="<?php  echo $class; ?>"><?php  //echo $row['status']; ?>
<select autocomplete="off" id="status_<?php  echo $row['id']; ?>" onchange="zmena(<?php  echo $row['id']; ?>,2);"  class="<?php  echo $class; ?>" >
<option value="none" <?php if ($row['status']=="none") { echo "selected"; } ?>>none</option>
<option value="printed" <?php if ($row['status']=="printed") { echo "selected"; } ?>>printed</option>
<option value="up" <?php if ($row['status']=="up") { echo "selected"; } ?>>up</option>
<option value="done" <?php if ($row['status']=="done") { echo "selected"; } ?>>done</option>
<option value="hold" <?php if ($row['status']=="hold") { echo "selected"; } ?>>hold</option>
<?php if ($row['status']=="archive") { ?><option value="archive" selected>archive</option><?php } ?>
</select>
</td>
<td class="<?php  echo $class; ?>"><?php  echo $row['s_change']; ?></td>
<td class="<?php  echo $class; ?>"><input autocomplete="off" id="ebay_<?php  echo $row['id']; ?>" onchange="zmena(<?php  echo $row['id']; ?>);" maxlength="50" class="<?php  echo $class; ?>" type="text" value="<?php echo $row['ebay']; ?>"></td>
<td class="<?php  echo $class; ?>"><input autocomplete="off" id="notes_<?php  echo $row['id']; ?>" onchange="zmena(<?php  echo $row['id']; ?>);"  maxlength="1000" class="<?php  echo $class; ?>" type="text" value="<?php echo $row['notes']; ?>"></td>
<td class="<?php  echo $class; ?>"><input autocomplete="off" id="payment_<?php  echo $row['id']; ?>" onchange="zmena(<?php  echo $row['id']; ?>);"  maxlength="1000" class="<?php  echo $class; ?>" type="text" value="<?php echo $row['payment']; ?>"></td>
<td class="<?php  echo $class; ?>">&nbsp;<?php if ($row['status']<>"archive") { ?><img  style="cursor:pointer;" src="images/delete.png" title="delete" alt="delete" onclick="vymaz('<?php  echo $row['id']; ?>', '<?php echo addslashes($row['design']); ?>');" /><?php } ?>&nbsp;</td>
</tr>
<?php
}
?>

</table>

<?php
mysqli_free_result($result);
} // login OK
else
{
	header("Location: index.htm");
}
$mysqli -> close();
?>
<span class="db">&copy; 2008-<?php echo date("Y"); ?> <a href="http://www.norwes.eu/" STYLE="text-decoration:none;">Norwes Technologies, Ltd.</a> - Version: 3.0.1</span>
<?php ob_end_flush(); ?>
</body>
</html>
