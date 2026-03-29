<?php
// boundaries/PlatformManagerGenerateReportButtonLayout.php
?>

<div style="
    display: flex;
    justify-content: space-between;
    width: 100%;
    max-width: 600px;
    margin: 2rem auto;
    gap: 10px; /* ensures spacing between buttons */
">
    <button onclick="generateDailyReportPage()" class="report-btn daily">
        Generate Daily Report
    </button>

    <button onclick="generateWeeklyReportPage()" class="report-btn weekly">
        Generate Weekly Report
    </button>

    <button onclick="generateMonthlyReportPage()" class="report-btn monthly">
        Generate Monthly Report
    </button>
</div>

<style>
.report-btn {
    flex: 1; /* makes all buttons evenly sized */
    padding: 12px 0;
    font-size: 16px;
    font-weight: 500;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    color: #fff;
    transition: background-color 0.2s ease, transform 0.2s ease;
}

/* Solid colors for each button */
.report-btn.daily {
    background-color: #3498db; /* blue */
}
.report-btn.daily:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
}

.report-btn.weekly {
    background-color: #9b59b6; /* purple */
}
.report-btn.weekly:hover {
    background-color: #8e44ad;
    transform: translateY(-2px);
}

.report-btn.monthly {
    background-color: #27ae60; /* green */
}
.report-btn.monthly:hover {
    background-color: #1e8449;
    transform: translateY(-2px);
}
</style>

<script>
function generateDailyReportPage() {
    window.location.href = "boundaries/PlatformManagerDailyReportPage.php";
}
function generateWeeklyReportPage() {
    window.location.href = "boundaries/PlatformManagerWeeklyReportPage.php";
}
function generateMonthlyReportPage() {
    window.location.href = "boundaries/PlatformManagerMonthlyReportPage.php";
}
</script>
