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
        if (empty($field)) return "Įveskite savo vardą";

        if (!preg_match("/^[a-z ,.'-]+$/i", $field)) return "Vardą turi sudaryti tik raidės";

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
        if (empty($field)) return "Įveskite savo el. paštą";

        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Pasitiktinkite savo el. paštą";

        if ($userModel->findUserByEmail($field)) return 'El. paštas jau egzistuoja';

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
        if (empty($field)) return "Įveskite savo el. paštą";

        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Pasitiktinkite savo el. paštą";

        if (!$userModel->findUserByEmail($field)) return 'Toks el. paštas neegzistuoja';

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
    public function validatePassword($passField, $min)
    {
        if (empty($passField)) return "Įveskite slaptažodį";

        $this->password = $passField;

        if (strlen($passField) < $min) return "Slaptažodis per trumpas";

        if (!preg_match("#[0-9]+#", $passField)) return "Slaptažodyje turi būti bent vienas skaičius";

        if (!preg_match("#[a-z]+#", $passField)) return "Slaptažodyje turi būti bent viena raidė";

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
        if (empty($repeatField)) return "Pakartokite slaptažodį";

        if (!$this->password) return 'Įveskite slaptažodį';

        if ($repeatField !== $this->password) return "Slaptažodžiai nesutampa";

        return '';
    }
}