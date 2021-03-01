<?php

class Validation 
{
    private $password;
    
    /**
     * Check if request method is POST
     *
     * @return void
     */
    public function ifRequestIsPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") return true;
        return false;
    }

    /**
     * Sanitize Post
     *
     * @return void
     */
    public function sanitizePost()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    }

    public function ifRequestIsPostAndSanitize()
    {
        if ($this->ifRequestIsPost()) {
            $this->sanitizePost();
            return true;
        }
        return false;
    }
    
    public function ifEmptyArr($arr)
    {
        foreach ($arr as $errorValue) {
            if (!empty($errorValue)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Validates empty field
     *
     * @param array $data
     * @param string $field
     * @param string $fieldDisplayName
     * @return void
     */
    public function ifEmptyFieldWithReference(&$data, $field, $fieldDisplayName)
    {
        $fieldError = $field . 'Err';
        // Validate Name 
        if (empty($data[$field])) {
            // empty field
            $data['errors'][$fieldError] = "Please enter Your $fieldDisplayName";
        }
    }
    
    /**
     * Checks if given string is empty returns message if empty.
     *
     * @param string $field
     * @param string $msg
     * @return string
     */
    public function validateEmpty($field, $msg)
    {
        return empty($field) ? $msg : '';
    }

    /**
     * if field is empty we return message, else we return empty string
     *
     * @param string $field
     * @return string
     */
    public function validateName($field)
    {
        if (empty($field)) return "Please enter your Name";

        if (!preg_match("/^[a-z ,.'-]+$/i", $field)) return "Name must only contain Name characters";

        return ''; 
    }

     /**
     * if field is empty we return message, else we return empty string
     *
     * @param string $field
     * @return string
     */
    public function validateEmail($field, &$userModel)
    {
        if (empty($field)) return "Please enter Your Email";

        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Please check your email";

        if ($userModel->findUserByEmail($field)) return 'Email already taken';

        return '';
    }

     /**
     * if field is empty we return message, else we return empty string
     *
     * @param string $field
     * @return string
     */
    public function validateLoginEmail($field, &$userModel)
    {
        if (empty($field)) return "Please enter Your Email";

        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Please check your email";

        if (!$userModel->findUserByEmail($field)) return 'Email not found';

        return '';
    }

     /**
     * checks if field is not empty and if password 
     * matches params for strength we return message, 
     * else we return string with error
     *
     * @param string $field
     * @return string
     */
    public function validatePassword($passField, $min, $max)
    {
        if (empty($passField)) return "Please enter a password";

        $this->password = $passField;

        if (strlen($passField) < $min) return "Password must be more than $min characters length";

        if (strlen($passField) > $max) return "Password must be less than $max characters length";

        if (!preg_match("#[0-9]+#", $passField)) return "Password must contain at least one number";

        if (!preg_match("#[a-z]+#", $passField)) return "Password must include at least one letter!";

        if (!preg_match("#[A-Z]+#", $passField)) return "Password must include at least one Capital letter!";

        return '';
    }

     /**
     * if field is empty we return message, else we return empty string
     *
     * @param string $field
     * @return string
     */
    public function confirmPassword($repeatField)
    {
        if (empty($repeatField)) return "Please repeat a password";

        if (!$this->password) return 'no password saved';

        if ($repeatField !== $this->password) return "Password must match";

        return '';
    }
}