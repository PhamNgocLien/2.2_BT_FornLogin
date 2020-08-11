<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form login</title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: solid 1px #ccc;
    }
</style>
<body>
<form method="POST">
    <input id="username" type="text" name="username" placeholder="Innput username">
    <input id="email" type="email" name="email" placeholder="Input email">
    <input id="phone" type="phone" name="phone" placeholder="Input phone">
    <input id="submit" type="submit" value="login">
</form>
<?php
function readDataJSON($filename)
{
    $jsondata = file_get_contents($filename);
    $arr_data = json_decode($jsondata, true);
    return $arr_data;
}

function saveDataJSON($filename,$contact)
{
    try {
        $arr_data = readDataJSON($filename);
        array_push($arr_data, $contact);
        $jsondata = json_encode($arr_data);
        file_put_contents($filename, $jsondata);
        echo "Lưu dữ liệu thành công!";
    } catch (Exception $e) {
        echo 'Lỗi: ', $e->getMessage(), "\n";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    if (empty($username) || empty($email) || empty($phone)) {
        echo 'Please input all';
    }
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    if ($checkEmail == false) {
        echo 'Email format is wrong. Please input again';
    }
    $contact = array(
        'username' => $username,
        'email' => $email,
        'phone' => $phone
    );
    readDataJSON("users.json");
    saveDataJSON("users.json", $contact);
}
?>
</body>
</html>