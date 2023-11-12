<?php
require_once "helper.php";

$phone = $_POST['phoneNumber'];

if (!validate($phone, 'required|min:3|max:20')) return "Проверьте введённый вами номер.";

$result = checkPhoneMask($_POST['phoneNumber']);

$message = 'Вы ввели неверный номер, либо он не принадлежит известным нам странам.';

if ($result) $message = "Введённый вами номер принадлежит стране $result";

redirect("/", ['message' => $message]);