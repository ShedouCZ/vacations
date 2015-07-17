<?php

  // hledana osoba
  $login='admin';

  $cislo = ''; // cislo osoby, ktere vrati ldap
  $chyba = '';

  // ostry
  $ds = ldap_connect("ldaps://ufal-mail.mff.cuni.cz");
  ldap_bind($ds, 'drupal_connector');
  //print($ds);

  if ($ds) {
    // nejprve dojde k vyhledani DN dle loginu
    $sr = ldap_search($ds, "ou=people,dc=ufal,dc=mff,dc=cuni,dc=cz", "(|(uid=$login))");
    print($sr);
    $entry = ldap_get_entries($ds,$sr);
    $cislo = $entry[0]['cunipersonalid'][0];
    $dn = $entry[0]['dn'];

    echo ("<PRE>");
    echo ("---------------------------");
    print_r($entry);
    echo ("---------------------------");
    echo ("dn: $dn");
    echo ("cislo: $cislo");
    echo ("</PRE>");

    if ($dn == "") {
      $chyba = "z LDAP bylo predanono DN blank";
    }
    // je vhodne udelat test, co je nyni ulozeno v $cislo, pomoci $cislo se pak da vyhledat osoba v lokani db uzivatelu
    // nyni lze udelat napr. bind:
    $heslo = 'Molekula2';
    $r = ldap_bind($ds, $dn, $heslo);
    print_r($r);
    if (!$r) {
      echo 'wrong pass';
    }

    ldap_close($ds);
  }
  else {
    $chyba = "nepodarilo se pripojit k LDAP serveru";
  }
  echo ($chyba);
  echo ("\n");
