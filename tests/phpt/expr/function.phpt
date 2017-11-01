--TEST--
test for ·expr() function call
--FILE--
<?php

macro {
   ·expr()·my_expr
} >> {
expression {
    ·my_expr
}
}

strtoupper('a')

?>
--EXPECTF--
<?php

expression {
    strtoupper('a')
}

?>