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

    return [
      new Paper(
        123,
        'The Nobel Prize in Physiology or Medicine 2023',
        'Nobel Prize',
        [
          new Person('Katalin Karikó', 'Szeged University'),
          new Person('Drew Weissman', 'University of Pennsylvania'),
        ]
      ),
    ];
  }

}
