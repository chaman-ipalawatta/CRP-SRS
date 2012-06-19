<?php
$data = sql::getServiceCountPerMonth();
$labels = sql::getServiceCountPerMonthLabels_X();
if($data != null)
{
    $lineChart = new gLineChart(450,300);
    $lineChart->addDataSet($data);
    //$lineChart->setLegend(array("No of Services per Month"));
    $lineChart->setColors(array("ff3344"));
    $lineChart->addAxisLabel(0, $labels);
    $lineChart->setVisibleAxes(array('x','y'));
    $lineChart->setDataRange(0,max($data));
    $lineChart->addAxisRange(0, 1, sizeof($labels), 1);
    $lineChart->addAxisRange(1, 0, max($data));
    $lineChart->setGridLines(33,10);
    $lineChart->setTitle("Monthly Service Count\r\n- Last 6 Months -");
    ?>
    <img src="<?php print $lineChart->getUrl();  ?>" />
<?php }
else
{
  echo '<span>There is not enough data to show the reports and graphs.</span>';
}
?>