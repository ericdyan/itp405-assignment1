<?php
$pdo = new PDO('sqlite:chinook.db');
$sql = "
  SELECT tracks.Name AS TrackName, albums.Title AS AlbumTitle,
  artists.Name AS ArtistName, tracks.UnitPrice AS UnitPrice
  FROM tracks
  JOIN albums
  ON tracks.AlbumId = albums.AlbumId
  JOIN artists
  ON albums.ArtistId = artists.ArtistId
  JOIN genres
  ON tracks.GenreId = genres.GenreId
";

if(isset($_GET['genre']) && !empty($_GET['genre'])){
  $sql = $sql . 'WHERE genres.Name = ?';
}

$statement = $pdo->prepare($sql);

if(isset($_GET['genre']) && !empty($_GET['genre'])) {
  $statement->bindParam(1, $_GET['genre']);
}

$statement->execute();
$tracks = $statement->fetchAll(PDO::FETCH_OBJ);
// var_dump($tracks);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Assignment 1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  </head>
  <body>
    <table class="table">
      <tr>
        <th>
          <?php echo 'Showing ' . count($tracks) . ' results.';  ?>
        </th>
      </tr>
      <tr>
        <th>Track Name</th>
        <th>Album Title</th>
        <th>Artist Name</th>
        <th>Unit Price</th>
      </tr>
      <?php foreach($tracks as $track) :?>
        <tr>
          <td>
            <?php echo $track->TrackName ?>
          </td>
          <td>
            <?php echo $track->AlbumTitle ?>
          </td>
          <td>
            <?php echo $track->ArtistName ?>
          </td>
          <td>
            <?php echo $track->UnitPrice ?>
          </td>
        </tr>
      <?php endforeach ?>
    </table>

  </body>
</html>
