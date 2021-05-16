<?php

require_once "./config.php";
require_once "./otrium/db.php";
require_once "./otrium/reports/reports.php";

if (isset($_POST)) {

    // Initializing database into global scope
    $DB = new otrium\DB();
    $DB->connect();

    if (isset($_POST['turnOverPerDay'])) {
        // Turnover Per Day Report
        $perDayReprot = new otrium\reports\TurnoverPerDay();
        $perDayReprot->generate(true);
    }

    if (isset($_POST['turnOverPerBrand'])) {
        // Turnover Per Brand Report
        $perBrandReprot = new otrium\reports\TurnoverPerBrand();
        $perBrandReprot->generate(true);
    }
}