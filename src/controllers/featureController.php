<?php

include_once "../../models/feature.php";

class FeatureController
{
    private $feature;

    public function __construct()
    {
        $this->feature = new Feature();
    }

    # for feature
    public function getAllFeature()
    {
        return $this->feature->getAllFeature();
    }

    public function getFeature($feature)
    {
        return $this->feature->getFeature($feature);
    }

    // put Feature
    public function putFeature($feature)
    {
        return $this->feature->putFeature($feature);
    }

    // is Feature valid
    public function getFeatureValid($feature)
    {
        return $this->feature->getFeatureValid($feature);
    }
}
