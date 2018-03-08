<?php

class RscClubMemberDatabaseSyncronizer extends Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->import('Encryption');
    $this->import('Database');
  } 
  
  public function syncronizeDatabase() {
    
    $mysqli = new mysqli($GLOBALS['TL_CONFIG']['oldDbHost'], $GLOBALS['TL_CONFIG']['oldDbUser'], $GLOBALS['TL_CONFIG']['oldDbPass'], $GLOBALS['TL_CONFIG']['oldDbDatabase'], $GLOBALS['TL_CONFIG']['oldDbPort']);
    $mysqli->set_charset("utf8");
    $objResultExternal = $mysqli->query("SELECT * FROM tl_member");
    
    while ($row = $objResultExternal->fetch_object()) {
      $objCount = $this->Database->prepare("SELECT COUNT(id) count FROM tl_member WHERE id = ?")->execute($row->id)->count;
      
      $arrData = array(
        'firstname' => $row->firstname,
        'lastname' => $row->lastname,
        'dateOfBirth' => $row->dateOfBirth,
        'gender' => $row->gender,
        'street' => $row->street,
        'postal' => $row->postal,
        'city' => $row->city,
        'country' => $row->country,
        'phone' => $row->phone,
        'mobile' => $row->mobile,
        'email' => $row->email,
        'language' => $row->language,
        'xt_club_membernumber' => $row->xt_club_membernumber,
        'dateAdded' => $row->dateAdded,
        'xt_club_license_bdr_license' => $row->xt_club_license_bdr_license,
        'xt_club_license_bdr_license_nr' => $row->xt_club_license_bdr_license_nr,
        'xt_club_license_dtu_startpass' => $row->xt_club_license_dtu_startpass,
        'xt_club_license_dtu_startpass_nr' => $row->xt_club_license_dtu_startpass_nr,
        'xt_club_license_rtf_card' => $row->xt_club_license_rtf_card,
        'xt_club_license_rtf_card_nr' => $row->xt_club_license_rtf_card_nr,
        'xt_club_swimflat' => $row->xt_club_swimflat,
        'groups' => $row->groups,
        'publicFields' => $row->publicFields,
        'disable' => $row->disable,
        'start' => $row->start,
        'stop' => $row->stop
      );
      
      if ($objCount == 1) {
        $objUpdateStmt = $this->Database->prepare("UPDATE tl_member %s WHERE id = ?")
                              ->set($arrData)
                              ->execute($row->id);
        $_SESSION['TL_CONFIRM'][] = "Update: " . $row->firstname . " " . $row->lastname;
      }
    }
    
    $objResultExternal->close();
    $mysqli->close();
    
    $_SESSION['TL_CONFIRM'][] = "Datenbank erfolgreich synchronisiert";
    
    $this->redirect($this->Environment->script . '?do=member'); 
  }
}

?>