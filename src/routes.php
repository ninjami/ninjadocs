<?php

// Show document
Route::get('/documentation/{fileName}', function($fileName) {

  // Get file content
  $content = Ninjadocs::contentFromFile($fileName);

  return view('ninjadocs::document', [
    'content' => $content,
    'title' => ucfirst($fileName)
  ]);
});
