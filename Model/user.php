<?php
    class Employe
    {
        private $lastName;
        private $firstName;
        private $password;
        private $phone;
        private $email;
        private $dOB;

        function get_lastName()
        {
           return $this->lastName;
        }

        function get_firstName()
        {
           return $this->firstName;
        }

        function get_password()
        {
           return $this->password;
        }

        function get_phone()
        {
           return $this->phone;
        }

        function get_email()
        {
           return $this->email;
        }

        function get_dOB()
        {
           return $this->dOB;
        }

        function __construct($lastName,$firstName,$password,$phone,$email,$dOB)
        {
            $this->lastName=$lastName;
            $this->firstName=$firstName;
            $this->password=$password;
            $this->phone=$phone;
            $this->email=$email;
            $this->dOB=$dOB;
        }
    }
?>