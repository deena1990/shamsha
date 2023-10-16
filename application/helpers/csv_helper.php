<?php

if(! function_exists("csv_download")) {
    function csv_download($data) {
        $CI =& get_instance();
        $fileName = time();
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=" . $fileName . ".csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        $output = fopen("php://output", "w");
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
        exit();
    }
}
