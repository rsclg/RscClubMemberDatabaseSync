<?php

namespace RSC;

class RscClubMemberDatabaseSyncronizer extends \Controller
{
  public function __construct()
  {
    parent::__construct();
  } 
  
  public function syncronizeDatabase() {
    
    $arrConfigExternal = array
    (
      'dbDriver'   => "MySQLi",
      'dbHost'     => \Config::get('oldDbHost'),
      'dbUser'     => \Config::get('oldDbUser'),
      'dbPass'     => \Encryption::decrypt(\Config::get('oldDbPass')),
      'dbDatabase' => \Config::get('oldDbDatabase'),
      'dbPconnect' => false,
      'dbCharset'  => "UTF8",
      'dbPort'     => \Config::get('oldDbPort'),
      'dbSocket'   => "",
      'dbSqlMode'  => ""
    ); 
    $dbExternal = \Database::getInstance($arrConfigExternal);
    $db = \Database::getInstance();
    
    $objResultExternal = $dbExternal->prepare("SELECT * FROM tl_member")->execute();
    
    while ($objResultExternal->next()) {
      $objCount = $db->prepare("SELECT COUNT(id) count FROM tl_member WHERE id = ?")->execute($objResultExternal->id)->count;
      
      $arrData = array(
        'firstname' => $objResultExternal->firstname,
        'lastname' => $objResultExternal->lastname,
        'dateOfBirth' => $objResultExternal->dateOfBirth,
        'gender' => $objResultExternal->gender,
        'street' => $objResultExternal->street,
        'postal' => $objResultExternal->postal,
        'city' => $objResultExternal->city,
        'country' => $objResultExternal->country,
        'phone' => $objResultExternal->phone,
        'mobile' => $objResultExternal->mobile,
        'email' => $objResultExternal->email,
        'language' => $objResultExternal->language,
        'xt_club_membernumber' => $objResultExternal->xt_club_membernumber,
        'dateAdded' => $objResultExternal->dateAdded,
        'xt_club_license_bdr_license' => $objResultExternal->xt_club_license_bdr_license,
        'xt_club_license_bdr_license_nr' => $objResultExternal->xt_club_license_bdr_license_nr,
        'xt_club_license_dtu_startpass' => $objResultExternal->xt_club_license_dtu_startpass,
        'xt_club_license_dtu_startpass_nr' => $objResultExternal->xt_club_license_dtu_startpass_nr,
        'xt_club_license_rtf_card' => $objResultExternal->xt_club_license_rtf_card,
        'xt_club_license_rtf_card_nr' => $objResultExternal->xt_club_license_rtf_card_nr,
        'xt_club_swimflat' => $objResultExternal->xt_club_swimflat,
        'groups' => $objResultExternal->groups,
        'publicFields' => $objResultExternal->publicFields,
        'disable' => $objResultExternal->disable,
        'start' => $objResultExternal->start,
        'stop' => $objResultExternal->stop
      );
      
      if ($objCount == 1) {
        $objUpdateStmt = $db->prepare("UPDATE tl_member %s WHERE id = ?")
                            ->set($arrData)
                            ->execute($objResultExternal->id);
        \Message::addConfirmation("Update: " . $objResultExternal->firstname . " " . $objResultExternal->lastname);
      } else {
        $arrData['id'] = $objResultExternal->id;
        $objInsertStmt = $db->prepare("INSERT INTO tl_member %s")
                            ->set($arrData)
                            ->execute();
        \Message::addConfirmation("Insert: " . $objResultExternal->firstname . " " . $objResultExternal->lastname);
      }
    }
    
    \Message::addConfirmation("Datenbank erfolgreich synchronisiert");
    $this->redirect($this->Environment->script . '?do=member'); 
  }
}

?>