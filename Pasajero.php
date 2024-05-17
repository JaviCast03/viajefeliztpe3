<?php
include_once "viaje.php";
class Pasajero{
    private $apellido;
    private $documento;
    private $telefono;
    /* La clase Pasajero tiene como atributos el nombre, el número de asiento y el número de ticket del pasaje del viaje.*/
    private $nombre, $nAsiento, $nTicket;
    public function __construct($nombre,$apellido,$telefono,$documento,$nAsiento,$nTicket)
    {
        $this -> nombre =$nombre;
        $this -> nAsiento =$nAsiento;
        $this -> nTicket =$nTicket;
        $this -> apellido =$apellido;
        $this->documento=$documento;
        $this->telefono=$telefono;
    }
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getDocumento(){
        return $this->documento;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function setApellido($apellido){
        $this->apellido=$apellido;
    }
    public function setDocumento($documento){
         $this->documento=$documento;
    }
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }
    public function getNAsiento() {
        return $this->nAsiento;
    }

    public function setNAsiento($nAsiento) {
        $this->nAsiento = $nAsiento;
    }

    public function getNTicket() {
        return $this->nTicket;
    }

    public function setNTicket($nTicket) {
        $this->nTicket = $nTicket;
    }
    public function __toString()
    {
        return "Nombre: ".$this->getNombre()." ,".  $this->getApellido() . ", DNI: " . $this->getDocumento() . 
        ", Teléfono: " . $this->getTelefono()." Asiento: ". $this->getNAsiento()." Nro Ticket: ". 
        $this->getNTicket()."\n";
    }
    /* Implementar el método darPorcentajeIncremento() que retorne el porcentaje que debe 
    aplicarse como incremento según las características del pasajero.
    Por último, para los pasajeros comunes el porcentaje de incremento es del 10 %.
    */
    public function darPorcentajeIncremento(){
        
        return 10;
         
     }
}