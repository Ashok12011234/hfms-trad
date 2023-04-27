INSERT INTO `hospital` (`HospitalId`, `UserName`, `Email`, `Password`, `Name`, `TelephoneNo`, `Address`, `Profile`, `Website`, `BankName`, `AccountNumber`, `staredHospital`, `staredProvider`, `State`) VALUES
(1, 'kajan', 'info@thjaffna.lk', '&$59&$60&$61&$', 'Jaffna', '0212223348', 'Hospital Road, Jaffna, Jaffna District, Northern Province, Sri Lanka', 'assets/documents/DatabaseFiles/Hospital/Profile/17011916.jpg', 'thjaffna.lk', 'HNB', '5494556', 'a:0:{}', 'a:0:{}', 'INITIATED'),
(2, 'hello1234', 'pointpedroBH@thjaffna.lk', '&$59&$60&$61&$', 'Point', '0212263261', 'Point Pedro Road, Point Pedro, Jaffna District, Northern Province, Sri Lanka', 'assets/documents/DatabaseFiles/Hospital/Profile/17011851.jpeg', 'thjaffna.lk', 'boc', '56556', 'a:0:{}', 'a:0:{}', 'NEW'),
(3, 'hello12345', 'chavaHospital@thjaffna.lk', '&$59&$60&$61&$', 'Chavakachcheri', '0213215429', 'A9 Road, Chavakachcheri, Jaffna District, Northern Province, Sri Lanka', 'assets/documents/DatabaseFiles/Hospital/Profile/17012131.jpg', 'thjaffna.lk', 'boc', '56556', 'a:0:{}', 'a:0:{}', 'NEW');


INSERT INTO `provider` (`ProviderId`, `UserName`, `Email`, `Password`, `Name`, `TelephoneNo`, `Address`, `Profile`, `Website`, `BankName`, `AccountNumber`, `staredHospital`, `staredProvider`, `State`) VALUES
(1, 'pro1', 'hi', '&$59&$60&$61&$', 'Irfan', '01101010101', 'No1, Producer 1 Road, Jaffna', 'assets/documents/DatabaseFiles/Hospital/Profile/17122255.png', 'www.Nelliyadihospital.com', 'boc', '2121', 'a:0:{}', 'a:0:{}', 'INITIATED'),
(2, 'pro12', 'hi', '&$59&$60&$61&$', 'Sriram', '01101010101', 'No1, Producer 1 Road, Vvaunija', 'assets/documents/DatabaseFiles/Hospital/Profile/17122328.png', 'www.Nelliyadihospital.com', 'boc', '2121', 'a:0:{}', 'a:0:{}', 'NEW'),
(3, 'pro123', 'hi baby!', '&$59&$60&$61&$', 'Madan tech', '01101010101', 'No1, Producer 1 Road, Mannar', 'assets\\pictures\\profile\\defaultDp.png', 'www.Nelliyadihospital.com', 'boc', '2121', 'a:0:{}', 'a:0:{}', 'NEW');

INSERT INTO `blooddetail` VALUES (1,1,'YES','NO','NO','YES','YES','NO','YES','NO'),(2,4,'NO','YES','NO','YES','YES','NO','NO','YES'),(3,2,'YES','NO','YES','NO','YES','NO','YES','NO');
INSERT INTO `vaccinedetail` VALUES (1,1,'YES','NO','YES','NO','YES'),(2,2,'YES','YES','YES','NO','YES'),(3,4,'YES','YES','YES','NO','NO');
INSERT INTO `hospitalbeddetail` VALUES (1,1,'NO','YES'),(2,4,'NO','NO'),(3,2,'YES','NO');
INSERT INTO `providerbeddetail` VALUES (1,1,'NO','NO'),(2,2,'YES','NO'),(3,3,'YES','NO');
INSERT INTO `hospitalcylinderdetail` VALUES (1,1,'YES','YES','NO'),(2,4,'NO','YES','YES'),(3,2,'NO','YES','YES');
INSERT INTO `providercylinderdetail` VALUES (1,1,'YES','NO','YES'),(2,2,'NO','NO','YES'),(3,3,'YES','YES','NO');
INSERT INTO `newaccount` VALUES (1,'kajan','&$59&$60&$61&$','assignmentoneoop@gmail.com','HOSPITAL','PEOPLE','1122334455','dummyEg','dummyEg','NEW','Not Vertified','Not Vertified');