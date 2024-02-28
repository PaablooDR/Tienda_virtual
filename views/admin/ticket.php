<?php
require_once './vendor/autoload.php';
ob_start();

$html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');
$vueltas = 40;
$content = '';

$content .= '<page>';
$content .= '<h1>Order ' . $id_shopping . ' bill</h1>';

for($i = 0; $i < $vueltas+($vueltas*0.5); $i++){
    $content .= '&nbsp;';
}

$content .= '<table>';

$content .= '<tr>';
$content .= '<td>' . $company->getName() . '</td>';
$content .= '<td rowspan="3" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="sources/web/logo.png" alt="logo" id="logoPhoto"></td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>' . $company->getCif() . '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>' . $company->getAddress() . '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td colspan="4">&nbsp;</td>';
$content .= '</tr>';
$content .= '<tr>';
$content .= '<td colspan="4">&nbsp;</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td colspan="4"> <h4>Client information:</h4> </td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td colspan="2">DNI: ' . $client->getDni() . '</td>';
$content .= '<td colspan="2">Email: ' . $client->getEmail() . '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td colspan="2">Name: ' . $client->getName() . '</td>';
$content .= '<td colspan="2">Address: ' . $client->getAddress() . '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td colspan="4">Surname: ' . $client->getSurname() . '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td colspan="4">&nbsp;</td>';
$content .= '</tr>';
$content .= '<tr>';
$content .= '<td colspan="4">&nbsp;</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<th>Code product</th>';
$content .= '<th>Price per product&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';
$content .= '<th>Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';
$content .= '<th>Import</th>';
$content .= '</tr>';

foreach ($dataOrderDetails as $detail) {
    $content .= '<tr class="contentPrices">';
    $content .= '<td>' . $detail['product'] . '</td>';
    $content .= '<td>' . $detail['price_per_product'] . '€</td>';
    $content .= '<td>' . $detail['amount'] . '</td>';
    $content .= '<td>' . $detail['total_price'] . '€</td>';
    $content .= '</tr>';
}

$content .= '<tr>';
$content .= '<td colspan="4">&nbsp;</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td colspan="3">Total price:</td>';
$content .= '<td>' . $order->getPrecioTotalPedido() . '€</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td colspan="4">&nbsp;</td>';
$content .= '</tr>';
$content .= '<tr>';
$content .= '<td colspan="4">&nbsp;</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td colspan="4">Sign:</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td colspan="4"><img src="sources/signature/signature.png" alt="sign" id="signPhoto"></td>';
$content .= '</tr>';

$content .= '</table>';

$content .= '</page>';


$html2pdf->writeHtml($content);
$html2pdf->output($client->getDni() . "_" . $id_shopping . "_bill.pdf");
?>