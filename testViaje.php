<?php
include_once "viaje.php";
include_once "responsableV.php";
include_once "Pasajero.php";
include_once "PasajeroVIP.php";
include_once "PasajeroNE.php";
$pasajero= new Pasajero("Javi","castillo",999,2,32,3);
$pasajero2=new Pasajero("daniel","puentes",888,4,90,49);
$responsable=new ResponsableV(30, 102, "Javier", "Castillo");
$viaje= new Viaje(321, "neuquen", 50, $responsable,[$pasajero,$pasajero2],500);
function opcionMenu(){
    $menu="1)Agregar pasajero.\n2)Modificar informacion de un pasajero.\n3)Mostrar informacion del viaje.\n4)Modificar informacion del responsable. \n5)Salir";
    echo $menu."\n";
    $numeroOpcionMenu=trim(fgets(STDIN));

    //valida que la opcion ingresada sea valida
    while($numeroOpcionMenu<1 || $numeroOpcionMenu>5){
        echo "Numero invalido ingrese un numero entre 1-5 \n";
        echo $menu;
        $numeroOpcionMenu=trim(fgets(STDIN));
    }
    return $numeroOpcionMenu;
}

$opcionElegida=true;
do{
    $opcion= opcionMenu();

    switch($opcion){

    case 1: 
        echo "Nombre del pasajero: \n";
        $nombreNuevo=trim(fgets(STDIN));
        echo "Apellido del pasajero: \n";
        $apellidoNuevo=trim(fgets(STDIN));
        echo"DNI: \n";
        $dniNuevo=trim(fgets(STDIN));
        echo "Telefono: \n";
        $telefonoNuevo=trim(fgets(STDIN));
        echo "Asiento del pasajero: \n";
        $asiento=trim(fgets(STDIN));
        echo"Numero de ticket: \n";
        $nTicket=trim(fgets(STDIN));
        echo "Aprete 1 para un pasaje, 2 para un pasaje VIP, 3 para un pasaje con necesidades especiales \n";
        $tipoPasaje=trim(fgets(STDIN));
        if($tipoPasaje==1){
            $pasajeroNuevo= new Pasajero($nombreNuevo,$apellidoNuevo,$telefonoNuevo,$dniNuevo,$asiento, $nTicket);
            $sePudoAgregar=$viaje->agregarPasajero($pasajeroNuevo);
            
        }
        if($tipoPasaje==2){
            echo "Ingrese numero de viajero frecuente: \n";
            $nFrecuente=trim(fgets(STDIN));
            $pasajeroNuevo= new PasajeroVIP($nombreNuevo,$apellidoNuevo,$telefono,$dniNuevo,$asiento,$nTicket,$nFrecuente,0);
            $sePudoAgregar=$viaje->agregarPasajero($pasajeroNuevo);
            
        }
        
        if($tipoPasaje==3){
            echo "Responda con si o no \n";

            echo "Necesita silla: \n";
            $silla=trim(fgets(STDIN));
            echo "Necesita asistencia: \n";
            $asistencia=trim(fgets(STDIN));
            echo "Necesita comidas especiales: \n";
            $comidas=trim(fgets(STDIN));
            echo "Necesita  restricciones alimenticias: \n";
            $restriccionesA=trim(fgets(STDIN));
            $pasajeroNuevo= new PasajeroNE($nombreNuevo,$apellidoNuevo,$telefonoNuevo,$dniNuevo, $asiento, $nTicket,$silla,$asistencia,$comidas,$restriccionesA);
            $sePudoAgregar=$viaje->venderPasaje($pasajeroNuevo);
            echo"El costo del pasaje es de: $".$sePudoAgregar."\n";
        }
        if($sePudoAgregar){
            echo "El pasajero se agrego correctamente.\n";
            echo $pasajeroNuevo;
        }
        else{
            echo "El pasajero ya existe.\n";
        }
        break;
    case 2:
        echo "Ingrese el DNI del pasajero por modificar: \n";
        $dniModif = trim(fgets(STDIN));
        $objPasajeroPorModificar = $viaje->existePasajero($dniModif);

        if ($objPasajeroPorModificar !== null) {
            echo "Ingrese el nombre: \n";
            $nombreM = trim(fgets(STDIN));
            echo "Ingrese el apellido: \n";
            $apellidoM = trim(fgets(STDIN));
            echo "Ingrese el telefono: \n";
            $telefonoM = trim(fgets(STDIN));
            if ($objPasajeroPorModificar instanceof PasajeroVIP) {
                echo "Ingrese el num. asiento: \n";
                $nAsiento = trim(fgets(STDIN));
                echo "Ingrese el num. del ticket: \n";
                $nTicket = trim(fgets(STDIN));
                echo "Ingrese el num. de millas: \n";
                $millas = trim(fgets(STDIN));
                echo "Ingrese el num. de pasajero frecuente: \n";
                $nFrecuente = trim(fgets(STDIN));

                if ($viaje->modificarPasajeroVIP($dniModif, $nombreM, $apellidoM, $telefonoM,$nAsiento, $nTicket, $nFrecuente, $millas)) {
                    echo "El pasajero VIP se ha modificado correctamente. \n";
                } else {
                    echo "El pasajero VIP no se encontro en el viaje. \n";
                }
            }

            if ($objPasajeroPorModificar instanceof PasajeroNE) {
                echo "\nResponda con si o no: \n";
                echo "Necesita silla: \n";
                $silla = trim(fgets(STDIN));
                echo "necesita asistencia: \n";
                $asistencia = trim(fgets(STDIN));
                echo "Necesita comidas especiales: \n";
                $comidas = trim(fgets(STDIN));
                echo "Necesita restricciones alimenticias: \n";
                $restriccionesA = trim(fgets(STDIN));

                if ($viaje->modificarPasajeroNE($dniModif,$nombreM, $apellidoM, $telefonoM, $silla, $asistencia, $comidas, $restriccionesA)) {
                    echo "El pasajero NE se ha modificado correctamente. \n ".$objPasajeroPorModificar."\n";
                } else {
                    echo "El pasajero NE no se encontro en el viaje. \n";
                }
            }
            if ($objPasajeroPorModificar instanceof Pasajero&&!($objPasajeroPorModificar instanceof PasajeroNE) OR
            !($objPasajeroPorModificar instanceof PasajeroVIP)) {
                if ($viaje->modificarPasajero($dniModif, $nombreM, $apellidoM, $telefonoM)) {
                    echo "El pasajero se ha modificado correctamente. \n HOLAAAAAAAAAAAAAAAAA";
                } else {
                    echo "El pasajero no se encontro en el viaje. \n";
                }
            }
        } else {
            echo "El pasajero no se encontro en el viaje. \n";
        }
        break;
    case 3:
        echo"Codigo de viaje:".$viaje->getCodigo()."\n".
        "Destino:".$viaje->getDestino()."\n".
        "Capacidad maxima:".$viaje->getMaxPasajeros()." personas.\n".
        "Responsable:".$responsable->getNombre()." ".$responsable->getApellido()."\n".
        "Num de empleado:".$responsable->getNumEmpleado()."\n".
        "Num de licencia:".$responsable->getNumLicencia()."\n".
        $viaje->obtenerInformacionPasajeros();
        
        break;
    case 4:
        echo "Ingrese el nombre: ";
        $nombreEmpleado=trim(fgets(STDIN));
        $responsable->setNombre($nombreEmpleado);
        echo "\nIngrese el apellido: ";
        $apellidoEmpleado=trim(fgets(STDIN));
        $responsable->setApellido($apellidoEmpleado);
        echo "\nIngrese el num de licencia: ";
        $licencia=trim(fgets(STDIN));
        $responsable->setNumLicencia($licencia);
        echo "\nIngrese el num de empleado: ";
        $numEmpleado=trim(fgets(STDIN));
        $responsable->setNumEmpleado($numEmpleado);
        
        break;
    case 5:
        $opcionElegida=false;
        break;
}

}while($opcionElegida);