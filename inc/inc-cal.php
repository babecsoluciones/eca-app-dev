<? header('Access-Control-Allow-Origin: *');  ?>
<? header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method"); ?>
<? header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE"); ?>
<? header("Allow: GET, POST, OPTIONS, PUT, DELETE"); ?>
<? header('Content-Type: application/json'); ?>
<?

if (isset($_SERVER{'HTTP_ORIGIN'})) {
        header("Access-Control-Allow-Origin: {$_SERVER{'HTTP_ORIGIN'}}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

include("../cnx/swgc-mysql.php");

session_start();

$errores = array();

$data = json_decode( file_get_contents('php://input') );

function calcular($month,$year)
{

	$aMonth = ($month==1) ? 12 :$month-1;
	
	$nMonth = ($month==12) ? 1 : $month+1;
	
	$aYear = ($month==1) ? ($year-1) : $year;
	$nYear = ($month==12) ? ($year+1) : $year;
 
	$ant = $aMonth.','.$aYear;
			   $sig = $nMonth.','.$nYear;
	
 return array($ant,$sig);  
    
}

function build_calendar($month,$year,$dateArray) {

     // Create array containing abbreviations of days of week.
     $daysOfWeek = array('D','L','M','M','J','V','S');

     // What is the first day of the month in question?
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

     // How many days does this month contain?
     $numberDays = date('t',$firstDayOfMonth);

     // Retrieve some information about the first day of the
     // month in question.
     $dateComponents = getdate($firstDayOfMonth);

     // What is the name of the month in question?
     $monthName = $dateComponents['month'];
    
    $engMonth = array('January','February','March','April','May','June','July','August','September','October','November','December');
    $spaMonth = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    
    $monthName = str_replace($engMonth,$spaMonth,$monthName);

     // What is the index value (0-6) of the first day of the
     // month in question.
     $dayOfWeek = $dateComponents['wday'];
    
    // Nuevas fechas
    $nuevasFechas = calcular($month,$year);

     // Create the table tag opener and day headers

     $calendar = "<table class='calendar' cellspacing=\"5\">";
     $calendar .= "<tr>";
     $calendar .= "<td class='day' onclick=\"cambiarFecha($nuevasFechas[0])\">&lArr;</td><td colspan='5' align='center'>$monthName $year</td><td class='day' onclick=\"cambiarFecha($nuevasFechas[1])\">&rArr;</td>";
     $calendar .= "</tr>";
     $calendar .= "<tr>";

     // Create the calendar headers

     foreach($daysOfWeek as $day) {
          $calendar .= "<th class='header' align=\"center\">$day</th>";
     } 

     // Create the rest of the calendar

     // Initiate the day counter, starting with the 1st.

     $currentDay = 1;

     $calendar .= "</tr><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

     if ($dayOfWeek > 0) { 
          $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>"; 
     }
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while ($currentDay <= $numberDays) {

          // Seventh column (Saturday) reached. Start a new row.

          if ($dayOfWeek == 7) {

               $dayOfWeek = 0;
               $calendar .= "</tr><tr>";

          }
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          
          $date = "$year-$month-$currentDayRel";
         
          $date2 = "$currentDayRel/$month/$year";
          
          $prev = ($date<date('Y-m-d')) ? 'prevDay' : 'day';

          $calendar .= "<td class='$prev' onclick=\"asignarFecha('$date','$date2')\" ><span class='dia'>$currentDay</span></td>";

          // Increment counters
 
          $currentDay++;
          $dayOfWeek++;

     }
     
     

     // Complete the row of the last week in month, if necessary

     if ($dayOfWeek != 7) { 
     
          $remainingDays = 7 - $dayOfWeek;
          $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>"; 

     }
     
     $calendar .= "</tr>";

     $calendar .= "</table>";

     return $calendar;

}

$fecha = $data->nvaFecha;

$nvaFecha = explode('-',$fecha);
$month = $nvaFecha[0];
$year = $nvaFecha[1];

echo json_encode(array('calendario'=>build_calendar($month,$year,$dateArray)));

?>