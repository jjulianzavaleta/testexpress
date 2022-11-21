<?php 
require_once("clases/config.php");

function mailboxpowerloginrd($user,$pass){
  $ldaprdn = trim($user).'@'.DOMINIO;
  $ldappass = trim($pass);
  $server = SERVER;
  $ds = DOMINIO;
  $dn = DN;
  $puertoldap = 389;
  $ldapconn = ldap_connect($server,$puertoldap);

  if (! $ldapconn){
    echo '<p>LDAP SERVER CONNECTION FAILED</p>';
    return false;
  }

  ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3);
  ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0);

  $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);

  if ($ldapbind){
    $filter="(|(SAMAccountName=".trim($user)."))";
  $fields = array("SAMAccountName", "givenname", "company"/*, "department", "description", "sn", "title"*/);
    $sr = @ldap_search($ldapconn, $dn, $filter, $fields);
    $info = @ldap_get_entries($ldapconn, $sr);
    $array['samaccountname'] = $info[0]["samaccountname"][0];
    $array['givenname'] = $info[0]["givenname"][0];
    //$array = $info[0]["company"][0];
    // $array = $info[0]["department"][0];
    // $array = $info[0]["description"][0];
    // $array = $info[0]["sn"][0];
    // $array = $info[0]["title"][0];
    //var_dump($array); die;
  } else {
        $array=0;
  }

  ldap_close($ldapconn);  
  return $array; 
}  

?>