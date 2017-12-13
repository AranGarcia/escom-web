<?php
	$html = file_get_contents("php/invitacion-excelencia-pdf.php");
	
	include("php/mpdf60/mpdf.php");
	
	$mpdf = new mPDF();
	$mpdf->WriteHTML($html);
	$mpdf->Output('invitacion-excelencia.pdf','I');
	exit();

?>