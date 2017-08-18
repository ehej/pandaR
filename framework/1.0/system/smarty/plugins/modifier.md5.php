<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_modifier_md5($string)
{
    return md5($string);
}

/* vim: set expandtab: */

?>
