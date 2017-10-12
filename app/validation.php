<?php


/**
 * These are not my validation functions
 * but they are great. I'm assuming when
 * writing production code it's ok to
 * borrow from good sources. I have learned a lot
 * from Lynda.com.
 */

function has_presence(string $value):bool
{
    return trim($value) !== '';
}

function has_length_greater_than(string $value, int $min):bool
{
    $length = strlen($value);
    return $length > $min;
}

function has_length_less_than(string $value, int $max):bool
{
    $length = strlen($value);
    return $length < $max;
}

function has_inclusion_of($value, $set)
{
    return in_array($value, $set);
}

function has_exclusion_of($value, $set)
{
    return !in_array($value, $set);
}

function has_valid_email_format($value)
{
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
}
