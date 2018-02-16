<?php

namespace Ninjami\Ninjadocs;
use Parsedown;

class Ninjadocs {
  /**
   * Get content from file and parse to html
   */
  public function contentFromFile($fileName)
  {
    // Find .md file
    $file = $this->getFile($fileName);

    // Markdown to html
    $content = $this->parseMdToHtml($file);

    return $content;
  }

  /**
   * Get file
   */
  private function getFile($fileName)
  {
    // File should be .md
    $fileExtension = '.md';

    // File path
    $filePath = base_path() . '/resources/documentation/' . $fileName . $fileExtension;

    // if no file found in path, return error
    if(!file_exists($filePath)) {
      abort(404);
    }

    // Get file
    $file = file_get_contents($filePath);

    return $file;
  }


  /**
   * Parse markdown
   */
  private function parseMdToHtml($file)
  {
    $parser = new Parsedown();
    $html = $parser->text($file);

    return $html;
  }
}
