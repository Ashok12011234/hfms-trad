<?php
class NewAccount
{
    private  $id;
    private String $emailAddress;
    private String $username;
    private String $password;
    private String $acType;
    private String $bankName;
    private String $bankAcNumber;
    private String $bankEvidence;
    private String $instituteEvidence;

    public function __construct()
    {
        
    }


    public function setID(String $id)
    {
        $this->id = $id;
    }
    public function getID()
    {
        return $this->id;
    }

    
    public function setEmailAddress(String $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    public function getEmailAddress(): String
    {
        return $this->emailAddress;
    }

    public function setUsername(String $username)
    {
        $this->username = $username;
    }

    public function getUsername(): String
    {
        return $this->username;
    }

    public function setPassword(String $password)
    {
        $this->password = $password;
    }

    public function getPassword(): String
    {
        return $this->password;
    }

    public function setAcType(String $acType)
    {
        $this->acType = $acType;
    }

    public function getAcType(): String
    {
        return $this->acType;
    }

    public function setBankName(String $bankName)
    {
        $this->bankName = $bankName;
    }

    public function getBankName(): String
    {
        return $this->bankName;
    }

    public function setBankAcNumber(String $bankAcNumber)
    {
        $this->bankAcNumber = $bankAcNumber;
    }

    public function getBankAcNumber(): String
    {
        return $this->bankAcNumber;
    }

    public function setBankEvidence(String $bankEvidence)
    {
        $this->bankEvidence = $bankEvidence;
    }

    public function getBankEvidence(): String
    {
        return $this->bankEvidence;
    }
    
    public function setInstituteEvidence(String $instituteEvidence)
    {
        $this->instituteEvidence = $instituteEvidence;
    }

    public function getInstituteEvidence(): String
    {
        return $this->instituteEvidence;
    }

    public function receiveMail()
    {
        # code...
    }
    
    
}