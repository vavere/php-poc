<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php

echo '<p>Hello World</p>';

$db = new mysqli("db","dev","xyz","dev");
foreach ( $db->query('SELECT * FROM users') as $row ) {
 print_r($row);
}
$db->close();

?>
</body>
</html>
