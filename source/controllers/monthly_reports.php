<?php
session_start();
requireValidSession();

$currentDate = new DateTime();

$user = $_SESSION['user'];
$selectedUserId = $user->id;
$users = null;
if($user->is_admin){
  $users= User::get();
  $selectedUserId = isset($_POST["user"]) ? $_POST["user"] : $user->id;
}

$selectPeriod = isset($_POST["period"]) ? $_POST["period"] : $currentDate ->format('Y-m');
$periods = [];

for ($yearDiff = 0; $yearDiff <= 2; $yearDiff++){
  $year = date('Y') - $yearDiff;
  for($month=12; $month>=1; $month--){
    $date = new DateTime("{$year}-{$month}-1");
    $periods[$date->format('Y-m')] = strftime('%B de %Y',$date->getTimestamp());
  }
}

$registries = WorkingHours::getMonthlyReport($selectedUserId, $selectPeriod);

$report = [];
$workDay = 0;
$sumOfWorkedTime = 0;
$lastDay = getLastDayOfMonth($selectPeriod)->format('d');

for ($day = 1; $day <= $lastDay; $day++) {
  $date = $selectPeriod . '-' . sprintf('%02d', $day);

    if (isPastWorkDay($date)) {
      $workDay++;
    }

    if (isset($registries[$date])) {
      $registry = $registries[$date];
      $sumOfWorkedTime += $registry->worked_time;     
      array_push($report, $registry);
    } else {

      array_push($report, new WorkingHours([
        'work_date' => $date,
        'worked_time' => 0,
        'time1' => null,
        'time2' => null,
        'time3' => null,
        'time4' => null,
        
      ]));

    }
  
  
}

$expectedTime = $workDay * DAILY_TIME;

$balance = getTimeStringFromSeconds(abs($sumOfWorkedTime - $expectedTime));

$sign = ($sumOfWorkedTime >= $expectedTime) ? '+' : '-';


loadTemplateView('monthly_reports', [
  'report' => $report,
  'sumOfWorkedTime' => getTimeStringFromSeconds($sumOfWorkedTime),
  'balance' => "{$sign}{$balance}",
  'periods' => $periods,
  'users' => $users,
  'selectPeriod' => $selectPeriod,
  'selectedUserId'=> $selectedUserId,
]);





