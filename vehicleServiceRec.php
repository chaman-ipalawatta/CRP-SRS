<?php

include_once('sql.php');
require_once('configuration.php');
define("_MPDF_TEMP_PATH", 'temp/');
include_once('assets/MPDF53/mpdf.php');
$today= getdate();
$vehicleId = $_GET['vid'];

$vehicle = sql::getVehicleFullDetail($vehicleId);
$customer = sql::getCustomer($vehicle['customer_id']);
$services = sql::GetAllServices($vehicleId);

//Create PDF
$mpdf = new mPDF("","A4");
$mpdf->SetTitle('CRP Engineering (Pvt) Ltd - Vehicle Service Log');
$mpdf->SetAuthor('CRP Engineering Service Record System');
$mpdf->SetSubject('Service Log for '.$vehicle['plate_no']);
$stylesheet = file_get_contents('assets/style.css');

$mpdf->WriteHTML($stylesheet,1);

$html = '<H1>CRP Engineering (Pvt) Ltd</H1>';
$html .= '<H4>15 Morgan Road, Colombo 02, Sri Lanka</H4>';
$html .= '<H4>Telephone: +94 112 303 910</H4>';
$html .= '<H4>Email: crpeng@sltnet.lk</H4>';
$html .= '<br><H2>Service Record for '.$vehicle['plate_no'].'</H2>';
$html .= '<div>';
$html .= '<div id="report-customer"><h3>Customer Details</h3>
    <strong>Full Name:</strong> '.$customer['name'].' <br>
    <strong>Address:</strong> '.$customer['address'].'<br>
    <strong>Telephone 1:</strong> '.$customer['tele1'].'<br>
    <strong>Telephone 2:</strong> '.$customer['tele2'].'<br>
    <strong>Mobile:</strong> '.$customer['mobile'].'<br>
    <strong>Email:</strong> '.$customer['email'].'<br></div>';
$html .= '<div id="report-vehicle"><h3>Vehicle Details</h3>
    <strong>Plate No:</strong> '.$vehicle['plate_no'].'<br>
    <strong>Make:</strong> '.$vehicle['make'].'<br>
    <strong>Model:</strong> '.$vehicle['model'].'<br>
    <strong>Oil Type:</strong> '.$vehicle['oil_type'].'<br>
    <strong>Notes:</strong> '.$vehicle['notes'].'</div>';
$html .= '</div>';
$html .= '<br><H3>Service Log</H3>';
if($services != null)
{
    foreach($services as $service)
    {
        $html .= '<div id="serviceRec"><h4>Service Date: '.$service['create_date'].'</h4>
                <strong>Odometer:</strong> '.$service['odometer'].'<br>
                <strong>Service Description:</strong> '.$service['service_desc'].'<br>
                <strong>Remarks:</strong> '.$service['notes'].'</div>';
    }
}
else
{
    $html .= '<div id="serviceRec">There are no services carried out for this vehicle.</div>';
}

$mpdf->SetFooter('CRP Engineering (Pvt) Ltd|{PAGENO}|{DATE l jS \of F Y h:i:s A}');
$mpdf->writeHTML($html);

//$mpdf->Output('CRP_Vehicle_Rec.pdf','F');
$filename = $GLOBALS['configuration']['report_folder'].'Report-'.$vehicle['plate_no'].'-'.date("Y-m-d-h-i-s",$today['0']).'.pdf';
$mpdf->Output($filename,'F');

echo "<script type=\"text/javascript\">window.location = \"vehicles.php?s=3\"</script>";
?>
