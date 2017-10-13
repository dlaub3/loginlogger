<?php

/**
 * I originally learned these validations
 * from Lynda.com.
 */


class Validation
{
    public function validate_password($string, $options)
    {
        $msg = ["error" => [], "success" => []];
        $max = $options['max'];
        $min = $options['min'];

        if (!$this->has_presence($string)) {
            array_push($msg["error"], "The password is empty.");
        }
        if (!$this->has_length_greater_than($string, $min)) {
            array_push($msg["error"], "The password must be at least $min charaters.");
        }
        if (!$this->has_length_less_than($string, $max)) {
            array_push($msg["error"], "The password must be less than $max charaters.");
        }
        if ($msg["error"]) {
            return $msg;
        } else {
            return true;
        }
    }

    public function has_presence(string $value):bool
    {
        return trim($value) !== '';
    }

    public function has_length_greater_than(string $value, int $min):bool
    {
        $length = strlen($value);
        return $length > $min;
    }

    public function has_length_less_than(string $value, int $max):bool
    {
        $length = strlen($value);
        return $length < $max;
    }

    public function has_inclusion_of($value, $set)
    {
        return in_array($value, $set);
    }

    public function has_exclusion_of($value, $set)
    {
        return !in_array($value, $set);
    }

    public function has_valid_email_format($value)
    {
        $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
        return preg_match($email_regex, $value) === 1;
    }
}
