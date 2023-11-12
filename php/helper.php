<?php
function view(string $name): bool {
    $path =  "html/" . implode('/', explode('.', $name)) . '.php';
    if (file_exists($path)) {
        return include $path;
    }
    return false;
}

function redirect(string $url, array $params): void
{
    $url .= "?" . http_build_query($params);

    header("Location: $url");
}

function validate(string $text, string $rules): bool {
    $rules = explode('|', $rules);

    foreach ($rules as $rule) {
        [$ruleName, $ruleValue] = explode(':', $rule);

        if ($ruleName == 'min') {
            if (strlen($text) < $ruleValue) return false;
        }
        if ($ruleName == 'max') {
            if (strlen($text) > $ruleValue) return false;
        }
        if ($ruleName == 'require') {
            if (!$text) return false;
        }
    }
    return true;
}

function checkPhoneMask($phone): string|bool {
    $masks = getArrayOfMasks();

    return findPhoneCountry($masks, $phone);
}

function getArrayOfMasks(): array {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://cdn.jsdelivr.net/gh/andr-04/inputmask-multi@master/data/phone-codes.json');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_close($ch);
    return json_decode(curl_exec($ch));
}

function findPhoneCountry($masks, $phone): string|bool {
    foreach ($masks as $phoneMask) {
        $editPhoneNumber = str_replace(array(" ", "+", "-", "(", ")"), '', $phone);

        $checkPhoneMask = $phoneMask->mask;
        $checkPhoneMask = str_replace(array(" ", "+", "-", "(", ")"), '', $checkPhoneMask);

        $count  = strlen(preg_replace('/[^\d]/','',$checkPhoneMask));

        for ($i = $count; $i < strlen($editPhoneNumber); $i++) $editPhoneNumber[$i] = '#';

        if ($editPhoneNumber === $checkPhoneMask) {
            return $phoneMask->name_ru;
        }
    }

    return false;
}