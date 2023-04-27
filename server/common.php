<?php

function Redirect_to($NewLocation)
{
    header("Location:" . $NewLocation);
    exit;
}

function limitingContent($content, $count)
{
    if (strlen($content) > $count) {
        $out = substr($content, 0, $count);
        $out .= "....";
        return $out;
    } else {
        return $content;
    }
}


function ErrorMessage()
{
    if (isset($_SESSION["ErrorMessage"])) {
        $output = "<div class='alert alert-danger'>";
        $output .= htmlentities($_SESSION["ErrorMessage"]);
        $output .= "</div>";
        $_SESSION["ErrorMessage"] = null;
        return $output;
    }
}

function SuccessMessage()
{
    if (isset($_SESSION["SuccessMessage"])) {
        $output = "<div class='alert alert-success'>";
        $output .= htmlentities($_SESSION["SuccessMessage"]);
        $output .= "</div>";
        $_SESSION["SuccessMessage"] = null;
        return $output;
    }
}
