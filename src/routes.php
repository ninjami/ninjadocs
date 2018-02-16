<?php
use Ninjami\Ninjadocs\Ninjadocs;

// Show document
Route::get('/documentation/{fileName}', function($fileName) {

  // Get file content
  $content = new Ninjadocs($fileName);

  return view('ninjadocs::document', [
    'content' => $content,
    'title' => ucfirst($fileName)
  ]);
});
