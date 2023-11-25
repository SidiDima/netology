<?php
    $check1 = false;
    echo ("Введите первое число" .PHP_EOL);
    while ($check1 === false) {
        $numb1 = trim(fgets(STDIN));
        if ((is_numeric($numb1)===false) || (bcmod($numb1, 2))>0) {
            fwrite(STDERR, "Введите, пожалуйста, число".PHP_EOL);
        } else {
            $check1 = true;
        }
    }
    $check2 = false;
    echo ("Введите второе число" .PHP_EOL);
    while ($check2 === false) {
        $numb2 = trim(fgets(STDIN));
        if ((is_numeric($numb2)===false) || ((bcmod($numb2, 2))>0) || ($numb2 == "0")) {
            if ($numb2 == "0") {
                fwrite(STDERR, 'Делить на 0 нельзя' .PHP_EOL);
            }
            fwrite(STDERR, "Введите, пожалуйста, число".PHP_EOL);
        } else {
            $check2 = true;
        }
    }
    fwrite(STDOUT, "Результат деления:". $numb1/$numb2 .PHP_EOL);
