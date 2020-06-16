<!doctype html>
<html>
<head>
    <style>
         legend#leg {
             font-weight:bold;    
             padding:1.5em;
             
             border:0px inset rgba(120,189,209,1.00) ;
             box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
             opacity: 1;}
        table#t01 tr:nth-child(even) {
  background-color: #eee;
}
table#t01 tr:nth-child(odd) {
 background-color: #fff;
}
table#t01 th {
  background-color: black;
  color: white;
    
}
        table#t01 {
  width: 50%;    

  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            opacity: 1;
            
            
            
}
        
        </style>
<meta charset="utf-8">
<title>Police Emergency Service System</title>
<link href="logacallCss.css" rel="stylesheet" type="text/css">
          
</head>

<body> 
    
    <script> function validation() 
        { 
            var x=document.forms["frmLogCall"]["callerName"].value; 
            if (x==null || x=="") 
        { 
alert("Caller Name is required.");
return false; 
                                               }
                                               }
// may add code for validating other inputs 
            
        function validation() {
		var x = document.forms["frmLogCall"]['description'].value;
		if(x == "") {
			alert("Description Must Be Filled Out!");
			return false;
		}
	}
        
</script> 

    
    
    
    <?php require 'nav.php';?> 
    <?php require 'db_config.php'; 
    
$mysqli = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE); 
if ($mysqli->connect_errno) 
{ 
die("Failed to connect to MySQL: ".$mysqli->connect_errno); 
} 
    
    
    
    $sql = "SELECT * FROM incidenttype"; 
if (!($stmt = $mysqli->prepare($sql))) 
{
die("Prepare failed: ".$mysq11->errno); 
} 

    if (!$stmt->execute()) 
    {
die("Cannot run SQL command: ".$stmt->orrno); 
} 
    //Check any data in resultset 
    
    if (!($resultset = $stmt->get_result())) {
        die("No data in resultset: ".$stmt->errno); 
    }

    $incidentType;
    
    while ($row = $resultset->fetch_assoc()) { // create an associative array of $incidentType fincident_type_id, incident_type_desc]  width="960" height="500" border="1" align="center" cellpadding="12" cellspacing="0"
        $incidentType[$row['incidentTypeId']] = $row['incidentTypeDesc']; 
} 
    $stmt->close(); 
    
    $resultset->close(); 
    
    $mysqli->close(); 

    ?>
    
    <fieldset> <legend id="leg">Log Call</legend> 
        <form name="frmLogCall" method="post" action="dispatch.php" onSubmit="return validation();"> 
            <table id="t01" width="50%" border="0" align="center" cellpadding="5" cellspacing="5">
                <tr>
                    <td width="40%">Caller's Name</td>
                    <td width="40%"><input type="text" name="callerName" id="callerName" maxlength = "40" required></td>
                    </tr>
                <tr>
                    <td width="40%">Contact Number</td>
                    <td width="40%"><input id="contactNo" name="contactNo" type="tel" size="8" pattern=".{8}" required></td>
                    </tr>
                <tr>
                    <td width="40%">Location</td>
                    <td width="40%"><textarea rows = "2" cols = "50" id="location" name = "location" maxlength = "140" required></textarea></td>
                    </tr>
                <tr>
                    <td width="40%">Incident Type</td>
                    <td width="40%"><select name="incidentType" id="incidentType" required>
                        <?php foreach($incidentType as $key=> $value) {?>
                        <option value="<?php echo $key ?> " >
                            <?php echo $value ?> </option>
                      <?php } ?>
                        
                        </select>
                    </td>
                    </tr>
                <tr>
                 <td width="40%">Description</td>
                    <td width="40%"><textarea rows = "5" cols = "50" maxlength = "340" name = "description" id="description"></textarea></td>
                    </tr>
                
</table> 
            
            
            <table width="50%" border="0" align="center" cellpadding="5" cellspacing="5">
                <tr>
               <td> <button class="button"  type="reset">Reset</button></td>
          <td>  <button class="button" type="submit">Process Call</button></td>
                
                </tr>
                </table>
            </form>
    </fieldset>
<br>
<footer>
    <p>&copy;&nbsp;Copyright&nbsp;2019&nbsp;<strong>POLICE EMERGENCY SERVICE SYSTEM</strong> &nbsp;All rights reserved&nbsp;</p> 
</footer>
</body>
</html>
