<?php

include "dbConnection.php";

if (isset($_POST['cardNumber']) && isset($_POST['cardExpirationDate']) && isset($_POST['cardCvcCode']) && isset($_POST['cardOwner'])){
    $numberSpace = trim($_POST['cardNumber']);
    $number = str_replace(' ', '', $numberSpace);
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
        /*SI TODO HA IDO BIEN SE ENVIA LA INFORMACIÓN DE CARRODETALLE A COMANDADETALLE
        Y SE EFECTUA EL PAGO. CARRODETALLE SE BORRARÁ CADA VEZ QUE SE EL PAGO SEA OK.*/
        $pagoFinalizado = false;

        //COMPROBACIÓN codigo de carro del cliente
        include "shop_getCartId.php";

        $data = array();
        //Select de todos los productos que tiene el carro id proveniente del usuario en sesion
        $r0 = $conn->prepare("SELECT prod_id, cantidad FROM carrodetalle WHERE carro_id = ?");
        //Ligamos el parámetro ? con el atributo (variable) que nos interesa
        $r0->bind_param("i", $idCarro);
        //Ejecutamos la consulta
        $r0->execute();
        //Resultado de todos los atributos de la BBDD
        $r0->bind_result($p, $c);
        $result = $r0->get_result();
        if($r0){
            /* obtener los valores */
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        $r0->close();

        /******************* COMPROBACIÓN id comanda no pagada del cliente *****************/
        include "pago_getComandaId.php";

        //Se recorre el array de los productos de carrodetalle que se han guardado anteriormente
        foreach($data as $value){
            $idProd = $value['prod_id'];
            $cant = $value['cantidad'];

            $sql = "INSERT INTO comandadetalle (com_id, prod_id, cantidad) VALUES (?,?,?)";
            $rdo = $conn->prepare($sql);
            $rdo->bind_param("iii", $idComanda, $idProd, $cant);
            if($rdo->execute()){
                $pagoFinalizado = true;
            } 
        }

        if ($pedidoPendienteDePago){
            $estadoEnProceso = 1;
            $sql = "UPDATE comanda SET card_type = ?, status = ? WHERE id = ?";
            $rdo = $conn->prepare($sql);
            $rdo->bind_param("sii", $tipoTarjeta, $estadoEnProceso, $idComanda);
            if($rdo->execute()){
                //Si todo ha ido bien y se ha efectuado el pago se borran los productos de carrodeatelle del cliente
                if($pagoFinalizado){
                    $sql = "delete from carrodetalle where carro_id='$idCarro'";
                    if($conn->query($sql) === TRUE){
                        echo "1";
                    } else {
                        echo "Error";
                    }
                }
            } else {
                echo "Error al actualizar los datos";
            }
        }
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