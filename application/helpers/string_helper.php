<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('startsWith'))
{
  function startsWith($string, $startString)
  {
    $len = strlen($startString);
    return substr($string, 0, $len) === $startString;
  }
   
}
if ( ! function_exists('endsWith'))
{
  function endsWith($string, $endString)
  {
    $len = strlen($endString);
    if ($len == 0) {
      return true;
    }
    return substr($string, -$len) === $endString;
  }
}