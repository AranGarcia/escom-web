<?php
	$html = file_get_contents("php/invitacion-generacion-pdf.php");
	
	include("php/mpdf60/mpdf.php");
	
	$mpdf = new mPDF();
	$mpdf->WriteHTML($html);
	$mpdf->Output('invitacion-generacion.pdf','I');
	exit();

?>
