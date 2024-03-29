<?php

include_once "../../includes/db.php";

class Feature
{
    private $con, $statement;
    # feature

    // get all feature 
    public function getAllfeature()
    {
        $this->con = Database::connect();
        $sql = "SELECT * FROM featuretitle";
        $this->statement = $this->con->prepare($sql);
        if ($this->statement->execute()) {
            $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    // put feature into database
    public function putfeature($feature)
    {
        $this->con = Database::connect();
        $sql = "INSERT INTO featuretitle(feature_name) VALUE(:feature)";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":feature", $feature);
        return $this->statement->execute();
    }

    // for checking already exist
    public function getfeatureValid($feature)
    {
        $this->con = Database::connect();
        $sql = "SELECT count(*) as total FROM featuretitle WHERE feature_name = :feature";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":feature", $feature);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    // for individual feature
    public function getfeature($feature)
    {
        $this->con = Database::connect();
        $sql = "SELECT * FROM featuretitle WHERE feature_name = :feature";
        $this->statement = $this->con->prepare($sql);
        $this->statement->bindParam(":feature", $feature);
        if ($this->statement->execute()) {
            $results = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }
}
