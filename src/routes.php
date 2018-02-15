<?php
// Show document
Route::get('/documentation/{fileName}', function($fileName) {
  $filePath = base_path() . '/resources/documentation/' . $fileName . '.md';
  $file = file_get_contents($filePath);

  $Parsedown = new Parsedown();
  $content = $Parsedown->text($file);

  return view('ninjadocs::file', [
    'content' => $content
  ]);
});
