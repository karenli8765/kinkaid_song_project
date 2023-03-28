<!DOCTYPE html>
<html>
<head>
<title>Songs</title>
<style type="text/css">
	table {border-spacing:0; width: 100%}
	td { border: 1px solid black;}
</style>
</head>
<body>
<?php
	echo("<p><b>Songs</p></b>");
	require("../db1_connector.php");
	//deciding whether there needs to be a command or not
	if (ISSET($_REQUEST['command']))
	{
		$command = $_REQUEST['command'];
	}
	else 
	{
		$command = "None";
	}
	
	//if there needs to be rows added
	if ($command == "Add")
	{
		$title_to_add = $_REQUEST['title'];
		$artist_to_add = $_REQUEST['artist'];
		$genre_to_add = $_REQUEST['genre'];
		$date_to_add = $_REQUEST['release_date'];
	
		$add_query = "INSERT INTO songs (title,artist,genre,release_date) VALUES ('$title_to_add','$artist_to_add','$genre_to_add',$date_to_add );";	
		$add_succeeded = mysqli_query($db_connection,$add_query);
	}
	
	//deleting
	if ($command == "Yes, Delete")
{
	$id = $_REQUEST["song_id"];
	$delete_query = "DELETE FROM songs WHERE song_id=$id ;";
	
	$delete_succeeded = mysqli_query($db_connection,$delete_query);
	if ($delete_succeeded == true)
	{
		echo("<p>Deleted.</p>\n");	
	}
}

	//editin
	if ($command == "Update")
{
   $id = $_REQUEST['song_id'];
	$title_to_change = $_REQUEST['title'];
	$artist_to_change = $_REQUEST['artist'];
	$genre_to_change = $_REQUEST['genre'];
	$date_to_change = $_REQUEST['release_date'];

	$change_query = "UPDATE songs SET title='$title_to_change',artist='$artist_to_change',
	                 genre='$genre_to_change',release_date=$date_to_change WHERE song_id = $id ;";

	echo("DEBUG: $change_query \n");
	$change_succeeded = mysqli_query($db_connection,$change_query);
	if ($change_succeeded == true)
	{
		echo("<p>Updated.</p>\n");	
	}	
	
}


	//getting the table to show up on the page
	$query = "SELECT * FROM songs";
	$query_result = mysqli_query($db_connection,$query);
	echo ("<form method= 'get' action = 'EditDeleteSong.php'>\n");
	echo ("<table>\n");
	echo ("<tr><th>Select</th><th>Title</th><th>Artist</th><th>Genre</th><th>Release Date</th></tr>\n");
while ($row = mysqli_fetch_array($query_result))
{
	$id = $row['song_id'];
	$title = $row['title'];
	$artist = $row['artist'];
	$genre = $row['genre'];
	$release = $row['release_date'];
	$background_color = "white";
   
   //changing the row color depending on the genre
   if($genre == 'Pop')
   {
   		$background_color = "pink";
	}
	if($genre == 'Alternative/Indie')
   {
   		$background_color = "lightblue";
	}
	 if($genre == 'Rock')
   {
   		$background_color = "lightgreen";
	}
	if($genre == 'Rap')
   {
   		$background_color = "lightyellow";
	}
	if($genre == 'R&B')
   {
   		$background_color = "orange";
	}
	if($genre == 'Other') {
		$background_color = "lightgrey";
	}
	
   echo ("<tr style='background-color: " .$background_color);
   echo(" '><td><input type='radio' name='selection' value='$id'></td>");
   echo("<td>$title</td><td>$artist</td><td>$genre</td><td>$release</td></tr>\n");

}
echo ("</table>");
	echo ("<a href = 'AddSong.html'>Add Song</a><input type = 'submit' name='command' value = 'Delete' />
       <input type = 'submit' name='command' value = 'Edit' />\n");
	echo ("</form>\n");
?>
</body>
</html>