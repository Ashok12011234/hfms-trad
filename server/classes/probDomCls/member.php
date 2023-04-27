<?php

include("config.php");


class MemberType
{
  const GUEST = 0;
  const HOSPITAL = 1;
  const PROVIDER = 2;
}




abstract class MemberState
{
  public abstract function initiate(Member $member);
}

class NewMember extends MemberState
{
  public function initiate(Member $member)
  {
    $member->set_state(new InitiatedMember());
  }
}

class InitiatedMember extends MemberState
{
  public function initiate(Member $member)
  {
  }
}

abstract class Member
{
  public $name;
  public $address;
  public $phoneNo;
  public $bedAval;
  public $ceylinderAval;
  public $id;
  public $profile;
  public $email;
  public $username;
  public $accountNo;
  public $bankName;
  public $website;
  public $staredUser;
  public $state;

  public abstract function request();
  public abstract function filter($type);

 
  public function get_name()
  {

    return $this->name;
  }


  public function get_address()
  {
    return $this->address;
  }

  public function get_phoneno()
  {
    return $this->phoneNo;
  }

  public function get_website()
  {
    return $this->website;
  }

  public function get_id()
  {
    return $this->id;
  }
  public function get_profile()
  {
    return $this->profile;
  }

  public function get_username()
  {
    return $this->username;
  }
  public function get_email()
  {

    return $this->email;
  }

  public function get_bankName()
  {

    return $this->bankName;
  }

  public function get_accountNo()
  {
    return $this->accountNo;
  }


  public function get_state()
  {
    return $this->state;
  }

  public function set_state($state)
  {
    $this->state = $state;
  }

  public static function fetchByUserName(String $username): Member|null
  {
    if (!is_null($hospital = Hospital::fetchByUserName($username))) {
      return $hospital;
    }
    if (!is_null($provider = Provider::fetchByUserName($username))) {
      return $provider;
    }
    return null;
  }

 
}

class Hospital extends Member
{

  public $bloodAval;
  public $vaccineAval;
  private static array $hospitals = array();

  private function __construct($id)
  {
    $sql = "SELECT * FROM `hospital` WHERE HospitalId = $id";
    $result = QueryExecutor::query($sql);
    $row = $result->fetch_assoc();

    $this->id = $row["HospitalId"];
    $this->username = $row['UserName'];
    $this->name = $row["Name"];
    $this->address = $row['Address'];
    $this->phoneNo = $row["TelephoneNo"];
    $this->profile = $row['Profile'];
    $this->email = $row['Email'];
    $this->website = $row["Website"];
    $this->accountNo = $row['AccountNumber'];
    $this->bankName = $row['BankName'];
    $this->state = $row['State'];
  }

  public static function getInstance($id): Hospital|null
  {
    if (!array_key_exists($id, self::$hospitals)) {
      $sql = "SELECT HospitalId FROM `hospital` WHERE HospitalId = $id";
      if (QueryExecutor::query($sql)->num_rows == 0) {
        return null;
      } else {
        self::$hospitals[$id] = new Hospital($id);
      }
    }
    return self::$hospitals[$id];
  }

  public function request()
  {
  }
  public function set_state($state)
  {
    $sql = "UPDATE `hospital` SET `State`= '$state' WHERE `hospital`.`HospitalId` =  $this->id";
    QueryExecutor::query($sql);
    $this->state = $state;
  }
  public function set_name($name)
  {
    $sql = "UPDATE `hospital` SET `Name`= '$name' WHERE `hospital`.`HospitalId` =  $this->id";
    QueryExecutor::query($sql);
    $this->name = $name;
  }
  public function set_address($address)
  {
    $sql = "UPDATE `hospital` SET `Address` = '$address' WHERE `hospital`.`HospitalId` = $this->id";
    QueryExecutor::query($sql);
    $this->address = $address;
  }
  public function set_phoneno($phoneNo)
  {
    $sql = "UPDATE `hospital` SET `TelephoneNo`= '$phoneNo' WHERE `hospital`.`HospitalId` =  $this->id";
    QueryExecutor::query($sql);
    $this->phoneNo = $phoneNo;
  }
  public function set_website($website)
  {
    $sql = "UPDATE `hospital` SET `Website`= '$website' WHERE `hospital`.`HospitalId` =  $this->id";
    QueryExecutor::query($sql);
    $this->website = $website;
  }
  public function set_profile($profile)
  {

    $sql = "UPDATE `hospital` SET `profile` =  '$profile' WHERE `hospital`.`HospitalId` =  $this->id";
    QueryExecutor::query($sql);
    $this->profile = $profile;
  }
  public function set_email($email)
  {
    $sql = "UPDATE `hospital` SET `Email`= '$email' WHERE `hospital`.`HospitalId` =  $this->id";
    QueryExecutor::query($sql);
    $this->email = $email;
  }

  public function set_accountNo($accountNo)
  {
    $sql = "UPDATE `hospital` SET `AccountNumber`= '$accountNo' WHERE `hospital`.`HospitalId` =  $this->id";
    QueryExecutor::query($sql);
    $this->accountNo = $accountNo;
  }
  public function set_bankName($bankName)
  {
    $sql = "UPDATE `hospital` SET `BankName`= '$bankName' WHERE `hospital`.`HospitalId` =  $this->id";
    QueryExecutor::query($sql);
    $this->bankName = $bankName;
  }
  public function get_bed()
  {
    if (is_null($this->bedAval)) {
      $sql = "SELECT  NormalAvailability, ICUAvailability FROM hospitalbeddetail WHERE HospitalId=$this->id";
      $result = QueryExecutor::query($sql);
      $row = mysqli_fetch_assoc($result);
      if ($row != null) {
        $this->bedAval = new Bed($row["NormalAvailability"], $row["ICUAvailability"]);
      } else {
        $this->bedAval = new Bed("NO", "NO");
      }
    }
    return $this->bedAval;
  }

  public function set_bed()
  {
    if (isset($_POST['bed'])) {
      $resources = array('NormalAvailability' => 'normalBed', 'ICUAvailability' => 'icuBed');
      foreach ($resources as $resource => $field) {
        if (in_array($field, $_POST['bed'])) {
          $sql = "UPDATE `hospitalbeddetail` SET `$resource`='YES'  WHERE HospitalId=$this->id;";
          QueryExecutor::query($sql);
        } else {
          $sql = "UPDATE `hospitalbeddetail` SET `$resource`='NO'  WHERE HospitalId=$this->id;";
          QueryExecutor::query($sql);
        }
      }
    } else {
      $sql = "UPDATE `hospitalbeddetail` SET `NormalAvailability`='NO',`ICUAvailability`='NO'  WHERE HospitalId=$this->id;";
      QueryExecutor::query($sql);
    }
  }

  public function get_ceylinder()
  {
    if (is_null($this->ceylinderAval)) {
      $sql = "SELECT  SmallAvailability,MediumAvailability, LargeAvailability FROM hospitalcylinderdetail WHERE HospitalId=$this->id";
      $result = QueryExecutor::query($sql);
      $row = mysqli_fetch_assoc($result);
      if ($row != null) {
        $this->ceylinderAval = new Ceylinder($row["SmallAvailability"], $row["MediumAvailability"], $row["LargeAvailability"]);
      } else {
        $this->ceylinderAval = new Ceylinder("NO", "NO", "NO");
      }
    }
    return $this->ceylinderAval;
  }

  public function set_ceylinder()
  {
    if (isset($_POST['cylinder'])) {
      $resources = array('SmallAvailability' => 'oxCylinderSmall', 'MediumAvailability' => 'oxCylinderMedium', 'LargeAvailability' => 'oxCylinderLarge');
      foreach ($resources as $resource => $field) {
        if (in_array($field, $_POST['cylinder'])) {
          $sql = "UPDATE `hospitalcylinderdetail` SET `$resource`='YES'  WHERE HospitalId=$this->id;";
          QueryExecutor::query($sql);
        } else {
          $sql = "UPDATE `hospitalcylinderdetail` SET `$resource`='NO'  WHERE HospitalId=$this->id;";
          QueryExecutor::query($sql);
        }
      }
    } else {
      $sql = "UPDATE `hospitalcylinderdetail` SET `SmallAvailability`='NO',`MediumAvailability`='NO',`LargeAvailability`='NO'  WHERE HospitalId=$this->id;";
      QueryExecutor::query($sql);
    }
  }

  public function get_blood()
  {
    if (is_null($this->bloodAval)) {
      $sql = "SELECT  AplusAvailability,AminusAvailability, BplusAvailability ,BminusAvailability, OplusAvailability, OminusAvailability, ABplusAvailability ,ABminusAvailability  FROM blooddetail WHERE HospitalId=$this->id";
      $result = QueryExecutor::query($sql);
      $row = mysqli_fetch_assoc($result);
      if ($row != null) {
        $this->bloodAval = new Blood($row["AplusAvailability"], $row["AminusAvailability"], $row["BplusAvailability"], $row["BminusAvailability"], $row["OplusAvailability"], $row["OminusAvailability"], $row["ABplusAvailability"], $row["ABminusAvailability"]);
      } else {
        $this->bloodAval = new Blood("NO", "NO", "NO", "NO", "NO", "NO", "NO", "NO");
      }
    }
    return $this->bloodAval;
  }
  public function set_blood()
  {
    if (isset($_POST['blood'])) {
      $resources = array('AplusAvailability' => 'bloodAp', 'BplusAvailability' => 'bloodBp', 'OplusAvailability' => 'bloodOp', 'ABplusAvailability' => 'bloodABp', 'AminusAvailability' => 'bloodAn', 'BminusAvailability' => 'bloodBn', 'OminusAvailability' => 'bloodOn', 'ABminusAvailability' => 'bloodABn');
      foreach ($resources as $resource => $field) {
        if (in_array($field, $_POST['blood'])) {
          $sql = "UPDATE `blooddetail` SET `$resource`='YES'  WHERE HospitalId=$this->id;";
          QueryExecutor::query($sql);
        } else {
          $sql = "UPDATE `blooddetail` SET `$resource`='NO'  WHERE HospitalId=$this->id;";
          QueryExecutor::query($sql);
        }
      }
    } else {
      $sql = "UPDATE `blooddetail` SET `AplusAvailability`='NO',`AminusAvailability`='NO',`BplusAvailability`='NO',`BminusAvailability`='NO',`OplusAvailability`='NO',`OminusAvailability`='NO',`ABplusAvailability`='NO',`ABminusAvailability`='NO'  WHERE HospitalId=$this->id;";
      QueryExecutor::query($sql);
    }
  }

  public function get_vaccine()
  {
    if (is_null($this->vaccineAval)) {
      $sql = "SELECT  OxfordAvailability,PfizerAvailability, ModernalAvailability ,SinopharmAvailability, SputnikAvailability  FROM vaccinedetail WHERE HospitalId=$this->id";
      $result = QueryExecutor::query($sql);
      $row = mysqli_fetch_assoc($result);
      if ($row != null) {
        $this->vaccineAval = new Vaccine($row["OxfordAvailability"], $row["PfizerAvailability"], $row["ModernalAvailability"], $row["SinopharmAvailability"], $row["SputnikAvailability"]);
      } else {
        $this->vaccineAval = new Vaccine("NO", "NO", "NO", "NO", "NO");
      }
    }
    return $this->vaccineAval;
  }
  public function set_vaccine()
  {
    if (isset($_POST['vaccine'])) {
      $resources = array('OxfordAvailability' => 'oxfordAsterzeneca', 'PfizerAvailability' => 'pfizer', 'ModernalAvailability' => 'moderna', 'SinopharmAvailability' => 'sinopharm', 'SputnikAvailability' => 'sputnik');
      foreach ($resources as $resource => $field) {
        if (in_array($field, $_POST['vaccine'])) {
          $sql = "UPDATE `VaccineDetail` SET `$resource`='YES'  WHERE HospitalId=$this->id;";
          QueryExecutor::query($sql);
        } else {
          $sql = "UPDATE `VaccineDetail` SET `$resource`='NO'  WHERE HospitalId=$this->id;";
          QueryExecutor::query($sql);
        }
      }
    } else {
      $sql = "UPDATE `VaccineDetail` SET `OxfordAvailability`='NO',`PfizerAvailability`='NO',`ModernalAvailability`='NO',`SinopharmAvailability`='NO',`SputnikAvailability`='NO'  WHERE HospitalId=$this->id;";
      QueryExecutor::query($sql);
    }
  }
  public function get_staredHospital()
  {
    $sql = "SELECT staredHospital FROM `hospital` WHERE HospitalId = $this->id;";
    //$result = $this->connection->query($sql);
    //$row = $result->fetch_assoc();
    $result = QueryExecutor::query($sql);
    $row = $result->fetch_assoc();
    // print_r($row);
    $serialized = $row['staredHospital'];
    $array = unserialize($serialized);
    return $array;
  }
  public function add_staredHospital($userId)
  {
    $temp = $this->get_staredHospital();
    // print_r($temp);
    if (in_array($userId, $temp)) {
    } else {
      array_push($temp, $userId);
      $data = serialize($temp);
      $sql = "UPDATE `hospital` SET `staredHospital`= '$data' WHERE `hospital`.`HospitalId` =  $this->id;";
      //$this->connection->query($sql);
      QueryExecutor::query($sql);
    }
  }
  public function remove_staredHospital($userId)
  {
    $temp = $this->get_staredHospital();
    $key = array_search($userId, $temp);
    if (false !== $key) {
      unset($temp[$key]);
    }
    //unset($temp[$userId]);
    if (empty($temp)) {
      $sql = "UPDATE `hospital` SET `staredHospital`= 'a:0:{}' WHERE `hospital`.`HospitalId` =  $this->id";
    } else {
      $data = serialize($temp);
      $sql = "UPDATE `hospital` SET `staredHospital`= '$data' WHERE `hospital`.`HospitalId` =  $this->id";
    }
    //$this->connection->query($sql);
    QueryExecutor::query($sql);
  }
  public function get_staredProvider()
  {
    $sql = "SELECT staredProvider FROM `hospital` WHERE HospitalId = $this->id;";
    // $result = $this->connection->query($sql);
    // $row = $result->fetch_assoc();
    $result = QueryExecutor::query($sql);
    $row = $result->fetch_assoc();
    // print_r($row);
    $serialized = $row['staredProvider'];
    $array = unserialize($serialized);
    // print_r($array);
    //echo $array;
    return $array;
  }
  public function add_staredProvider($userId)
  {
    $temp = $this->get_staredProvider();
    // print_r($temp);
    if (in_array($userId, $temp)) {
    } else {
      array_push($temp, $userId);
      $data = serialize($temp);
      $sql = "UPDATE `hospital` SET `staredProvider`= '$data' WHERE `hospital`.`HospitalId` =  $this->id;";
      //$this->connection->query($sql);
      QueryExecutor::query($sql);
    }
  }
  public function remove_staredProvider($userId)
  {
    $temp = $this->get_staredProvider();
    $key = array_search($userId, $temp);
    if (false !== $key) {
      unset($temp[$key]);
    }
    //unset($temp[$userId]);
    if (empty($temp)) {
      $sql = "UPDATE `hospital` SET `staredProvider`= 'a:0:{}' WHERE `hospital`.`HospitalId` =  $this->id";
    } else {
      $data = serialize($temp);
      $sql = "UPDATE `hospital` SET `staredProvider`= '$data' WHERE `hospital`.`HospitalId` =  $this->id";
    }
    //$this->connection->query($sql);
    QueryExecutor::query($sql);
  }


  public function filter($para)
  {
    $out = false;
    switch ($para) {

      case '1':
        $out = true;
        break;
      case '11':
        $this->get_bed();
        if ($this->bedAval != null) {
          $out = $this->bedAval->providable();
        }
        break;
      case '12':

        $this->get_ceylinder();
        if ($this->ceylinderAval != null) {
          $out = $this->ceylinderAval->providable();
        }
        break;
      case '13':
        $this->get_blood();
        if ($this->bloodAval != null) {
          $out = $this->bloodAval->providable();
        }
        break;
      case '14':
        $this->get_vaccine();
        if ($this->vaccineAval != null) {
          $out = $this->vaccineAval->providable();
        }
        break;

      case '111':
        $this->get_bed();
        if ($this->bedAval != null) {
          $out = $this->bedAval->check_normal();
        }
        break;
      case '112':
        $this->get_bed();
        if ($this->bedAval != null) {
          $out = $this->bedAval->check_icu();
        }
        break;
      case '121':
        $this->get_ceylinder();
        if ($this->ceylinderAval != null) {
          $out = $this->ceylinderAval->check_small();
        }
        break;
      case '122':
        $this->get_ceylinder();
        if ($this->ceylinderAval != null) {
          $out = $this->ceylinderAval->check_medium();
        }
        break;
      case '123':
        $this->get_ceylinder();
        if ($this->ceylinderAval != null) {
          $out = $this->ceylinderAval->check_large();
        }
        break;
      case '131':
        $this->get_blood();
        if ($this->bloodAval != null) {
          $out = $this->bloodAval->check_aplus();
        }
        break;
      case '132':
        $this->get_blood();
        if ($this->bloodAval != null) {
          $out = $this->bloodAval->check_aminus();
        }
        break;
      case '133':
        $this->get_blood();
        if ($this->bloodAval != null) {
          $out = $this->bloodAval->check_bplus();
        }
        break;
      case '134':
        $this->get_blood();
        if ($this->bloodAval != null) {
          $out = $this->bloodAval->check_bminus();
        }
        break;
      case '135':
        $this->get_blood();
        if ($this->bloodAval != null) {
          $out = $this->bloodAval->check_oplus();
        }
        break;
      case '136':
        $this->get_blood();
        if ($this->bloodAval != null) {
          $out = $this->bloodAval->check_ominus();
        }
        break;
      case '137':
        $this->get_blood();
        if ($this->bloodAval != null) {
          $out = $this->bloodAval->check_abplus();
        }
        break;
      case '138':
        $this->get_blood();
        if ($this->bloodAval != null) {
          $out = $this->bloodAval->check_abminus();
        }
        break;
      case '141':
        $this->get_vaccine();
        if ($this->vaccineAval != null) {
          $out = $this->vaccineAval->check_oxford();
        }
        break;
      case '142':
        $this->get_vaccine();
        if ($this->vaccineAval != null) {
          $out = $this->vaccineAval->check_pfizer();
        }
        break;
      case '143':
        $this->get_vaccine();
        if ($this->vaccineAval != null) {
          $out = $this->vaccineAval->check_moderna();
        }
        break;
      case '144':
        $this->get_vaccine();
        if ($this->vaccineAval != null) {
          $out = $this->vaccineAval->check_sinopharm();
        }
        break;
      case '145':
        $this->get_vaccine();
        if ($this->vaccineAval != null) {
          $out = $this->vaccineAval->check_sputnik();
        }
        break;


      default:
        $out = false;
    }

    return $out;
  }

  public static function fetchByUserName(String $username): Hospital|null
  {
    $stmt = QueryExecutor::prepare("SELECT `HospitalId` FROM `hospital` WHERE username = ?");
    $stmt->bind_param("s", $username);
    if ($stmt->execute() && ($result = $stmt->get_result())) {
      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return Hospital::getInstance($row["HospitalId"]);
      }
    }
    return null;
    /*
    $sql = "SELECT `HospitalId` FROM `Hospital` WHERE username = '$username'";
    if ($result = QueryExecutor::query($sql)) {
      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return Hospital::getInstance($row["HospitalId"]);
      }
    }
    return null;*/
  }

 
  public static function login(String $username): String
  {
    if ($hospital = $hospital = self::fetchByUserName($username) instanceof Hospital) {
      //$_SESSION["acID"] = $hospital->get_id();
      //$_SESSION["type"] = MemberType::HOSPITAL;
      $state = $hospital->get_state();
      if ($state == "NEW") {
        header('Location:updateResources.php');
        exit;
      } else {
        header("Location: hospitalDashoard.php");
        exit;
      }
    } else {
      return $hospital;
    }
  }
}

class Provider extends Member
{
  private static array $providers = array();

  private function __construct($id)
  {
    $sql = "SELECT * FROM `provider` WHERE ProviderId = $id";
    $result = QueryExecutor::query($sql);
    $row = $result->fetch_assoc();

    $this->id = $row["ProviderId"];
    $this->username = $row['UserName'];
    $this->name = $row["Name"];
    $this->address = $row['Address'];
    $this->phoneNo = $row["TelephoneNo"];
    $this->profile = $row['Profile'];
    $this->email = $row["Email"];
    $this->website = $row["Website"];
    $this->accountNo = $row['AccountNumber'];
    $this->bankName = $row['BankName'];
    $this->state = $row['State'];
  }

  public static function getInstance($id): Provider|null
  {
    if (!array_key_exists($id, self::$providers)) {
      $sql = "SELECT ProviderId FROM `provider` WHERE ProviderId = $id";
      if (QueryExecutor::query($sql)->num_rows == 0) {
        return null;
      } else {
        self::$providers[$id] = new Provider($id);
      }
    }
    return self::$providers[$id];
  }

  public function request()
  {
  }
  public function set_state($state)
  {
    $sql = "UPDATE `provider` SET `State`= '$state' WHERE `Provider`.`ProviderId` =  $this->id";
    QueryExecutor::query($sql);
    $this->state = $state;
  }
  public function set_name($name)
  {
    $sql = "UPDATE `Provider` SET `Name`= '$name' WHERE `Provider`.`ProviderId` =  $this->id";
    QueryExecutor::query($sql);
    $this->name = $name;
  }
  public function set_address($address)
  {
    $sql = "UPDATE `Provider` SET `Address` = '$address' WHERE `Provider`.`ProviderId` = $this->id";
    QueryExecutor::query($sql);
    $this->address = $address;
  }
  public function set_phoneno($phoneNo)
  {
    $sql = "UPDATE `Provider` SET `TelephoneNo`= '$phoneNo' WHERE `Provider`.`ProviderId` =  $this->id";
    QueryExecutor::query($sql);
    $this->phoneNo = $phoneNo;
  }
  public function set_website($website)
  {
    $sql = "UPDATE `Provider` SET `Website`= '$website' WHERE `Provider`.`ProviderId` =  $this->id";
    QueryExecutor::query($sql);
    $this->website = $website;
  }
  public function set_profile($profile)
  {

    $sql = "UPDATE `Provider` SET `profile` =  '$profile' WHERE `Provider`.`ProviderId` =  $this->id";
    QueryExecutor::query($sql);
    $this->profile = $profile;
  }
  public function set_email($email)
  {
    $sql = "UPDATE `Provider` SET `Email`= '$email' WHERE `Provider`.`ProviderId` =  $this->id";
    QueryExecutor::query($sql);
    $this->email = $email;
  }

  public function set_accountNo($accountNo)
  {
    $sql = "UPDATE `Provider` SET `AccountNumber`= '$accountNo' WHERE `Provider`.`ProviderId` =  $this->id";
    QueryExecutor::query($sql);
    $this->accountNo = $accountNo;
  }
  public function set_bankName($bankName)
  {
    $sql = "UPDATE `Provider` SET `BankName`= '$bankName' WHERE `Provider`.`ProviderId` =  $this->id";
    QueryExecutor::query($sql);
    $this->bankName = $bankName;
  }

  public function set_bed()
  {
    if (isset($_POST['bed'])) {
      $resources = array('NormalAvailability' => 'normalBed', 'ICUAvailability' => 'icuBed');
      foreach ($resources as $resource => $field) {
        if (in_array($field, $_POST['bed'])) {
          $sql = "UPDATE `providerbeddetail` SET `$resource`='YES'  WHERE ProviderId=$this->id;";
          QueryExecutor::query($sql);
        } else {
          $sql = "UPDATE `providerbeddetail` SET `$resource`='NO'  WHERE ProviderId=$this->id;";
          QueryExecutor::query($sql);
        }
      }
    } else {
      $sql = "UPDATE `providerbeddetail` SET `NormalAvailability`='NO',`ICUAvailability`='NO'  WHERE ProviderId=$this->id;";
      QueryExecutor::query($sql);
    }
  }

  public function set_ceylinder()
  {
    if (isset($_POST['cylinder'])) {
      $resources = array('SmallAvailability' => 'oxCylinderSmall', 'MediumAvailability' => 'oxCylinderMedium', 'LargeAvailability' => 'oxCylinderLarge');
      foreach ($resources as $resource => $field) {
        if (in_array($field, $_POST['cylinder'])) {
          $sql = "UPDATE `providercylinderdetail` SET `$resource`='YES'  WHERE ProviderId=$this->id;";
          QueryExecutor::query($sql);
        } else {
          $sql = "UPDATE `providercylinderdetail` SET `$resource`='NO'  WHERE ProviderId=$this->id;";
          QueryExecutor::query($sql);
        }
      }
    } else {
      $sql = "UPDATE `providercylinderdetail` SET `SmallAvailability`='NO',`MediumAvailability`='NO',`LargeAvailability`='NO'  WHERE ProviderId=$this->id;";
      QueryExecutor::query($sql);
    }
  }


  public function get_staredHospital()
  {
    $sql = "SELECT staredHospital FROM `provider` WHERE ProviderId = $this->id;";
    //$result = $this->connection->query($sql);
    //$row = $result->fetch_assoc();
    $result = QueryExecutor::query($sql);
    $row = $result->fetch_assoc();
    // print_r($row);
    $serialized = $row['staredHospital'];
    $array = unserialize($serialized);
    return $array;
  }
  public function add_staredHospital($userId)
  {
    $temp = $this->get_staredHospital();
    // print_r($temp);
    if (in_array($userId, $temp)) {
    } else {
      array_push($temp, $userId);
      $data = serialize($temp);
      $sql = "UPDATE `provider` SET `staredHospital`= '$data' WHERE `hospital`.`HospitalId` =  $this->id;";
      //$this->connection->query($sql);
      QueryExecutor::query($sql);
    }
  }
  public function remove_staredHospital($userId)
  {
    $temp = $this->get_staredHospital();
    $key = array_search($userId, $temp);
    if (false !== $key) {
      unset($temp[$key]);
    }
    //unset($temp[$userId]);
    if (empty($temp)) {
      $sql = "UPDATE `hospital` SET `staredHospital`= 'a:0:{}' WHERE `hospital`.`HospitalId` =  $this->id";
    } else {
      $data = serialize($temp);
      $sql = "UPDATE `hospital` SET `staredHospital`= '$data' WHERE `hospital`.`HospitalId` =  $this->id";
    }
    //$this->connection->query($sql);
    QueryExecutor::query($sql);
  }
  public function get_staredProvider()
  {
    $sql = "SELECT staredProvider FROM `hospital` WHERE HospitalId = $this->id;";
    // $result = $this->connection->query($sql);
    // $row = $result->fetch_assoc();
    $result = QueryExecutor::query($sql);
    $row = $result->fetch_assoc();
    // print_r($row);
    $serialized = $row['staredProvider'];
    $array = unserialize($serialized);
    // print_r($array);
    //echo $array;
    return $array;
  }
  public function add_staredProvider($userId)
  {
    $temp = $this->get_staredProvider();
    // print_r($temp);
    if (in_array($userId, $temp)) {
    } else {
      array_push($temp, $userId);
      $data = serialize($temp);
      $sql = "UPDATE `hospital` SET `staredProvider`= '$data' WHERE `hospital`.`HospitalId` =  $this->id;";
      //$this->connection->query($sql);
      QueryExecutor::query($sql);
    }
  }
  public function remove_staredProvider($userId)
  {
    $temp = $this->get_staredProvider();
    $key = array_search($userId, $temp);
    if (false !== $key) {
      unset($temp[$key]);
    }
    //unset($temp[$userId]);
    if (empty($temp)) {
      $sql = "UPDATE `hospital` SET `staredProvider`= 'a:0:{}' WHERE `hospital`.`HospitalId` =  $this->id";
    } else {
      $data = serialize($temp);
      $sql = "UPDATE `hospital` SET `staredProvider`= '$data' WHERE `hospital`.`HospitalId` =  $this->id";
    }
    //$this->connection->query($sql);
    QueryExecutor::query($sql);
  }
  public function get_bed()
  {
    if (is_null($this->bedAval)) {
      $sql = "SELECT  NormalAvailability, ICUAvailability FROM providerbeddetail WHERE ProviderId=$this->id";
      $result = QueryExecutor::query($sql);
      $row = mysqli_fetch_assoc($result);
      if ($row != null) {
        $this->bedAval = new Bed($row["NormalAvailability"], $row["ICUAvailability"]);
      } else {
        $this->bedAval = new Bed("NO", "NO");
      }
    }
    return $this->bedAval;
  }


  public function get_ceylinder()
  {
    if (is_null($this->ceylinderAval)) {
      $sql = "SELECT  SmallAvailability,MediumAvailability, LargeAvailability FROM providercylinderdetail WHERE ProviderId=$this->id";
      $result = QueryExecutor::query($sql);
      $row = mysqli_fetch_assoc($result);
      if ($row != null) {
        $this->ceylinderAval = new Ceylinder($row["SmallAvailability"], $row["MediumAvailability"], $row["LargeAvailability"]);
      } else {
        $this->ceylinderAval = new Ceylinder("NO", "NO", "NO");
      }
    }
    return $this->ceylinderAval;
  }

  public function filter($para)
  {

    switch ($para) {

      case '2':
        $out = true;
        break;
      case '21':
        $this->get_bed();
        if ($this->bedAval != null) {
          $out = $this->bedAval->providable();
        }
        break;
      case '22':
        $this->get_ceylinder();
        if ($this->ceylinderAval != null) {
          $out = $this->ceylinderAval->providable();
        }
        break;
      case '21':
        $this->get_bed();
        if ($this->bedAval != null) {
          $out = $this->bedAval->providable();
        }
        break;
      case '22':
        $this->get_ceylinder();
        if ($this->ceylinderAval != null) {
          $out = $this->ceylinderAval->providable();
        }
        break;
      case '211':
        $this->get_bed();
        if ($this->bedAval != null) {
          $out = $this->bedAval->check_normal();
        }
        break;
      case '212':
        $this->get_bed();
        if ($this->bedAval != null) {
          $out = $this->bedAval->check_icu();
        }
        break;
      case '221':
        $this->get_ceylinder();
        if ($this->ceylinderAval != null) {
          $out = $this->ceylinderAval->check_small();
        }
        break;
      case '222':
        $this->get_ceylinder();
        if ($this->ceylinderAval != null) {
          $out = $this->ceylinderAval->check_medium();
        }
        break;
      case '223':
        $this->get_ceylinder();
        if ($this->ceylinderAval != null) {
          $out = $this->ceylinderAval->check_large();
        }
        break;

      default:
        $out = false;
    }

    return $out;
  }

  public static function fetchByUserName(String $username): Provider|null
  {
    $stmt = QueryExecutor::prepare("SELECT `ProviderId` FROM `provider` WHERE username = ?");
    $stmt->bind_param("s", $username);
    if ($stmt->execute() && ($result = $stmt->get_result())) {
      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return Provider::getInstance($row["ProviderId"]);
      }
    }
    return null;
    /* $sql = "SELECT `ProviderId` FROM `Provider` WHERE username = '$username'";
    if ($result = QueryExecutor::query($sql)) {
      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        return Provider::getInstance($row["ProviderId"]);
      }
    }
    return null; */
  }

  

  public static function login(String $username): String
  {
    if (($provider = self::fetchByUserName($username)) instanceof Provider) {
      //$_SESSION["acID"] = $provider->get_id();
      //$_SESSION["type"] = MemberType::PROVIDER;
      $state = $provider->get_state();
      if ($state == "NEW") {
        header('Location:updateResources.php');
        exit;
      } else {
        header('Location: hospitalDashoard.php');
        exit;
      }
      exit;
    } else {
      return $provider;
    }
  }
}

abstract class Equipment
{
  public abstract function providable();
}

class Bed extends Equipment
{
  public $normal;
  public $icu;

  public function __construct($normal, $icu)
  {
    $this->normal = $normal;
    $this->icu = $icu;
  }


  public function check_normal()
  {
    if ($this->normal == "YES") {
      return true;
    }
    return false;
  }
  public function check_icu()
  {
    if ($this->icu == "YES") {
      return true;
    }
    return false;
  }

  public function providable()
  {
    return $this->check_normal() || $this->check_icu();
  }
}

class Vaccine extends Equipment
{
  public $oxford;

  public $pfizer;

  public $moderna;

  public $sinopharm;

  public $sputnik;

  public function __construct($oxford, $pfizer, $moderna, $sinopharm, $sputnik)
  {
    $this->oxford = $oxford;
    $this->pfizer = $pfizer;
    $this->moderna = $moderna;
    $this->sinopharm = $sinopharm;
    $this->sputnik = $sputnik;
  }
  public function check_oxford()
  {
    if ($this->oxford == "YES") {
      return true;
    }
    return false;
  }
  public function check_pfizer()
  {
    if ($this->pfizer == "YES") {
      return true;
    }
    return false;
  }
  public function check_moderna()
  {
    if ($this->moderna == "YES") {
      return true;
    }
    return false;
  }

  public function check_sinopharm()
  {
    if ($this->sinopharm == "YES") {
      return true;
    }
    return false;
  }
  public function check_sputnik()
  {
    if ($this->sputnik == "YES") {
      return true;
    }
    return false;
  }

  public function providable()
  {
    return $this->check_sputnik() || $this->check_sinopharm() || $this->check_sputnik() || $this->check_moderna() || $this->check_pfizer() || $this->check_oxford();
  }
}


class Blood extends Equipment
{
  public $aplus;
  public $aminus;
  public $bplus;
  public $bminus;
  public $oplus;
  public $ominus;
  public $abplus;
  public $abminus;

  public function __construct($aplus, $aminus, $bplus, $bminus, $oplus, $ominus, $abplus, $abminus)
  {
    $this->aplus = $aplus;
    $this->aminus = $aminus;
    $this->bplus = $bplus;
    $this->bminus = $bminus;
    $this->oplus = $oplus;
    $this->ominus = $ominus;
    $this->abplus = $abplus;
    $this->abminus = $abminus;
  }

  public function check_aplus()
  {
    if ($this->aplus == "YES") {
      return true;
    }
    return false;
  }
  public function check_aminus()
  {
    if ($this->aminus == "YES") {
      return true;
    }
    return false;
  }

  public function check_bplus()
  {
    if ($this->bplus == "YES") {
      return true;
    }
    return false;
  }
  public function check_bminus()
  {
    if ($this->bminus == "YES") {
      return true;
    }
    return false;
  }
  public function check_oplus()
  {
    if ($this->oplus == "YES") {
      return true;
    }
    return false;
  }
  public function check_ominus()
  {
    if ($this->ominus == "YES") {
      return true;
    }
    return false;
  }
  public function check_abplus()
  {
    if ($this->abplus == "YES") {
      return true;
    }
    return false;
  }
  public function check_abminus()
  {
    if ($this->abminus == "YES") {
      return true;
    }
    return false;
  }

  public function providable()
  {
    return $this->check_aplus() || $this->check_aminus() || $this->check_bplus() || $this->check_bminus() || $this->check_oplus() || $this->check_ominus() || $this->check_abplus() || $this->check_abminus();
  }
}

class Ceylinder extends Equipment
{
  public $small;
  public $medium;
  public $large;

  public function __construct($small, $medium, $large)
  {
    $this->small = $small;
    $this->medium = $medium;
    $this->large = $large;
  }
  public function check_small()
  {
    if ($this->small == "YES") {
      return true;
    }
    return false;
  }
  public function check_medium()
  {
    if ($this->medium == "YES") {
      return true;
    }
    return false;
  }
  public function check_large()
  {
    if ($this->large == "YES") {
      return true;
    }
    return false;
  }

  public function providable()
  {
    return $this->check_small() || $this->check_medium() || $this->check_large();
  }
}
