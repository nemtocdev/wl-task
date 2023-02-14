<?php

namespace App\Model;

use DOMDocument;
use DOMXPath;

class Product
{
    public string $title;

    public string $name;

    public string $description;

    public float $price;

    public string $priceCurrency;

    public string $subscriptionType;

    public string $data;

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function setPriceCurrency(string $priceCurrency)
    {
        $this->priceCurrency = $priceCurrency;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setData(string $data)
    {
        $this->data = $data;
    }

    public function setSubscriptionType(string $subscriptionType)
    {
        $this->subscriptionType = $subscriptionType;
    }

}
