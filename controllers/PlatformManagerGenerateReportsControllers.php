<?php
// controllers/PlatformManagerGenerateReportsControllers.php

require_once __DIR__ . '/../entities/Category.php';


/* --------------------------------------------------------------
   DAILY REPORT CONTROLLER
----------------------------------------------------------------*/
class GenerateDailyReportController {
    private $entity;

    public function __construct() {
        $this->entity = new Category();
    }

    public function PlatformManagerGetDailyReport() {
        return $this->entity->platformManagerGetDailyReport();
    }
}


/* --------------------------------------------------------------
   WEEKLY REPORT CONTROLLER
----------------------------------------------------------------*/
class GenerateWeeklyReportController {
    private $entity;

    public function __construct() {
        $this->entity = new Category();
    }

    public function PlatformManagerGetWeeklyReport() {
        return $this->entity->platformManagerGetWeeklyReport();
    }
}


/* --------------------------------------------------------------
   MONTHLY REPORT CONTROLLER
----------------------------------------------------------------*/
class GenerateMonthlyReportController {
    private $entity;

    public function __construct() {
        $this->entity = new Category();
    }

    public function PlatformManagerGetMonthlyReport() {
        return $this->entity->platformManagerGetMonthlyReport();
    }
}

?>
