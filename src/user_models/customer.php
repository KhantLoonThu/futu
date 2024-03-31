<?php

include_once "./includes/db.php";

class Customer
{
    private $con, $statement;
    # Customer

    // get all Customer 
    public function getAllCustomer()
    {
        $this->con = Database::connect();
        $sql = "SELECT * FROM customers";
        $this->statement = $this->con->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    // put Customer into database
    public function putCustomer($username, $email, $password, $address, $fname, $birthdate)
    {
        $this->con = Database::connect();
        $sql = "INSERT INTO customers(name, email, password, address, thumb, birth_date) VALUE(:name, :email, :password, :address, :fname, :birthdate)";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":name", $username);
        $this->statement->bindParam(":email", $email);
        $this->statement->bindParam(":password", $password);
        $this->statement->bindParam(":address", $address);
        $this->statement->bindParam(":fname", $fname);
        $this->statement->bindParam(":birthdate", $birthdate);
        return $this->statement->execute();
    }

    // for checking already exist
    public function getCustomerValid($Customer)
    {
        $this->con = Database::connect();
        $sql = "SELECT count(*) as total FROM customers WHERE name = :Customer";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":Customer", $Customer);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    // for individual Customer
    public function getCustomer($email)
    {
        $this->con = Database::connect();
        $sql = "SELECT * FROM customers WHERE email = :email";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":email", $email);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }
}
