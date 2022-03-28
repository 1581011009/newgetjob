<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>會員</title>
</head>

<body>

    <?php
include("connect.php");

$sql = "SELECT * FROM article";
if ($stmt = $db->query($sql)) {
    while ($result = mysqli_fetch_object($stmt)) {
        echo '<p>ID: ' . $result->ID . ',Job: ' . $result->Job . '</p>';
    }
}
?>
</body>

</html>