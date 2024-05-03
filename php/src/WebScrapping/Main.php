<?php

namespace Chuva\Php\WebScrapping;

use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Cell;
use OpenSpout\Common\Entity\Row;

/**
 * Runner for the Webscrapping exercice.
 */
class Main {

  /**
   * Main runner, instantiates a Scrapper and runs.
   */
  public static function run(): void {
    $dom = new \DOMDocument('1.0', 'utf-8');
    $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');

    $data = (new Scrapper())->scrap($dom);

    # Declaring an object of OpenSpout library
    $writer = new Writer();
    # Path where the spreadsheet will be saved
    $writer->openToFile(__DIR__ . '/../../assets/papersData.xlsx');
  }

}
