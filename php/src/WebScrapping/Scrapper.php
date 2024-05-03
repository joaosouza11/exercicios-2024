<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and returns the array with the data.
   */
  public function scrap(\DOMDocument $dom): array {
    
    # Creating an instance to do XPath Queries
    $xpath = new \DOMXPath($dom);
    # XPaths of each item
    $paperXPath = "//a[@class='paper-card p-lg bd-gradient-left']";
    $idXPath = ".//div[@class='volume-info']";
    $titleXPath = ".//h4[@class='my-xs paper-title']";
    $typeXPath = ".//div[@class='tags mr-sm']";
    $authorXPath = ".//div[@class='authors']/span";

    #Declaring a DOMNodeList object
    $paperNodes = $xpath->query($paperXPath);
    $paperList = [];

    foreach ($paperNodes as $node) {
      $id = $xpath->query($idXPath, $node)->item(0)->nodeValue;
      $title = $xpath->query($titleXPath, $node)->item(0)->nodeValue;
      $type = $xpath->query($typeXPath, $node)->item(0)->nodeValue;

      # Declaring empty because we need a loop to verify and fill if the item has more than 1 author
      $authors = [];
      $authorsNodes = $xpath->query($authorXPath, $node);

      foreach($authorsNodes as $authorNode) {
        $author = $authorNode->nodeValue;
        $institution = $authorNode->getAttribute('title');
        # Instance with type Person to fill the authors array
        $authors[] = new Person($author, $institution);
      }
