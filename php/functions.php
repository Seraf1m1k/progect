<?php
function AlertJS(string $str, int $type = 4, bool $resetform = false, string $url = "")
{
    $error = 0;
    switch ($type)
    {
        case 1:
            $error = "success";
            break;
        case 2:
            $error = "warning";
            break;
        case 3:
            $error = "error";
            break;
        default:
            $error = "info";
            break;
    }
    $value = 
    [ 
        "str" => $str,
        "type" => $error,
        "resetform" => $resetform,
        "redirect" => $url
    ];
    header("Content-Type: application/json");
    echo json_encode($value);
}
?>