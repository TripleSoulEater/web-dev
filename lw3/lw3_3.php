<?php

$password = $_GET['password'];
$lenPassword = strlen($password);
$reliability = 0;
$countNum = 0;
$countUpperCaseChars = 0;
$countLowerCaseChars = 0;

if ($password !== null){
    if ($password == ''){
        echo 'Введите строку';
    }
    else{
        for ($i = 0; $i < $lenPassword; $i++){
            if (is_numeric($password[$i])){
                $countNum++;
            }    
            if (ctype_upper($password[$i])){
                $countUpperCaseChars++;
            }
            if (ctype_lower($password[$i])){
                $countLowerCaseChars++;
            }
        }

        if ($lenPassword <> 0){
            $reliability += $lenPassword * 4; //прибавляем количество символов * 4
        }
        if ($countNum <> 0){
            $reliability += $countNum * 4; //прибавляем количество цифр * 4
        }
        if ($countUpperCaseChars <> 0){
            if (!ctype_upper($password)){
                $reliability += ($lenPassword - $countUpperCaseChars) * 2; //прибавляем количество символов - кол-во символов в верхнем регистре * 2
            }
        }
        if ($countLowerCaseChars <> 0){
            if(!ctype_lower($password)){
                $reliability += ($lenPassword - $countLowerCaseChars) * 2; //прибавляем количество символов - кол-во в ниж рег * 2
            }
        }
        if (ctype_alpha($password)){
            $reliability -= $lenPassword; //если все буквы, то вычитаем кол-во символов
        }
        if (is_numeric($password)){
            $reliability -= $lenPassword; //если все цифры, то вычитаем кол-во символов
        }
        foreach (count_chars($password, 1) as $i => $value) {
            if ($value <> 1){
                $reliability -= $value; //вычитаем кол-во повторяющихся символов
            }
        }

        echo 'Надежность пароля = ', $reliability;
    }
}
else{
    echo 'Введите данные';
}