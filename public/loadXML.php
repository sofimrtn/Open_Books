<?php
    $xml = new DOMDocument();
    $xml->load('bookShops.xml');

    $xsl = new DOMDocument();
    $xsl->load('bookShops.xsl');

    $proc = new XSLTProcessor();
    $proc->importStyleSheet($xsl);

    echo $proc->transformToXML($xml);
?>
