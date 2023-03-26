<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function scrapeProducts()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://aromis.co/oils');



        $html = $response->getBody()->getContents();



        $dom = new \DOMDocument();
        @$dom->loadHTML($html);

        $xpath = new \DOMXPath($dom);
      
// dd($xpath);
       $getproducts = $xpath->query("//li[@class='product']");

  

        $products = [];

       foreach ($getproducts as $productNode) {
    $product = [];

    // Get the product title
    $titleNode = $xpath->query(".//h3[@class='card-title']//a", $productNode)[0];
    $product['title'] = $titleNode->nodeValue;

    // Get the product image
    $imageNode = $xpath->query(".//img[contains(@class,'card-image')]", $productNode)[0];
    $product['image'] = $imageNode->getAttribute('data-src');

    // Get the product price
    $priceNode = $xpath->query(".//span[@class='price price--withoutTax']", $productNode)[0];
    $product['price'] = $priceNode->nodeValue; 

    $products[] = $product;
}

        

        return view('products', ['products' => $products]);
    }
}
