<?php
$phoneNumber = $_POST['phoneNumber'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://cdn.jsdelivr.net/gh/andr-04/inputmask-multi@master/data/phone-codes.json');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$result = json_decode($result);
curl_close($ch);

foreach ($result as $phoneMask) {
    $editPhoneNumber = str_replace(array(" ", "+", "-", "(", ")"), '', $phoneNumber);

    $checkPhoneMask = $phoneMask->mask;
    $checkPhoneMask = str_replace(array(" ", "+", "-", "(", ")"), '', $checkPhoneMask);
}

header("Location: /index.php?message=Введённый вами номер не принадлежит известным странам");