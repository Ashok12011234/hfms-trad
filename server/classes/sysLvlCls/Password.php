<?php
class Password
{
    public static function encrypt(string $decryptedText): string
    {
        $encryptedText = "&$";
        $chars = str_split($decryptedText);
        foreach ($chars as $char) {
            $encryptedChar = (ord( $char) + 10)."&$" ;
            $encryptedText .= $encryptedChar;
        }
        return $encryptedText;
    }

    public static function decrypt(string $encryptedText): string
    {
        $decryptedText = "";
        $ords = explode("&$", trim($encryptedText,'&$'));
        foreach ($ords as $ord) {
            $decryptedChar = chr((int)$ord - 10);
            $decryptedText .= $decryptedChar;
        }
        return $decryptedText;
    }
}

/*
echo Password::encrypt("kajan");
echo "<br>";
echo Password::decrypt("&$117&$107&$116&$107&$120&$");
*/


