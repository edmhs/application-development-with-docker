<?php
$balance = 5000;
$expense_month = 200;
$months = 12;

echo "Balance is: ".$balance;
echo "\n";
echo "Expense month: ".$expense_month;
echo "\n";
echo "months: ".$months;
echo "\n";

echo "End balance is ".($balance-$expense_month*$months);
echo "\n";