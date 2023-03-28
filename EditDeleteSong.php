<!DOCTYPE html>
<html>
<head>
<title>Edit/Delete Songs</title>
<style type="text/css">

</style>
</head>
<body>
<?php
require("../db1_connector.php");
if (ISSET($_REQUEST['selection']))
{
	$id = $_REQUEST['selection'];
    $command = $_REQUEST['command'];
    $query = "SELECT * FROM songs WHERE song_id = $id;";
    $query_result = mysqli_query($db_connection,$query);
    $row = mysqli_fetch_array($query_result);
    $title = $row['title'];
	 $artist = $row['artist'];
	 $genre = $row['genre'];
	$release = $row['release_date'];
	
	//the "are you sure you want to delete?" page
	if ($command == "Delete")
	 {
		echo("<form method = 'get'	action = 'Songs.php'>\n"); 	
	 	echo("<input type = 'hidden' name='song_id' value='$id' />\n");
		echo("Are you sure you want to delete $title?\n");
		echo("<p><input type='submit' name='command' value='Cancel' />
		         <input type='submit' name='command' value='Yes, Delete' /></p>\n");
	 	echo("</form>");
	 }
	 
	 //the edit page
	  elseif($command == "Edit")
	 {
		echo('<form method = "get" action = "Songs.php">');
		echo("<input type = 'hidden' name='song_id' value='$id' />\n");
		echo('<table>');
   		echo('<tr><td>Title</td><td><input type="text" name="title" value = "'.$title.'"/></td></tr>');
      echo('<tr><td>Artist</td><td><input type="text" name="artist" value = "'.$artist.'"/></td></tr>');
		echo("<tr><td>Genre</td><td>
		<select name='genre'>
		<option value='Pop'>Pop</option>
		<option value='Alternative/Indie'>Alternative/Indie</option>
		<option value='Rock'>Rock</option>
		<option value='Rap'>Rap</option>
		<option value='R&B'>R&B</option>
		<option value='Other'>Other</option>
		</select></td></tr>");
	   echo('<tr><td>Release Date</td><td><input type="number" min = 1500 max = 2020 value='.$release.' name="release_date" />');
	   echo('        </td></tr>');
		echo('</table>');
      echo('<input type="submit" name = "command" value = "Cancel" />');
		echo('<input type="submit" name = "command" value = "Update" />');
		echo('</form>'); 
	 }
	 }
	 else 
	{
 		 echo ("You need to select a song to delete/edit.<br /> <a href='Songs.php'>Return</a>");
	}

?>
</body>
</html>