--TEST--
Proof of concept backport of enums from future
--FILE--
<?php

macro ·unsafe {
    enum T_STRING·name {
        ·ls
        (
            ·word()·field
            ,
            ·token(',')
        )
        ·fields
    }
} >> {
    class T_STRING·name {
        private static $store;

        private function __construct(){}

        static function __(string $field) : self {
            if(! self::$store) {
                self::$store = new \stdclass;
                ·fields ··· {
                    self::$store->·field = new class extends T_STRING·name {};
                }
            }

            if (! $field = self::$store->$field ?? false)
                throw new \Exception(
                    "Undefined enum field " . __CLASS__ . "->{$field}.");

            return $field;
        }
    }
}

macro { \·ns()·enum_name->T_STRING·field } >> { \·enum_name::__(··stringify(T_STRING·field)) }

enum Fruits {
    Apple,
    Orange
}

var_dump(\Fruits->Orange <=> \Fruits->Apple);

$a->b->c->d;

?>
--EXPECTF--
<?php

class Fruits {
        private static $store;

        private function __construct(){}

        static function __(string $field) : self {
            if(! self::$store) {
                self::$store = new \stdclass;
                self::$store->Apple = new class extends Fruits {};
                self::$store->Orange = new class extends Fruits {};
                
            }

            if (! $field = self::$store->$field ?? false)
                throw new \Exception(
                    "Undefined enum field " . __CLASS__ . "->{$field}.");

            return $field;
        }
    }

var_dump(\Fruits::__('Orange') <=> \Fruits::__('Apple'));

$a->b->c->d;

?>
