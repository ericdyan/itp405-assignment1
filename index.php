<?php
  $pdo = new PDO('sqlite:chinook.db');
  $sql = "
    SELECT genres.Name
    FROM genres
  ";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $genres = $statement->fetchAll(PDO::FETCH_OBJ);
  // var_dump($genres);
  // echo $genres[0]->Name;

  // die();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Assignment 2</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  </head>
  <body>
    <table class="table">
      <tr>
        <th><h3>Genres</h3></th>
      </tr>
      <?php foreach($genres as $genre) :?>
        <tr>
          <th>
            <a href="tracks.php?genre=<?php echo $genre->Name ?>"><?php echo $genre->Name ?></a>
          </th>
        </tr>
      <?php endforeach ?>
    </table>


  </body>
</html>
