<!doctype html>
<html>
<head>
     <style>
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
border-style: solid;
            padding: 5.5px;
  
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            opacity: 1;
            
            
            
}
        
        </style>
<meta charset="utf-8">
<title>Dispatch</title>
    <link href="logacallCss.css" rel="stylesheet" type="text/css">
</head>

<body>
   
    
        
	<?php require 'nav.php' ?>
    
<?php //if post back
	if (isset($_POST["btnDispatch"]))
	{
		require_once 'db_config.php';
		
		//create database connection
		$mysqli = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
		//check connection
		if ($mysqli->connect_errno)
		{
			die("Unable to connect to database(MySql): ".$mysqli->connect_errno);
		}
		
		$patrolcarDispatched = $_POST["chkPatrolcar"]; 
       
        // array of patrolcar being dispatched from post back
		$numOfPatrolcarDispatched = count($patrolcarDispatched);
		
		//insert new incident
		$incidentStatus;
		if ($numOfPatrolcarDispatched > 0)
		{
			$incidentStatus='2'; 
            
            //incident status to be set as Dispatched
		}
		else
		{
			$incidentStatus='1'; 
            
        //incident status to be set as Pending
		}
		
		$sql = "INSERT INTO incident (callerName, phoneNumber, 	incidentTypeid, incidentLocation, incidentDesc, 	incidentStatusld)
		VALUES (?, ?, ?, ?, ?, ?)";
		
		if(!($stmt = $mysqli->prepare($sql)))
		{
			die("Prepare failed: ".$mysqli->errno);
		}
		
		if(!$stmt->bind_param('ssssss', 
                              
                              $_POST['callerName'],
							 			$_POST['contactNo'],
							  			$_POST['incidentType'],
							  			$_POST['location'],
							  			$_POST['description'],
							 			$incidentStatus))
		
		{
			die("Binding parameters failed: ".$stmt->errno);
		}
		
		if (!$stmt->execute())
		{
			die("Insert incident table failed: ".$stmt->errno);
		}
        
         // retrieve incident_id for the newly inserted incident 
                
$incidentId=mysqli_insert_id($mysqli);; 
// update patrolcar status table and add into dispatch table 

for ($i=0; $i < $numOfPatrolcarDispatched; $i++)
{ 
// update patro car status 
$sql = "UPDATE patrolcar SET patrolcarStatusId ='1' WHERE patrolcarId = ?"; 

if (!($stmt = $mysqli->prepare($sql))) {
    die("Prepare failed: ".$mysqli->errno);
}
    
if (!$stmt->bind_param('s', $patrolcarDispatched[$i])){
    die("Binding parameters failed: ".$stmt->errno); }
    
if (!$stmt->execute()) {
    die("Update patrolcar_status table failed: ".$stmt->errno); 
}
                
// insert dispatch data 
$sql = "INSERT INTO dispatch (incidentId, patrolcarId, timeDispatched) VALUES (?, ?, NOW())"; 

if (!($stmt = $mysqli->prepare($sql))) { 
    die("Prepare failed: ".$mysqli->errno);
}
                        
if (!$stmt->bind_param('ss', $incidentId, $patrolcarDispatched[$i])){ 
    
    die("Binding parameters failed: ".$stmt->errno); 
                                                    
}
if (!$stmt->execute()) {
    die("Insert dispatch table failed: ".$stmt->errno); 
}
                       }
                
                 
                 $stmt->close();
                 $mysqli->close();
    }
    ?>
    
        
        
    
    
    
    
    
    
   
    <form name"forml" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?> ">
        <div class="container">
        <table  id="t01" align="center"  table width="960" height="500" border="1" cellpadding="12" cellspacing="0"> 
            <tr> 
            <td colspan="2" align="center"><b>Incident Detail</b></td>
                    </tr>
           
            
            
            <tr> 
               <td><b>Caller's Name :</b></td> 
            <td>
               <?php echo $_POST['callerName'] ?>
                <input type="hidden" name="callerName" id="callerName" value="<?php echo $_POST['callerName'] ?>"> </td>
               </tr>
               
        
            
             <tr>
        <td><b>Contact No :</b></td>
        <td><?php echo $_POST['contactNo']?> <input type="hidden" name="contactNo" id="contactNo" value="<?php echo $_POST['contactNo']?>"> </td>
        </tr>
            
            
            
            
            
   <tr>
<td><b>Location :</b></td>
<td><?php echo $_POST['location'] ?>
<input type="hidden" name="location" id="location"
value="<?php echo $_POST['location'] ?>"></td>	
</tr>
            
            <tr>
            <td><b>Incident Type :</b></td>
            <td><?php echo $_POST['incidentType'] ?> <input type="hidden" name="incidentType" id="incidentType" value="<?php echo $_POST['incidentType']?>"> 
        
        </td>
            </tr>
          
            
            
            
            <tr>
                <td><b>Description :</b></td>
                <td><textarea name="description" cols="45" rows="5" readonly id="description"><?php echo $_POST['description']?> </textarea>
            <input name="description" type="hidden" id="description" value="<?php echo $_POST['description']?>"></td>
            </tr>
          
        
        
        </table>
            
            </div>
    <?php 
// connect to a database
require_once'db_config.php';
	
// create database connection
$mysqli = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
// check connection
if($mysqli->connect_errno) 
{
	die("Failed to connect to MySQL: ".$mysqli->connect_errno);
}

// retrieve from patrolcar table those patrol cars that are 2:Patrol or 3:Free
$sql = "SELECT patrolcarId, statusDesc FROM patrolcar JOIN patrolcar_status
ON patrolcar.patrolcarStatusId=patrolcar_status.StatusId
WHERE patrolcar.patrolcarStatusId='2' OR patrolcar.patrolcarStatusId='3'";

	if (!($stmt = $mysqli->prepare($sql)))
	{
		die("Prepare failed: ".$mysqli->errno);
	}
	if (!$stmt->execute())
	{
		die("Cannot run SQL command: ".$stmt->errno);
	}
	if(!($resultset = $stmt->get_result()))
	{
		die("No data in resultset: ".$stmt->errno);
	}
	
	$patrolcarArray; // an array variable
	
	while  ($row = $resultset->fetch_assoc()) 
	{
		$patrolcarArray[$row['patrolcarId']] = $row['statusDesc'];
	}
                   
	
	$stmt->close();
	$resultset->close();
	$mysqli->close();
	?>
   
        
        
        <br><br>
         
            <table id="t01" border="1" align="center"> 
            <tr> 
                <td colspan="3" align="center"><b>Dispatch Patrolcar Panel</b><td> 
    </tr> 
            
        <?php 
            foreach($patrolcarArray as $key=>$value){ 
?> 
    <tr> 
    <td><input type="checkbox" name="chkPatrolcar[]" value="<?php echo $key?>">
    </td> 
    <td><?php echo $key ?></td>
    <td><?php echo $value ?></td>
        
    </tr> <?php } ?> 
            </table>
        <table align="center">
    <tr>
    <td><input class="button" type="reset" name="btnCancel" id="btnCancel" value="Reset"> </td>
    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  class="button" type="submit" name="btnDispatch" value="Dispatch">
</td>
        </tr>                                                              
        </table>
        
        
    </form>
    
    <br>
<footer>
    <p>&copy;&nbsp;Copyright&nbsp;2020&nbsp;<strong>POLICE EMERGENCY SERVICE SYSTEM</strong> &nbsp;All rights reserved&nbsp;</p> 
</footer>

</body>
</html>
