<?php

include_once "./user_models/customer.php";

class CustomerController
{
    private $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

    # for Customer
    public function getAllCustomer()
    {
        return $this->customer->getAllCustomer();
    }

    public function getCustomer($customer)
    {
        return $this->customer->getCustomer($customer);
    }

    // put Customer
    public function putCustomer($username, $email, $password, $address, $fname, $birthdate)
    {
        return $this->customer->putCustomer($username, $email, $password, $address, $fname, $birthdate);
    }

    // is Customer valid
    public function getCustomerValid($customer)
    {
        return $this->customer->getCustomerValid($customer);
    }
}
