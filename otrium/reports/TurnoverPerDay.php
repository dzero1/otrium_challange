<?php
/**
 * Turnover per day report
 * -------------------------
 *
 * Developed by Dananjaya M. Perera (dananjjaya01@gmail.com)
 * 
 */

namespace otrium\reports;

class TurnoverPerDay extends ReportBase implements IReport
{
    public function generate($download = true)
    {
        // use basic configurations for vat calculation
        global $CFG;

        $ex_vat     = (100 - $CFG['VAT']) / 100;

        // get user input date range
        $start_date = isset($_POST['startDate']) ? $_POST['startDate'] : '2018-05-01';
        $end_date   = isset($_POST['endDate']) ? $_POST['endDate'] : '2018-05-07';

        // sql related to report
        $_sql = "SELECT DATE(g.`date`) as 'date', SUM(g.turnover) * :vat as turnover
            FROM gmv g
            JOIN brands b ON g.brand_id = b.id
            WHERE (g.`date` BETWEEN DATE(:start_date) AND DATE(:end_date))
            GROUP BY g.`date`
            ORDER BY DATE(g.`date`)";

        // including parameters
        $params = [':vat' => $ex_vat, ':start_date' => "$start_date", ':end_date' => "$end_date"];

        // generate report
        $file = $this->generateReport('turnover_per_day.csv', ["Date", "Turnover (excluding VAT)"], $_sql, $params);

        // send file to browser
        if ($download && is_string($file)){
            $this->sendFileToBrowser($file);
        }
        return $file;
    }
}

