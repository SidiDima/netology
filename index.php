<?php
    echo ("Введите Фамилия" .PHP_EOL);
    $checkSurname= false;
    while ($checkSurname === false) {
        $surname = trim(fgets(STDIN));
        if (is_numeric($surname) === true) {
            fwrite(STDERR, "Фамилия не должно содержать цифры" .PHP_EOL);
        } else {
            $checkSurname = true;
        }
    }

    echo ("Введите Имя" .PHP_EOL);
    $checkName = false;
    while ($checkName === false) {
        $name = trim(fgets(STDIN));
        if (is_numeric($name) === true) {
            fwrite(STDERR, "Имя не должна содержать цифры" .PHP_EOL);
        } else {
            $checkName = true;
        }
    }

    echo ("Введите Отчество" .PHP_EOL);
    $checkPatronymic = false;
    while ($checkPatronymic === false) {
        $patronymic = trim(fgets(STDIN));
        if (is_numeric($patronymic) === true) {
            fwrite(STDERR, "Отчество не должно содержать цифры" .PHP_EOL);
        } else {
            $checkPatronymic = true;
        }
    }

    $fullName = $surname." ".$name." ".$patronymic;
    echo('Значение переменной $fullName: '.$fullName .PHP_EOL);

    //Через строки
    $fioStr = strtoupper(substr($surname, 0, 1)). strtoupper(substr($name, 0, 1)). strtoupper(substr($patronymic, 0, 1));
    echo('Вариант через работу со строками. Значение переменной $fio: ' . $fioStr .PHP_EOL);

    //Через регулярное выражение
    $regex = '/(\w{1})\w+ ?/u';
    $matches = []; // переменная, в которую будет записан результат работы функции
    preg_match_all($regex, $fullName, $matches);
    $fioReg = '';
    foreach ($matches[1] as $match) {
        $fioReg .= strtoupper($match);
    }
    echo('Вариант через работу со строками. Значение переменной $fio: ' . $fioReg .PHP_EOL);

    $surnameAndInitials = ucfirst((strtolower($surname))) . ' ' . strtoupper(substr($name, 0, 1)) . '.' . strtoupper(substr($patronymic, 0, 1)) . '.';
    echo('Значение переменной $fio: ' . $surnameAndInitials .PHP_EOL);
