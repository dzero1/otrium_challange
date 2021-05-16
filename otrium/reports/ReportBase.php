<?php
/**
 * Base report class
 * ------------------
 * - Use this class as the parent blueprint for any report. Also implement it using the IReport interface
 *
 * Developed by Dananjaya M. Perera (dananjjaya01@gmail.com)
 * 
 */

namespace otrium\reports;

use Exception;

interface IReport
{
    public function generate($download = true);
}

class ReportBase
{
    protected function generateReport($filename, $report_headers, $sql, $params){
        global $LOGGER;

        $error = new \stdClass();

        $DB = new \otrium\DB();
        $DB->connect();

        $LOGGER->debug($sql);
        $LOGGER->debug("params: " . json_encode($params));

        $query_data = $DB->execute($sql, $params);

        if ($query_data){
            $query_data = array_merge([$report_headers], $query_data);
            $LOGGER->debug("query_data: " . json_encode($query_data));

            $file = $this->generateCSV($filename, $query_data);
            $LOGGER->debug($file);
            return $file;
        } else {
            $error->message = 'No data found!';
            $LOGGER->error($error->message);
            return $error;
        }
    }

    protected function generateCSV($filename, $data){
        global $CFG;

        $file = $CFG['export_location'] . '/' . $filename;
        try {
            $fp = fopen($file, 'w');
            foreach ($data as $fields) {
                fputcsv($fp, $fields);
            }
            fseek($fp, 0);
            fclose($fp);

            return $file;
            
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), "\n");
        }
    }

    protected function sendFileToBrowser($file){
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');

        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="'.basename($file).'";');

        // make php send the generated csv lines to the browser
        readfile($file);
    }
}
