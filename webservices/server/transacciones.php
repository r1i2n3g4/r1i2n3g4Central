<?php
require_once "../nusoap/nusoap.php";

$server = new soap_server();
$server->configureWSDL( "transacciones", "urn:transacciones" );
  
$server->register( "fnGenerica",
    array( 
            "codOperacion" => "xsd:string", 
            "nombre" => "xsd:string", 
            "email" => "xsd:string", 
            "numControl" => "xsd:string", 
            "monto" => "xsd:decimal", 
            "idVirtualPoint" => "xsd:string", 
            "duracionOperaciones" => "xsd:string", 
            "idUsuario" => "xsd:string", 
            "idCliente" => "xsd:string",  
            "hashValidate" => "xsd:string"
            ),
    array( "return" => "xsd:string" ),
    "urn:transacciones",
    "urn:transacciones#fnGenerica",
    "rpc",
    "encoded",
    "Este WebService permite registrar una transaccion en el sistema." );

$post = file_get_contents( "php://input" );
$server->service( $post );

function fnGenerica( $codOperacion, $nombre, $email, $numControl, $monto, $idVirtualPoint, $duracionOperaciones, $idUsuario, $idCliente, $hashValidate ) 
{
    
    require_once "../../includes/db.php";
    
    if ( ( strlen( $hashValidate ) == 41 ) && ( substr( $hashValidate, 0, 1 ) == "*" ) )  //ES UN HASH VALIDO
    {
        
        $existHash = $db->count( "hash_clientes", "*", ["hashCliente" => $hashValidate] );
        
        if ( $existHash ) //SI EXISTE EL HASH SE PROCEDE CON EL PROCESO DE LOGIN
        {
            $datosCliente = $db->get("clientes", ["idVendedor", "tasa", "distribucionInterna", "distribucionVendedor"], ["id" => $idCliente]);

            $datos = $db->insert("operaciones_h", [
                                        "codOperacion" => $codOperacion,
                                        "nombre" => strtoupper($nombre),
                                        "email" => $email,
                                        "numControl" => strtoupper($numControl),
                                        "monto" => number_format($monto, 2, ".", ""),
                                        "idVirtualPoint" => $idVirtualPoint,
                                        "duracionOperaciones" => $duracionOperaciones,
                                        "idUsuario" => $idUsuario,
                                        "idCliente" => $idCliente,
                                        "idVendedor" => $datosCliente["idVendedor"],
                                        "tasa" => $datosCliente["tasa"],
                                        "distribucionInterna" => $datosCliente["distribucionInterna"],
                                        "distribucionVendedor" => $datosCliente["distribucionVendedor"],
                                        "#fecCreacion" => "NOW()",
                                        "estatus" => "1"
                                        ]); 

            $respuesta["success"] = 0; //Transanccion exitosa
            return json_encode( $respuesta );

        } else 
        {
            
            $respuesta["errors"] = 1; //Hash no existe en el sistema
            return json_encode( $respuesta );

        }
    } else 
    {
        
        $respuesta["errors"] = 0; //Hash invalido
        return json_encode( $respuesta );

    }
}

?>