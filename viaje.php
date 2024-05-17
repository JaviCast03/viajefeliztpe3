<?php
include_once "Pasajero.php";
include_once "PasajeroVIP.php";
include_once "PasajeroNE.php";
class Viaje {
    private $codigo;
    private $destino;
    private $maxPasajeros;
    private $colPasajeros = []; // Colección de objetos Pasajero
    private $responsable;
    private $costoV;
    private $recaudado;

    public function __construct($codigo, $destino, $maxPasajeros, $responsable,$colPasajeros,$costoV) {
        $this->codigo = $codigo;
        $this->destino = $destino;
        $this->maxPasajeros = $maxPasajeros;
        $this->responsable = $responsable;
        $this->costoV = $costoV;
        $this->colPasajeros=$colPasajeros;
    }

    public function getCodigo(){
        return $this->codigo;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getMaxPasajeros(){
        return $this->maxPasajeros;
    }
    public function getColPasajeros(){
        return $this->colPasajeros;
    }
    public function getResponsable(){
        return $this->responsable;
    }
    public function getCostoV(){
        return $this->costoV;
    }
    public function getRecaudadoPorViaje(){
        return $this->recaudado;
    }
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    public function setDestino($destino){
        $this->destino = $destino;
    }
    public function setCantPasajeros($maxPasajeros){
        $this->maxPasajeros = $maxPasajeros;
    }
    public function setColPasajeros($objPasajero){
        $this->colPasajeros=$objPasajero;
    }
    public function setPasajeros($responsable){
        $this->responsable = $responsable;
    }
    public function setCostoV($costoV){
        $this->costoV = $costoV;
    }
    public function setRecaudadoPorViaje($recaudado){
        $this->recaudado = $recaudado;
    }
    public function existePasajero(int $numeroDeDocumento){
        $colPasajeros = $this->getColPasajeros();
        $pasajeroEncontrado = null;
        $encontrado = false;
        $i = 0;
        while (!$encontrado && count($this->getColPasajeros()) > $i){
            if ($colPasajeros[$i]->getDocumento() == $numeroDeDocumento){
                $encontrado = true;
                $pasajeroEncontrado = $colPasajeros[$i];
            }
            $i++;
        }
        return $pasajeroEncontrado;
    }
    
    public function agregarPasajero($pasajero) {
        $resp=false;// El pasajero ya existe en el viaje
        $espacioDispo=$this->hayPasajesDisponibles();
        $colPasajeros=$this->getColPasajeros();
        $documento=$pasajero->getDocumento();
        if (!$this->existePasajero($documento)&&$espacioDispo) {
            array_push($colPasajeros,$pasajero);
            $this->setColPasajeros($colPasajeros);
            $resp= true;
        }
        return $resp; 
    }

    public function modificarPasajero($documento, $nuevoNombre, $nuevoApellido, $nuevoTelefono) {
        $resp=false;// El pasajero no se encontró en el viaje
        $pasajeros=$this->getColPasajeros();
       
        foreach ($pasajeros as $pasajero) {
            if ($pasajero->getDocumento() == $documento) {
                $pasajero->setNombre($nuevoNombre);
                $pasajero->setApellido($nuevoApellido);
                $pasajero->setTelefono($nuevoTelefono);
                $resp= true;
                
            }
        }
        return $resp; 
    
    }
    public function modificarPasajeroVIP($documento,$nuevoNombre, $nuevoApellido, $nuevoTelefono,$nAsiento,$nTicket,$nFrecuente,$millas) {
        $resp=false;// El pasajero no se encontró en el viaje
        $pasajeros=$this->getColPasajeros();
       //$nAsiento,$nTicket,$nFrecuente,$millas
        foreach ($pasajeros as $pasajero) {
            if ($pasajero->getDocumento() == $documento) {
                $pasajero->setNAsiento($nAsiento);
                $pasajero->setNTicket($nTicket);
                $pasajero->setNFrecuente($nFrecuente);
                $pasajero->setMillas($millas);
                $pasajero->setNombre($nuevoNombre);
                $pasajero->setApellido($nuevoApellido);
                $pasajero->setTelefono($nuevoTelefono);
                $resp= true;
                
            }
        }
        return $resp; 
    
    }
    public function modificarPasajeroNE($documento,$nuevoNombre, $nuevoApellido, $nuevoTelefono,$silla,$asitencia,$comidas,$restriccionesA) {
        $resp=false;// El pasajero no se encontró en el viaje
        $pasajeros=$this->getColPasajeros();
       //$nAsiento,$nTicket,$nFrecuente,$millas
        foreach ($pasajeros as $pasajero) {
            if ($pasajero->getDocumento() == $documento) {
                $pasajero->setSilla($silla);
                $pasajero->setAsistencia($asitencia);
                $pasajero->setComidas($comidas);
                $pasajero->setRestriccionesA($restriccionesA);
                $pasajero->setNombre($nuevoNombre);
                $pasajero->setApellido($nuevoApellido);
                $pasajero->setTelefono($nuevoTelefono);
                $resp= true;
                
            }
        }
        return $resp; 
    
    }

    public function obtenerInformacionPasajeros() {
        echo"Información de los pasajeros:\n";
        foreach ($this->getColPasajeros() as $pasajero) {
            echo $pasajero;
        }
        
    }
    /*Modificar la clase viaje para almacenar el costo del viaje, la suma de los costos abonados por los pasajeros e
     implementar el método venderPasaje($objPasajero) que debe incorporar el pasajero a la colección de pasajeros 
     ( solo si hay espacio disponible), actualizar los costos abonados y retornar el costo final que deberá ser abonado 
     por el pasajero.
    */
    public function venderPasaje($objPasajero){
        
        $costoTotal=$this->getRecaudadoPorViaje();
        
        $pasajeroAgregado=$this->agregarPasajero($objPasajero);
        if($pasajeroAgregado){
            $incremento=$objPasajero->darPorcentajeIncremento();
            $costoAbonado= $this->getCostoV() * $incremento / 100;
            $costoTotal+=$costoAbonado;
            $this->setRecaudadoPorViaje($costoTotal);
            $colAbonos[]=$costoAbonado;
            $resp=$costoAbonado;
            
        }
        else{
            $resp=false;
        }
        return $resp; 
        }
    //Implemente la función hayPasajesDisponible() que retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros y falso caso contrario
    public function hayPasajesDisponibles(){
        $resp=false;
        $maxPasajeros=$this->getMaxPasajeros();
        $colPasajeros=$this->getColPasajeros();
        if($maxPasajeros>count($colPasajeros)){
            $resp=true;
        }
        return $resp;
    }
}