<?php
if(isset($_POST['Delete'])) {
    $PatientSSN = $_REQUEST['PatientSSN'];
    $query = "DELETE FROM Patients WHERE PatientSSN=$PatientSSN";}
?>