<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Echo session variables that were set on previous page
echo "Username" . $_SESSION["email"] . ".<br>";

?>

</body>
</html>