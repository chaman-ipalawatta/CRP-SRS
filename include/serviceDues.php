<?php
$dueService = sql::GetVehicleDueForService();

?>
<script language="JavaScript" type="text/javascript">
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val) {
    
     var req = Inint_AJAX();
     req.onreadystatechange = function () {
          if (req.readyState==4) {
               if (req.status==200) {
                    document.getElementById(src).innerHTML=req.responseText; //retuen value
               }
          }
     };
     req.open("GET", "dueServiceInform-ajax.php?val="+val); //make connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1"); // set Header
     req.send(null); //send value
}

</script>
<?php if($dueService != null)
{ ?>
<table border="0px" cellspacing="0px">
        <thead>
            <tr>
                <td>Plate No</td>
                <td>Make</td>
                <td>Model</td>
                <td>Customer</td>
                <td>Telephone</td>
                <td>Mobile</td>
                <td>Last Service</td>
                <td>Next Service</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach($dueService as $vehicle)
            {
                extract($vehicle);
                if($i % 2 == 0)
                {
                    echo '<tr id="rowColor">';
                    echo    '<td>'.$plate_no.'</td>';
                    echo    '<td>'.$make.'</td>';
                    echo    '<td>'.$model.'</td>';
                    echo    '<td>'.$customer.'</td>';
                    echo    '<td>'.$tele1.'</td>';
                    echo    '<td>'.$mobile.'</td>';
                    echo    '<td>'.$last_serv.'</td>';
                    echo    '<td>'.$next_service.'</td>';
                    if($next_serv_informed == 1)
                    {
                        echo    '<td><span id="informed_'.$id.'">Client Informed</span></td>';

                    }
                    else
                    {
                        echo    '<td><span id="informed_'.$id.'"><a href="#" onclick="dochange(\'informed_'.$id.'\','.$id.')">Not Informed</a></span></td>';
                    }
                    echo '</tr>';
                }
                else
                {
                    echo '<tr id="rowColorAlt">';
                    echo    '<td>'.$plate_no.'</td>';
                    echo    '<td>'.$make.'</td>';
                    echo    '<td>'.$model.'</td>';
                    echo    '<td>'.$customer.'</td>';
                    echo    '<td>'.$tele1.'</td>';
                    echo    '<td>'.$mobile.'</td>';
                    echo    '<td>'.$last_serv.'</td>';
                    echo    '<td>'.$next_service.'</td>';
                    if($next_serv_informed == 1)
                    {
                        echo    '<td><span id="informed_'.$id.'">Client Informed</span></td>';

                    }
                    else
                    {
                        echo    '<td><span id="informed_'.$id.'"><a href="#" onclick="dochange(\'informed_'.$id.'\','.$id.')">Not Informed</a></span></td>';
                    }
                    echo '</tr>';
                }
                $i++;
                $navigation = $nav;
            }
            ?>
        </tbody>
        <tfoot>
            <tr id="navigation">
                <td colspan="9"><?php echo $navigation; ?></td>
            </tr>
        </tfoot>
    </table>
<?php }
else
{
    echo 'There is not enough data to show the reports and graphs';
}
    ?>
