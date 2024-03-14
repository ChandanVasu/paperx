<?php

function ocdi_import_files_from_json_url() {
  // URL to JSON file
  $json_url = 'https://mjnnu.com/demo/data.json';

  // Fetch JSON data from URL
  $json_data = file_get_contents($json_url);

  // Decode JSON data
  $import_data = json_decode($json_data, true);

  // Check if JSON decoding was successful
  if ($import_data === null) {
      // JSON decoding failed, handle error here
      return [];
  }

  // Return the imported data
  return $import_data;
}

add_filter('ocdi/import_files', 'ocdi_import_files_from_json_url');
