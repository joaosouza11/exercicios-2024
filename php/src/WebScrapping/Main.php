<?php

namespace Chuva\Php\WebScrapping;

use OpenSpout\Common\Entity\Cell;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Writer;

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

    // Declaring an object of OpenSpout library.
    $writer = new Writer();
    // Path where the spreadsheet will be saved.
    $writer->openToFile(__DIR__ . '/../../assets/papersData.xlsx');

    // Spreadheet header, with a max num of authors in a paper = 20.
    $header = [
      Cell::fromValue('ID'),
      Cell::fromValue('Title'),
      Cell::fromValue('Type'),
      Cell::fromValue('Author 1'),
      Cell::fromValue('Author 1 Institution'),
      Cell::fromValue('Author 2'),
      Cell::fromValue('Author 2 Institution'),
      Cell::fromValue('Author 3'),
      Cell::fromValue('Author 3 Institution'),
      Cell::fromValue('Author 4'),
      Cell::fromValue('Author 4 Institution'),
      Cell::fromValue('Author 5'),
      Cell::fromValue('Author 5 Institution'),
      Cell::fromValue('Author 6'),
      Cell::fromValue('Author 6 Institution'),
      Cell::fromValue('Author 7'),
      Cell::fromValue('Author 7 Institution'),
      Cell::fromValue('Author 8'),
      Cell::fromValue('Author 8 Institution'),
      Cell::fromValue('Author 9'),
      Cell::fromValue('Author 9 Institution'),
      Cell::fromValue('Author 10'),
      Cell::fromValue('Author 10 Institution'),
      Cell::fromValue('Author 11'),
      Cell::fromValue('Author 11 Institution'),
      Cell::fromValue('Author 12'),
      Cell::fromValue('Author 12 Institution'),
      Cell::fromValue('Author 13'),
      Cell::fromValue('Author 13 Institution'),
      Cell::fromValue('Author 14'),
      Cell::fromValue('Author 14 Institution'),
      Cell::fromValue('Author 15'),
      Cell::fromValue('Author 15 Institution'),
      Cell::fromValue('Author 16'),
      Cell::fromValue('Author 16 Institution'),
      Cell::fromValue('Author 17'),
      Cell::fromValue('Author 17 Institution'),
      Cell::fromValue('Author 18'),
      Cell::fromValue('Author 18 Institution'),
      Cell::fromValue('Author 19'),
      Cell::fromValue('Author 19 Institution'),
      Cell::fromValue('Author 20'),
      Cell::fromValue('Author 20 Institution'),
    ];

    // Spreadsheet content.
    $rowType = new Row($header);
    $writer->addRow($rowType);
    // Filling the first 3 collums.
    foreach ($data as $paper) {
      $row = new Row([
        Cell::fromValue($paper->id),
        Cell::fromValue($paper->title),
        Cell::fromValue($paper->type),
      ]);

      // Filling author columns and author institution.
      $authorContent = [];
      foreach ($paper->authors as $author) {
        $authorContent[] = $author->name;
        $authorContent[] = $author->institution;
      }

      // Adding the struct to the spreadsheet.
      $row = new Row(array_merge($row->getCells(), array_map(fn($value) => Cell::fromValue($value), $authorContent)));

      $writer->addRow($row);
    }

    $writer->close();
  }

}
