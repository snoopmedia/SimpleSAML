<?php

require_once('../lib/_autoload.php');
$as = new SimpleSAML_Auth_Simple('fraunhofer');

$as->requireAuth(array(
	'ReturnTo' => 'https://PFAD-ZUm-SERVER/ein-directory',
    'KeepPost' => FALSE,
    'saml:AuthnContextClassRef' => 'urn:oasis:names:tc:SAML:2.0:ac:classes:Password',  // Kann man dies ggf. in der parameters.ini konfiguirertbar machen? Später soll z.B urn:oasis:names:tc:SAML:2.0:ac:classes:Smartcard genutzt werden….
));

$attrs = $as->getAttributes();
// nur zum ausprobieren
var_dump($attrs);

$name = $attrs['http://schemas.xmlsoap.org/ws/2005/05/identity/claims/NameID'][0];
$mail = $attrs['http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress'][0];
$pki  = $attrs['http://schemas.xmlsoap.org/ws/2005/05/identity/claims//cp:Secrets/cp:Secret[cp:Name="X509Credentials"]/cp:Entry[cp:Name="Issuer"]'][0];

echo '<br>Hello, ' . htmlspecialchars($name) . ", deine Mail ist:  " . htmlspecialchars($mail) 
   . ", und deine SmartCard ist ausgestellt von:  " .htmlspecialchars($pki) .'<br><br>';