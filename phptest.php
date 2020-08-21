<!DOCTYPE html>
<html>
<?php
	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "phptest";
	$conn = mysqli_connect($server, $username, $password, $database);

 	$results = $conn->query("SELECT U.id, CONCAT( U.first_name, ' ', U.last_name ) as full_name, GROUP_CONCAT( T.name ) as team_names FROM users U LEFT JOIN teams_users TU ON U.id = TU.user_id LEFT JOIN teams T ON TU.team_id = T.id GROUP BY U.id");

 	$users = array();
 	
 	while($row = $results->fetch_assoc()) {
		$users[] = $row;
	}


?>

<head>
	<title>PHP Test</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<style>
		div.top-space{
			margin-top: 15%;
		}
		th {
			font-size: 40px;
		}
		td {
			font-size: 20px;
		}
	</style>
</head>
<body>
	<div class="container top-space">
		<table class="table table-bordered">
			<tr>
				<th class="col-sm">id</th>
				<th class="col-sm">name</th>
				<th class="col-sm">teams</th>
			</tr>
			<?php if(count($users) > 0) { ?>
				<?php foreach($users as $id=>$user) {  ?>
					<tr>
						<td class="col-sm"><?php echo $user['id'] ?></td>
						<td class="col-sm"><?php echo $user['full_name']?></td>
						<td class="col-sm"><?php echo $user['team_names'] ?></td>
					</tr>
	    		<?php } ?>	
	    	<?php } ?>
	    	
	    	<?php if(count($users) === 0) { ?>
	    		<tr>
	    			<td colspan="3">There is No data......Please check your data.....</td>
	    		</tr>
	    	<?php } ?>
		</table>
	</div>		
</body>
</html>