<?php 

if (isSet($_POST['function'])) {
	require_once dirname(__FILE__) . "/../../opensrs/spyc.php";

	// Form data capture
	$formFormat = $_POST["format"];

	// Put the data to the Formatted array
	$callstring = "";
	$callArray = array (
		"func" => $_POST["function"],
		"data" => array (
			"admin_username" => $_POST["admin_username"],
			"admin_password" => $_POST["admin_password"],
			"admin_domain" => $_POST["admin_domain"],
			"domain" => $_POST["domain"],
			"workgroup" => $_POST["workgroup"],
			"mailbox" => $_POST["mailbox"],
			"forward_email" => $_POST["forward_email"]
		)
	);
	
	if ($formFormat == "json") $callstring = json_encode($callArray);
	if ($formFormat == "yaml") $callstring = Spyc::YAMLDump($callArray);


	// Open SRS Call -> Result
	require_once dirname(__FILE__) . "/../..//opensrs/openSRS_loader.php";
	$osrsHandler = processOpenSRS ($formFormat, $callstring);

	// Print out the results
	echo (" In: ". $callstring ."<br>");
	echo ("Out: ". $osrsHandler->resultFormatted);

} else {
	// Format
	if (isSet($_GET['format'])) {
		$tf = $_GET['format'];
	} else {
		$tf = "json";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
	<title></title>
	<meta name="generator" http-equiv="generator" content="Claire Lam" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="en"/>
</head>
<body>

<form action="test-mailCreateMailboxForwardOnly.php" method="post">
	<input type="hidden" name="format" value="<?php echo($tf); ?>">
	<input type="hidden" name="function" value="mailCreateMailboxForwardOnly">

	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr><td><b>Authentication</b></td></tr>
		<tr>
			<td width="100%"><span class="headLine">admin username </span> <input type="text" name="admin_username" value="" class="frontBox"></td>
		</tr>
		<tr>
			<td width="100%"><span class="headLine">admin password </span> <input type="text" name="admin_password" value="" class="frontBox"></td>
		</tr>
		<tr>
			<td width="100%"><span class="headLine">admin domain </span> <input type="text" name="admin_domain" value="" class="frontBox"></td>
		</tr>
		<tr><td><b>Required</b></td></tr>
		<tr>
			<td width="100%"><span class="headLine">domain </span> <input type="text" name="domain" value="" class="frontBox"></td>
		</tr>
		<tr>
			<td width="100%"><span class="headLine">workgroup </span> <input type="text" name="workgroup" value="" class="frontBox"></td>
		</tr>
		<tr>
			<td width="100%"><span class="headLine">mailbox </span> <input type="text" name="mailbox" value="" class="frontBox"></td>
		</tr>
		<tr>
			<td width="100%"><span class="headLine">forward email </span> <input type="text" name="forward_email" value="" class="frontBox"></td>
		</tr>
		<tr><td><b>Optional</b></td></tr>
		<tr>
			<td width="100%"><span class="headLine">spam level </span> <input type="text" name="spam_level" value="" class="frontBox"></td>
		</tr>
		<tr>
			<td><input value="Create Mailbox" type="submit"></td>
		</tr>
	</table>
</form>
	
</body>
</html>

<?php 
}
?>
