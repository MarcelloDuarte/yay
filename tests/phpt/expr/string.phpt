--TEST--
test for ·expr() T_CONSTANT_ENCAPSED_STRING
--FILE--
<?php

macro {
   ·expr()·my_expr
} >> {
expression {
    ·my_expr
}
}

'single quotes string literal'
"double quotes string literal"

?>
--EXPECTF--
<?php

expression {
    'single quotes string literal'
}
expression {
    "double quotes string literal"
}

?>