<?php

namespace App\Service;

use App\Model\Product;
use DOMDocument;
use DOMXPath;

class ProductService
{
    private string $sourceDataLink;

    private array $products = [];

    public function __construct($sourceDataLink)
    {
        $this->sourceDataLink = $sourceDataLink;
    }


    public function getProducts(): array
    {

        // prevent errors from invalid html
        libxml_use_internal_errors(true);

        // set params to hide user agent
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Accept-language: en" .
                    "Cookie: foo=bar" .
                    "Referer: http://www.googlebot.com" .
                    "User-Agent: Googlebot/2.1 (http://www.googlebot.com/bot.html)"
            )
        );

        $context = stream_context_create($opts);

        $html = file_get_contents($this->sourceDataLink, false, $context);

        $dom = new DOMDocument();
        $dom->loadHTML(str_replace('&', '&amp;', $html));

        $finder = new DomXPath($dom);
        $classname = "package featured"; // class representing the packages in dom
        $packages = $finder->query("//*[contains(@class, '$classname')]");

        if ($packages->length > 0) {
            $this->processPackages($packages);
        }

        return $this->products;
    }

    private function processPackages(mixed $packages)
    {
        foreach ($packages as $package) {
            $product = new Product();

            // get custom title attribute on title tag
            $elements = $package->getElementsByTagName('h3');
            if ($elements->length == 1) {
                $title = $elements[0]->textContent;
                $product->setTitle($title);

                $subscriptionType = 'yearly';
                if (str_contains($title, 'Months')) {
                    $subscriptionType = 'monthly';
                }
                $product->setSubscriptionType($subscriptionType);
            }

            // parse elements to find product attributes
            $elements = $package->getElementsByTagName('div');
            foreach ($elements as $element) {

                switch ($element->getAttribute('class')) {
                    case 'package-name':
                        $product->setName($element->textContent);
                        break;
                    case 'package-description':
                        $product->setDescription($element->textContent);
                        break;
                    case 'package-data':
                        $product->setData($element->textContent);
                        break;
                    case 'package-price':
                        $price = $this->processPrice($element);
                        $product->setPrice($price);
                        $product->setPriceCurrency("£");
                        break;
                }
            }

            $this->products[] = $product;

        }
    }

    private function processPrice(mixed $element)
    {
        $elements = $element->getElementsByTagName('span');
        if ($elements->length == 1) {
            $price = str_replace('£', '', $elements[0]->textContent);
            return filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        }
        return 0;
    }
}
