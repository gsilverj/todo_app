<?php
/**
 * Created by PhpStorm.
 * User:            Gabriell J.
 * Date:            3/5/14
 * Time:            11:09 AM
 * Project Name:    Functions.php (tasks.dev/lib/core/Functions.php   project)
 */

const DS = '/';

//this function is not my work (gabriell J.)
/*
 * source          : http://stackoverflow.com/questions/173400/php-arrays-a-good-way-to-check-if-an-array-is-associative-or-sequential
 * creator(assumed): 'Captain KurO'
 *
 * purpose         : this function checks if an array is associative. returns a bool.
 */
function is_assoc($array) {
    return (bool)count(array_filter(array_keys($array), 'is_string'));
}