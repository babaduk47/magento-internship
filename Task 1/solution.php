<?php
function myArrowFunc($n) {
    return str_repeat("<", $n).str_repeat(">", $n);
}

echo myArrowFunc(3);
