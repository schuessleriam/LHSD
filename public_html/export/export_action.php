<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
?>

<?php

// connect to the database
require_once("../../resources/config/config.php");

// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);

if($_POST["export"] == "excel_schools_us")
{

$setSql = "SELECT schools.school_id, schools.school_name, schools.mail_label, schools.website,
schools.email, address.street, address.city, address.state, address.zip,
schools.member_tut, schools.nonmember_tut, schools.pubdate, schools.dir_ordered,
schools.enc, schools.enr, schools.other
FROM `schools`
inner JOIN address on schools.address_id=address.address_id
WHERE Country='United States'
order by state;";
$setRec = mysqli_query($conn, $setSql);

$columnHeader = '';
$columnHeader = "School PIN" . "\t" . "Organization" . "\t" . "Mail label" . "\t" . "Website" . "\t"
. "Email" . "\t" . "Street" . "\t" . "City" . "\t" . "State" . "\t"
. "Zip" . "\t" . "Member Tuition" . "\t" . "Non-Member Tuition" . "\t" . "Updated Pub" . "\t"
. "# Directories Ordered" . "\t" . "enc" . "\t" . "enr" . "\t"  . "Comments" . "\t";

$setData = '';
$filename = "LHSD_Schools(USA)_" . date('Y-m-d') . ".xls";

}

if($_POST["export"] == "excel_schools_intl")
{

$setSql = "SELECT schools.school_id, schools.school_name, schools.mail_label, schools.website,
schools.email, address.street, address.city, address.state, address.country,
schools.member_tut, schools.nonmember_tut, schools.pubdate, schools.dir_ordered,
schools.enc, schools.enr, schools.other
FROM `schools`
inner JOIN address on schools.address_id=address.address_id
WHERE NOT Country='United States'
order by state;";
$setRec = mysqli_query($conn, $setSql);

$columnHeader = '';
$columnHeader = "School PIN" . "\t" . "Organization" . "\t" . "Mail label" . "\t" . "Website" . "\t"
. "Email" . "\t" . "Street" . "\t" . "City" . "\t" . "State" . "\t" . "Country" . "\t"
. "Member Tuition" . "\t" . "Non-Member Tuition" . "\t" . "Updated Pub" . "\t"
. "# Directories Ordered" . "\t" . "enc" . "\t" . "enr" . "\t"  . "Comments" . "\t";

$setData = '';
$filename = "LHSD_Schools(INTL)_" . date('Y-m-d') . ".xls";

}

if($_POST["export"] == "excel_schools_demo")
{

$setSql = "SELECT
  demo.year,
  schools.school_name,
  schools.mail_label,
  demo.percent_asian,
  demo.percent_black,
  demo.percent_hispanic,
  demo.percent_white,
  demo.percent_other,
  demo.percent_lutheran
FROM
  demo
JOIN
  schools on schools.school_id = demo.school_id";

$setRec = mysqli_query($conn, $setSql);

$columnHeader = '';
$columnHeader = "Year" . "\t" . "Organization" . "\t" . "Mail label" . "\t" . "Asian" . "\t"
. "Black" . "\t" . "Hispanic" . "\t" . "White" . "\t" . "Other" . "\t" . "Lutheran" . "\t";

$setData = '';
$filename = "LHSD_demographics_" . date('Y-m-d') . ".xls";

}

if($_POST["export"] == "excel_schools_enr")
{

$setSql = "SELECT enr_stats.`year`, schools.school_name,
schools.mail_label, enr_stats.`freshmen`,
enr_stats.`sophomore`, enr_stats.`junior`, enr_stats.`senior`
from enr_stats JOIN schools where enr_stats.school_id=schools.school_id";

$setRec = mysqli_query($conn, $setSql);

$columnHeader = '';
$columnHeader = "Year" . "\t" . "Organization" . "\t" . "Mail label" . "\t" . "9th" . "\t"
. "10th" . "\t" . "11th" . "\t" . "12th" . "\t";

$setData = '';
$filename = "LHSD_enrollment_stats_" . date('Y-m-d') . ".xls";

}

if($_POST["export"] == "excel_schools_grad")
{

$setSql = "SELECT grad_stats.year, schools.school_name, schools.mail_label,
grad_stats.grad_num, grad_stats.luth_grad_num, grad_stats.grads_at_luth,
grad_stats.luth_grads_at_luth, grad_stats.grads_at_nonluth, grad_stats.luth_grads_at_priv,
grad_stats.grads_at_public, grad_stats.luth_grads_at_public,
grad_stats.percent_to_clg
FROM `grad_stats` JOIN schools on schools.school_id=grad_stats.school_id";

$setRec = mysqli_query($conn, $setSql);

$columnHeader = '';
$columnHeader = "Year" . "\t" . "Organization" . "\t" . "Mail Label" . "\t" . "# of grads" . "\t"
. "# of Luth Grads" . "\t" . "# of grads enrolled in Lutheran coll-univ"
. "\t" . "# of Luth grads @ Luth coll-univ" . "\t" . "# of grads at non-Luth school"
. "\t" . "# of Luth grads at private school"
. "\t" . "# of grads @ public school" . "\t" . "# of Luth grads at public school"
. "\t" . "% of graduating class going to college" . "\t";

$setData = '';
$filename = "LHSD_grad_stats_" . date('Y-m-d') . ".xls";

}

if($_POST["export"] == "excel_directors")
{

$setSql = "SELECT * FROM positions_w_info";
$setRec = mysqli_query($conn, $setSql);

$columnHeader = '';
$columnHeader = "Organization" . "\t" . "Mail label" . "\t" . "Title" . "\t"
. "Name" . "\t" . "Email" . "\t";

$setData = '';
$filename = "LHSD_Directors_" . date('Y-m-d') . ".xls";
}

if($_POST["export"] == "excel_assocs")
{

$setSql = "SELECT * FROM assocs_w_info";
$setRec = mysqli_query($conn, $setSql);

$columnHeader = '';
$columnHeader = "Organization" . "\t" . "OrgMailLabel" . "\t" . "Street" . "\t"
. "City" . "\t" . "State" . "\t" . "Zip" . "\t" . "Zip" . "\t" . "Admin Position"
. "\t" . "Admin Name" . "\t" . "# Dir ordered" . "\t";

$setData = '';
$filename = "LHSD_Associations_" . date('Y-m-d') . ".xls";

}

if($_POST["export"] == "indesign_schools" || $_POST["export"] == "indesign_dir") {

  if($_POST["export"] == "indesign_schools") {

//csv for indesign

//Create connection and select DB as new mysqli object
$db = new mysqli($dbhost, $dbusername, $dbpass, $dbname);

if($db->connect_error){
    die("Unable to connect database: " . $db->connect_error);
}

$query = $db->query("SELECT
    schools_w_address_w_affil.school_id,
    schools_w_address_w_affil.school_name,
    schools_w_address_w_affil.street,
    schools_w_address_w_affil.city,
    schools_w_address_w_affil.state,
    schools_w_address_w_affil.zip,
    schools_w_address_w_affil.phone,
    schools_w_address_w_affil.fax,
    schools_w_address_w_affil.email,
    schools_w_address_w_affil.website,
    schools_w_address_w_affil.founded,
    schools_w_address_w_affil.accred,
    schools_w_address_w_affil.description AS affil,
    enr_w_demo.percent_asian,
    enr_w_demo.percent_black,
    enr_w_demo.percent_hispanic,
    enr_w_demo.percent_white,
    enr_w_demo.percent_other,
    enr_w_demo.percent_lutheran,
    enr_w_demo.freshmen,
    enr_w_demo.sophomore,
    enr_w_demo.junior,
    enr_w_demo.senior,
    enr_w_demo.freshmen + enr_w_demo.sophomore + enr_w_demo.junior + enr_w_demo.senior AS total,
    schools_w_address_w_affil.full_time_staff,
    schools_w_address_w_affil.part_time_staff
    FROM
    schools_w_address_w_affil
    JOIN
    enr_w_demo ON enr_w_demo.school_id = schools_w_address_w_affil.school_id
    order by state");

    if($query->num_rows > 0){
      $delimiter = ",";
    $filename = "schools_indesign_import_" . date('Y-m-d') . ".csv";

    //create a file pointer
    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('school_id', 'school_name', 'street', 'city', 'state', 'zip',
    'phone', 'fax', 'email', 'website', 'founded', 'accred', 'affil', 'percent_asian',
     'percent_black', 'percent_hispanic', 'percent_white', 'percent_other',
     'percent_lutheran', 'freshmen', 'sophomore', 'junior', 'senior', 'total',
     'full_time_staff', 'part_time_staff');
    fputcsv($f, $fields, $delimiter);

    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $lineData = array($row['school_id'],
        $row['school_name'],
        $row['street'],
        $row['city'],
        $row['state'],
        $row['zip'],
        $row['phone'],
        $row['fax'],
        $row['email'],
        $row['website'],
        $row['founded'],
        $row['accred'],
        $row['affil'],
        $row['percent_asian'],
        $row['percent_black'],
        $row['percent_hispanic'],
        $row['percent_white'],
        $row['percent_other'],
        $row['percent_lutheran'],
        $row['freshmen'],
        $row['sophomore'],
        $row['junior'],
        $row['senior'],
        $row['total'],
        $row['full_time_staff'],
        $row['part_time_staff']);
        fputcsv($f, $lineData, $delimiter);
    }

    //move back to beginning of file
    fseek($f, 0);


    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

}


if($_POST["export"] == "indesign_dir") {

$sql = "SELECT * FROM positions_w_info";

$res = mysqli_query($conn, $sql);
$filename = "directors_indesign_import_" . date('Y-m-d') . ".xml";

header("Content-Type: text/html/force-download");
header("Content-Disposition: attachment; filename=$filename");
    $xml = new XMLWriter();

    $xml->openURI('php://output');
    $xml->startDocument();
    $xml->setIndent(true);

    $xml->startElement('directors');
    $prev_school = "start";
    while ($row = mysqli_fetch_assoc($res)) {

      $school_name = $row['school_name'];
      $school_name = str_replace(' ', '_', $school_name);
      $school_name = str_replace(';', '_', $school_name);
      $school_name = str_replace(':', '_', $school_name);
      $school_name = str_replace('\'', '_', $school_name);
      $school_name = str_replace('"', '_', $school_name);
      $school_name = str_replace('\\', '_', $school_name);
      $school_name = str_replace('\|', '_', $school_name);
      $school_name = str_replace(',', '_', $school_name);
      $school_name = str_replace('-', '_', $school_name);
      $school_name = str_replace('(', '_', $school_name);
      $school_name = str_replace(')', '_', $school_name);
      $school_name = str_replace('[', '_', $school_name);
      $school_name = str_replace(']', '_', $school_name);
      $school_name = str_replace('/', '_', $school_name);
      $school_name = str_replace('&', '_', $school_name);
      $school_name = str_replace('^', '_', $school_name);
      $school_name = str_replace('$', '_', $school_name);
      $school_name = str_replace('@', '_', $school_name);
      $school_name = str_replace('.', '_', $school_name);

  if ($prev_school === "start")
      {
        $xml->startElement($school_name);
      }

  if ($school_name !== $prev_school && $prev_school !== "start")
      {
        $xml->endElement();
        $xml->startElement($school_name);
      }

  $xml->writeElement("title", $row['title']);
  $xml->writeElement("name", $row['name']);
  $xml->writeElement("email", $row['email']);


  $prev_school = $school_name;
  }

  $xml->endElement();

  $xml->endElement();



$xml->flush();

    // Free result set
    mysqli_free_result($result);
    // Close connections
    mysqli_close($con);

}
}

else {


//output request into XLS format
while ($rec = mysqli_fetch_row($setRec)) {
    $rowData = '';
    foreach ($rec as $value) {
        $value = '"' . $value . '"' . "\t";
        $rowData .= $value;
    }
    $setData .= trim($rowData) . "\n";
}

//Prep selected data for download
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";

}

//close database connection
$conn->close();
?>
