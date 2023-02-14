<?php

namespace App\Test\Unit\Service;

use App\Service\ProductService;
use PHPUnit\Framework\TestCase;

final class ProductServiceTest extends TestCase
{
    protected $productService;
    protected $xpectedProductData = '[{"title":"Basic: 500MB Data - 12 Months","name":"The basic starter subscription providing you with all you need to get your device up and running with inclusive Data and SMS services.","description":"Up to 500MB of data per monthincluding 20 SMS(5p \/ MB data and 4p \/ SMS thereafter)","price":5.99,"priceCurrency":"\u00a3","subscriptionType":"monthly","data":"12 Months - Data &amp; SMS Service Only"},{"title":"Standard: 1GB Data - 12 Months","name":"The standard subscription providing you with enough service time to support the average user to enable your device to be up and running with inclusive Data and SMS services.","description":"Up to 1 GB data per monthincluding 35 SMS(5p \/ MB data and 4p \/ SMS thereafter)","price":9.99,"priceCurrency":"\u00a3","subscriptionType":"monthly","data":"12 Months - Data &amp; SMS Service Only"},{"title":"Optimum: 2 GB Data - 12 Months","name":"The optimum subscription providing you with enough service time to support the above-average user to enable your device to be up and running with inclusive Data and SMS services","description":"2GB data per monthincluding 40 SMS(5p \/ minute and 4p \/ SMS thereafter)","price":15.99,"priceCurrency":"\u00a3","subscriptionType":"monthly","data":"12 Months - Data &amp; SMS Service Only"},{"title":"Basic: 6GB Data - 1 Year","name":"The basic starter subscription providing you with all you need to get you up and running with Data and SMS services to allow access to your device.","description":"Up to 6GB of data per yearincluding 240 SMS(5p \/ MB data and 4p \/ SMS thereafter)","price":66,"priceCurrency":"\u00a3","subscriptionType":"yearly","data":"Annual - Data &amp; SMS Service Only"},{"title":"Standard: 12GB Data - 1 Year","name":"The standard subscription providing you with enough service time to support the average user with Data and SMS services to allow access to your device.","description":"Up to 12GB of data per year including 420 SMS(5p \/ MB data and 4p \/ SMS thereafter)","price":108,"priceCurrency":"\u00a3","subscriptionType":"yearly","data":"Annual - Data &amp; SMS Service Only"},{"title":"Optimum: 24GB Data - 1 Year","name":"The optimum subscription providing you with enough service time to support the above-average with data and SMS services to allow access to your device.","description":"Up to 12GB of data per year including 480 SMS(5p \/ MB data and 4p \/ SMS thereafter)","price":174,"priceCurrency":"\u00a3","subscriptionType":"yearly","data":"Annual - Data &amp; SMS Service Only"}]';

    public function setUp(): void
    {
        $this->productService = new ProductService('tests/data/products_dom.txt');

        parent::setUp();
    }

    public function testGetProducts(): void
    {
        $products = $this->productService->getProducts();
        $this->assertSame($this->xpectedProductData, json_encode($products));
    }
}
