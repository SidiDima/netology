<?php

// выставляем кодировку всего кода
mb_internal_encoding('UTF-8');

echo("Введите Фамилия" . PHP_EOL);
$checkSurname = false;
while ($checkSurname === false) {
    $surname = trim(fgets(STDIN));
    if (preg_match('/\d/', $surname)) {
        fwrite(STDERR, "Фамилия не должна содержать цифры" . PHP_EOL);
    } else {
        $checkSurname = true;
    }
}

echo("Введите Имя" . PHP_EOL);
$checkName = false;
while ($checkName === false) {
    $name = trim(fgets(STDIN));
    if (preg_match('/\d/', $name)) {
        fwrite(STDERR, "Имя не должно содержать цифры" . PHP_EOL);
    } else {
        $checkName = true;
    }
}

echo("Введите Отчество" . PHP_EOL);
$checkPatronymic = false;
while ($checkPatronymic === false) {
    $patronymic = trim(fgets(STDIN));
    if (preg_match('/\d/', $patronymic)) {
        fwrite(STDERR, "Отчество не должно содержать цифры" . PHP_EOL);
    } else {
        $checkPatronymic = true;
    }
}

$fullName = "$surname $name $patronymic";
echo('Значение переменной $fullName: ' . $fullName . PHP_EOL);

//Через строки
$fioStr = mb_strtoupper(mb_substr($surname, 0, 1, 'UTF-8')) . mb_strtoupper(mb_substr($name, 0, 1, 'UTF-8')) . mb_strtoupper(mb_substr($patronymic, 0, 1, 'UTF-8'));
echo('Вариант через работу со строками. Значение переменной $fio: ' . $fioStr . PHP_EOL);

//Через регулярное выражение
$regex = '/(\w{1})\w+ ?/u';
$matches = [];
preg_match_all($regex, $fullName, $matches);
$fioReg = '';
foreach ($matches[1] as $match) {
    $fioReg .= mb_strtoupper($match);
}
echo('Вариант через работу со строками. Значение переменной $fio: ' . $fioReg . PHP_EOL);

$surnameAndInitials = mb_convert_case($surname, MB_CASE_TITLE) . ' ' . mb_strtoupper(mb_substr($name, 0, 1)) . '.' . mb_strtoupper(mb_substr($patronymic, 0, 1)) . '.';
echo('Значение переменной $fio: ' . $surnameAndInitials . PHP_EOL);