<?php
require_once './vendor/autoload.php';
ob_start();

$html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');
$content = '';

// Inicio del HTML
$content .= '<div id="containerTicket">';
$content .= '<h1>Order ' . $id_shopping . ' bill</h1>';
$content .= '<div id="headerTicket">';
$content .= '<div id="headerLeft">';
$content .= '<p>' . $company->getName() . '</p>';
$content .= '<p>' . $company->getCif() . '</p>';
$content .= '<p>' . $company->getAddress() . '</p>';
$content .= '</div>';
$content .= '<div id="headerRight">';
$content .= '<img src="sources/web/logo.png" alt="logo" id="logoPhoto">';
$content .= '</div>';
$content .= '</div>';
$content .= '<div id="contentTicket">';
$content .= '<h4>Client information:</h4>';
$content .= '<div id="infoClient">';
$content .= '<div>';
$content .= '<p>DNI: ' . $client->getDni() . '</p>';
$content .= '<p>Name: ' . $client->getName() . '</p>';
$content .= '<p>Surname: ' . $client->getSurname() . '</p>';
$content .= '</div>';
$content .= '<div>';
$content .= '<p>Email: ' . $client->getEmail() . '</p>';
$content .= '<p>Address: ' . $client->getAddress() . '</p>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div id="prices">';
$content .= '<div id="headerPrices">';
$content .= '<div>Code product</div>';
$content .= '<div>Price per product</div>';
$content .= '<div>Amount</div>';
$content .= '<div>Import</div>';
$content .= '</div>';

// Ciclo para los detalles de la orden
foreach ($dataOrderDetails as $detail) {
    $content .= '<div class="contentPrices">';
    $content .= '<div>' . $detail['product'] . '</div>';
    $content .= '<div>' . $detail['price_per_product'] . '</div>';
    $content .= '<div>' . $detail['amount'] . '</div>';
    $content .= '<div>' . $detail['total_price'] . '</div>';
    $content .= '</div>';
}

$content .= '<div id="footerPrices">';
$content .= '<div>Total price: </div>';
$content .= '<div>' . $order->getPrecioTotalPedido() . '</div>';
$content .= '</div>';
$content .= '</div>';
$content .= '<div id="sign">';
$content .= '<p>Sign:</p>';
$content .= '<img src="sources/signature/signature.png" alt="sign" id="signPhoto">';
$content .= '</div>';
$content .= '</div>';
$content .= '</div>';

$html2pdf->writeHtml($content);
$html2pdf->output($client->getDni() . "_" . $id_shopping . "_bill.pdf");
?>