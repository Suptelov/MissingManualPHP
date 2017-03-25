<?php

// Регулярные варажения IN DA BUILDING
// MUST SEE
// Вот ЗДЕСЬ РЕГУЛЯРНЫЕ ВЫРАЖЕНИЯ
// * - говорит не важно сколько пробелов
// i - говорит, не важно какой регистр
// ^ - Искать регулярку в начале строки

    $str_to_search="John Steals steal meat";
    $regex="/ea/";
    $matches=preg_match($regex, $str_to_search);
    if ($matches>0)
    {
        echo "<p>we find something \n :D</p>";
    }
    else
    {
        echo "<p>sorry we dont have any matches :C</p>";
    }
?>

