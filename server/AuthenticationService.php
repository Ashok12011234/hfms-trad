<?php


class AuthenticationService {
    public static $email;
    public static $hasSession;
    public static $cookies;

    

    public static function setCookies() {
        foreach ($_COOKIE as $name => $value) {
            self::$cookies .= $name . '=' . $value . ';';
        }
    }


    public static function getUser() {
        self::setCookies();
        
        // Set up curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/oauth2/userinfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_COOKIE, self::$cookies);

        // Execute request
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response, true); // decode the JSON string into an associative array
        self::$email = $response['email']; // access the value of the "email" key
        return self::$email;
    }

    public static function isActive() {
        // implementation
        // Set up curl request
        self::setCookies();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/oauth2/auth');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_COOKIE, self::$cookies);

        // Execute request
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE); // get the HTTP status code
        curl_close($ch);

        if ($status == 202) {
            // authenticated logic here
            return true;
        } elseif ($status == 401) {
            // unauthenticated logic here
            //echo "Unauthenticated!";
            return false;
        } else {
            // handle other response statuses as needed
            echo "Unexpected response status: " . $status;
            return false;
        }

    }

    public static function apiCall() {
        // implementation
        // Set up curl request
        self::setCookies();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/api/requests');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_COOKIE, self::$cookies);

        // Execute request
        $response = curl_exec($ch);
        curl_close($ch);

        // Parse response into a result object
        $result = json_decode($response);

        return $result;

    }
}

//$email = AuthenticationService::getUser();
//echo $email;
//echo AuthenticationService::isActive();
?>