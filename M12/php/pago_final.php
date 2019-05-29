<?php

include "dbConnection.php";

if (isset($_POST['cardNumber']) && isset($_POST['cardExpirationDate']) && isset($_POST['cardCvcCode']) && isset($_POST['cardOwner'])){

    $number = trim($_POST['cardNumber']);
    $exp = trim($_POST['cardExpirationDate']);
    $cvc = trim($_POST['cardCvcCode']);
    $own = trim($_POST['cardOwner']);

    $faltaCampo = false;
    $cardOk = false;

    if($number == "" || $exp == "" || $cvc == "" || $own == "" ){
        $faltaCampo = true;
    }

    if (validatecard($number)){
        $cardOk = true;
        //Guardo el tipo de tarjeta que devuelve la funcion (visa, mastercard, amex o discover);
        $tipoTarjeta = validatecard($number);
    }

    if ($faltaCampo){
        echo "error";
    } else if ($cardOk == false){
        echo "error card";
    } else if ($cardOk && $faltaCampo == false){
        echo "1";
    }
} else {
    echo "Error, no existen todos los atributos";
}
$conn->close();

function validatecard($number){
    global $type;

    $cardtype = array(
        "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
        "mastercard" => "/^5[1-5][0-9]{14}$/",
        "amex"       => "/^3[47][0-9]{13}$/",
        "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
    );

    if (preg_match($cardtype['visa'],$number))
    {
	$type= "visa";
        return 'visa';
	
    }
    else if (preg_match($cardtype['mastercard'],$number))
    {
	$type= "mastercard";
        return 'mastercard';
    }
    else if (preg_match($cardtype['amex'],$number))
    {
	$type= "amex";
        return 'amex';
	
    }
    else if (preg_match($cardtype['discover'],$number))
    {
	$type= "discover";
        return 'discover';
    }
    else
    {
        return false;
    } 
}
?>