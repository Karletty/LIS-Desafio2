<?php
function isEmpty($var)
{
      return empty(trim($var));
}

function isText($var)
{
      return preg_match('/^[a-zA-Z ]+$/', $var);
}

function isNumeric($var)
{
      return isNumeric(trim($var));
}

function isEmail($var)
{
      return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function isIdCategory($var)
{
      return preg_match('/^CAT[0-9]{3}$/', $var);
}

function isIdProduct($var)
{
      return preg_match('/^PROD[0-9]{5}$/', $var);
}
