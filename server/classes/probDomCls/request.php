<?php

class RequestType
{
    public const HH_REQUEST = "HH";
    public const HP_REQUEST = "HP";
}

abstract class Request
{
    protected int $id;
    protected Member $from;
    protected Member $to;
    protected RequestState $state;
    protected String $equipment;
    protected String $quantity;
    protected Chat $chat;
    private String $type;

    public function __construct(int $id, String $type)
    {
        $this->id = $id;
        $this->type = $type;
        $this->state = new Requested(); 
    }

    public abstract function buildChat();

    public function getId(): int 
    {
        return $this->id;
    }

    public function getFrom() 
    {
        return $this->from;
    }

    public function getTo () 
    {
        return $this->to;
    }

    public function getEquipment(): String 
    {
        return $this->equipment;
    }

    public function getQuantity(): String
    {
        return $this->quantity;
    }

    public function getType(): String
    {
        return $this->type;
    }

    public function getChat(): Chat
    {
        return $this->chat;
    }
    public function getState(): RequestState
    {
        return $this->state;
    }
    
    public function setState(RequestState $state)
    {
        $this->state = $state;
    }

    public abstract function assignAll();
    
    public function accept(String $count)
    {
        $this->state->accept($count, $this);
    }

    public function cancel()
    {
        $this->state->cancel($this);
    }

    public function decline()
    {
        $this->state->decline($this);
    }

    public function confirmExchange()
    {
        $this->state->confirmExchange($this);
    }

    public function transport()
    {
        $this->state->transport($this);
    }

    public function sendMsg(Member $sender, String $msg)
    {
        $senderId = $sender->get_id();
        if ($senderId == $this->getTo()->get_id()) {
            $receiverId = $this->getFrom()->get_id();
        }
        else{
            $receiverId = $this->getTo()->get_id();
        }
        if ($sender instanceof Hospital) {
            $senderType = 'HOSPITAL';
        }
        else {
            $senderType = 'PROVIDER';
        }
        $query = "INSERT INTO `Message` (`RequestType`,`RequestId`,`SenderType`,`SenderId`,`ReceiverId`,
                `Message`) VALUES ('".
            $this->getType()."','".
            $this->getId()."','".
            $senderType."','".
            $senderId."','".
            $receiverId."','".
            $msg."'".
            ")";
        QueryExecutor::query($query);
    }

}

class HHRequest extends Request
{
    public function __construct($id)
    {
        parent::__construct($id, RequestType::HH_REQUEST);
    }

    public function assignAll()
    {
        $sql1 = "SELECT * FROM HHrequest WHERE RequestId=$this->id";

        if($result = QueryExecutor::query($sql1)){
           
            $row = $result->fetch_assoc();
            
                $hospitalID=$row["HospitalId"];
                $providerID=$row["ProviderId"];
                $this->equipment=$row["Equipment"];
                $this->quantity=$row["Quantity"];
                $state = $row["State"];            
                if($state =="ACCEPTED"){
                    $this->state = new Accepted(); 
                }
                else if($state =="DECLINED"){
                    $this->state = new Declined();
                }
                else if($state =="TRANSPORTING"){
                    $this->state = new Transporting();
                }
                else if($state =="EXCHANGE_COMPLETED"){
                    $this->state = new ExchangeCompleted();
                }
                else if($state =="CANCELLED"){
                    $this->state = new Cancelled();
                }
        
          
        }
        $sql2 = "SELECT * FROM Hospital WHERE HospitalId=$hospitalID";

        if($result = QueryExecutor::query($sql2)){
            $row = $result->fetch_assoc();
            $this->from = Hospital::getInstance($row["HospitalId"]);

        }

        $sql3 = "SELECT * FROM Hospital WHERE HospitalId=$providerID";

        if($result = QueryExecutor::query($sql3)){
            
            $row = $result->fetch_assoc();
            $this->to = Hospital::getInstance($row["HospitalId"]);

        }
    }

    public function buildChat()
    {
        $chatBuilder = new ChatBuilder();
        $this->chat = $chatBuilder->buildHHChat($this);
    }

}

class HPRequest extends Request
{
    public function __construct($id) 
    {
        parent::__construct($id, RequestType::HP_REQUEST);
    }

    public function assignAll()
    {
        $sql1 = "SELECT * FROM HPrequest WHERE RequestId=$this->id";

        if($result = QueryExecutor::query($sql1)) {
            $row = $result->fetch_assoc();
            $hospitalID=$row["HospitalId"];
            $providerID=$row["ProviderId"];
            $this->equipment=$row["Equipment"];
            $this->quantity=$row["Quantity"];
            $state = $row["State"];            
            if($state =="ACCEPTED"){
                $this->state = new Accepted(); 
            }
            else if($state =="DECLINED"){
                $this->state = new Declined();
            }
            else if($state =="TRANSPORTING"){
                $this->state = new Transporting();
            }
            else if($state =="EXCHANGE_COMPLETED"){
                $this->state = new ExchangeCompleted();
            }
            else if($state =="CANCELLED"){
                $this->state = new Cancelled();
            }
            
          
        }
        $sql2 = "SELECT * FROM Hospital WHERE HospitalId=$hospitalID";

        if($result = QueryExecutor::query($sql2)){
            //$result = $this->connection->query($sql2);
            $row = $result->fetch_assoc();
            $this->from = Hospital::getInstance($row["HospitalId"]);

        }

        $sql3 = "SELECT * FROM Provider WHERE ProviderId=$providerID";

        if($result = QueryExecutor::query($sql3)){
            //$result = $this->connection->query($sql3);
            $row = $result->fetch_assoc();
            $this->to = Provider::getInstance($row["ProviderId"]);

        }
    }

    public function buildChat()
    {
        $chatBuilder = new ChatBuilder();
        $this->chat = $chatBuilder->buildHPChat($this);
    }

}

abstract class RequestState
{
    //public abstract function request(Request $request);
    public abstract function showstate();
    public abstract function accept(String $count, Request $request);
    public abstract function transport(Request $request);
    public abstract function confirmExchange(Request $request);
    public abstract function cancel(Request $request);
    public abstract function decline(Request $request);

}

class Requested extends RequestState
{
    public function showstate(){
        return "Requested";
    }
    public function accept(String $count, Request $request)
    {
        $id1 = $request->getId();
        if($request->getType()=="HP"){
            $sql2 = "UPDATE hprequest  SET State = 'ACCEPTED', Quantity= '$count' WHERE RequestId = '$id1'";
            
        }
        else{
            $sql2 = "UPDATE hhrequest  SET State = 'ACCEPTED', Quantity= '$count' WHERE RequestId = '$id1'";
        }
        

        if($result = QueryExecutor::query($sql2)){
            $request->setState(new Accepted());
        }
        
    }

    public function cancel(Request $request)
    {
        $id1 = $request->getId();
        if($request->getType()=="HP"){
            $sql2 = "UPDATE hprequest  SET State = 'CANCELLED' WHERE RequestId = '$id1'";
            
        }
        else{
            $sql2 = "UPDATE hhrequest  SET State = 'CANCELLED' WHERE RequestId = '$id1'";
        }
        

        if($result = QueryExecutor::query($sql2)){
            $request->setState(new Cancelled());
        }
        
    }

    public function decline(Request $request)
    {
        $id1 = $request->getId();
        if($request->getType()=="HP"){
            $sql2 = "UPDATE hprequest  SET State = 'DECLINED' WHERE RequestId = '$id1'";
            
        }
        else{
            $sql2 = "UPDATE hhrequest  SET State = 'DECLINED' WHERE RequestId = '$id1'";
        }
        

        if($result = QueryExecutor::query($sql2)){
            $request->setState(new Declined());
        }
        
    }

    public function transport(Request $request){}
    public function confirmExchange(Request $request){}
}

class Accepted extends RequestState
{
    public function showstate(){
        return "Accepted";
    }
    public function transport(Request $request)
    {
        $id1 = $request->getId();
        if($request->getType()=="HP"){
            $sql2 = "UPDATE hprequest  SET State = 'TRANSPORTING' WHERE RequestId = '$id1'";
            
        }
        else{
            $sql2 = "UPDATE hhrequest  SET State = 'TRANSPORTING' WHERE RequestId = '$id1'";
        }
        

        if($result = QueryExecutor::query($sql2)){
            $request->setState(new Transporting());
        }
       
    }

    public function cancel(Request $request)
    {
        $id1 = $request->getId();
        if($request->getType()=="HP"){
            $sql2 = "UPDATE hprequest  SET State = 'CANCELLED' WHERE RequestId = '$id1'";
            
        }
        else{
            $sql2 = "UPDATE hhrequest  SET State = 'CANCELLED' WHERE RequestId = '$id1'";
        }
        

        if($result = QueryExecutor::query($sql2)){
            $request->setState(new Cancelled());
        }
    }

    public function accept(String $count, Request $request){}
    public function decline(Request $request){}
    public function confirmExchange(Request $request){}
}

class Transporting extends RequestState
{
    public function showstate(){
        return "Transporting";
    }
    public function confirmExchange(Request $request)
    {
        $id1 = $request->getId();
        if($request->getType()=="HP"){
            $sql2 = "UPDATE hprequest  SET State = 'EXCHANGE_COMPLETED' WHERE RequestId = '$id1'";
            
        }
        else{
            $sql2 = "UPDATE hhrequest  SET State = 'EXCHANGE_COMPLETED' WHERE RequestId = '$id1'";
        }
        

        if($result = QueryExecutor::query($sql2)){
            $request->setState(new ExchangeCompleted());
        }
        
    }

    public function accept(String $count, Request $request){}
    public function cancel(Request $request){}
    public function decline(Request $request){}
    public function transport(Request $request){}
}

class Cancelled extends RequestState
{
    public function showstate(){
        return "Cancelled";
    }
    
    public function accept(String $count, Request $request){}
    public function transport(Request $request){}
    public function confirmExchange(Request $request){}
    public function cancel(Request $request){}
    public function decline(Request $request){}
}

class Declined extends RequestState
{
    public function showstate(){
        return "Declined";
    }
    public function accept(String $count, Request $request){}
    public function transport(Request $request){}
    public function confirmExchange(Request $request){}
    public function cancel(Request $request){}
    public function decline(Request $request){}
}

class ExchangeCompleted extends RequestState
{
    public function showstate(){
        return "Exchange Completed";
    }
    public function accept(String $count, Request $request){}
    public function transport(Request $request){}
    public function confirmExchange(Request $request){}
    public function cancel(Request $request){}
    public function decline(Request $request){}
}

class Chat
{
    private array $messages;

    public function __construct()
    {
        $this->messages = array();
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function addMessage(Message $msg): void
    {
        $this->messages[] = $msg;
    }
}

class ChatBuilder
{
    private Chat $chat;

    public function buildHHChat(HHRequest $hhrequest): Chat
    {
        $this->chat = new Chat();
        $sql="SELECT * FROM `Message` WHERE requestId ='".$hhrequest->getId()."' AND requestType ='HH' ORDER BY time ASC";
        $result = QueryExecutor::query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row) {
            $this->chat->addMessage(new Message($row));
        }
        return $this->chat;
    }

    public function buildHPChat(HPRequest $hprequest): Chat
    {
        $this->chat = new Chat();
        $sql="SELECT * FROM `Message` WHERE requestId ='".$hprequest->getId()."' AND requestType ='HP' ORDER BY time ASC";
        $result = QueryExecutor::query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row) {
            $this->chat->addMessage(new Message($row));
        }
        return $this->chat;
    }
}
class Message
{
    private int $id;
    private int $requestId;
    private String $requestType;
    private String $senderType;
    private int $senderId;
    private int $receiverId;
    private String $msg;
    private int $time;

    public function __construct(array $data)
    {
        //var_dump($data);
        $this->id = $data["MessageId"];
        $this->requestId = $data["RequestId"];
        $this->requestType = $data["RequestType"];
        $this->senderType = $data["SenderType"];
        $this->senderId = $data["SenderId"];
        $this->receiverId = $data["ReceiverId"];
        $this->msg = $data["Message"];
        $this->time = strtotime($data["Time"]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function getRequestType()
    {
        return $this->requestType;
    }

    public function getSenderType()
    {
        return $this->senderType;
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function getReceiverId()
    {
        return $this->receiverId;
    }

    public function getMsg()
    {
        return $this->msg;
    }

    public function getTime()
    {
        return $this->time;
    }

}


?>