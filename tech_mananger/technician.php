<?php
class Technician {
    private $techID, $firstName, $lastName, $email, $phone, $password;

    public function __construct($techID, $firstName, $lastName, $email, $phone, $password) {
        $this->techID = $techID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }

    public function getTechID() {
        return $this->techID;
    }

    public function setTechID($techID) {
        $this->techID = $techID;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getFullName() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

}
?>