<?php
/*La clase Pasajeros con necesidades especiales se refiere a pasajeros que pueden requerir servicios especiales como 
sillas de ruedas, asistencia para el embarque o desembarque, o comidas especiales para personas con alergias o 
restricciones alimentarias
*/
class PasajeroNE extends Pasajero{
    private $silla,$asitencia,$comidas,$restriccionesA;
    
    public function __construct($nombre,$apellido,$telefono,$documento,$nAsiento,$nTicket, $silla,$asitencia,$comidas,$restriccionesA)
    {
        parent::__construct($nombre,$apellido,$telefono,$documento,$nAsiento,$nTicket);
        $this->silla=$silla;
        $this->asitencia=$asitencia;
        $this->comidas=$comidas;
        $this->restriccionesA=$restriccionesA;
    }
    // Métodos Get
    public function getSilla() {
        return $this->silla;
    }

    public function getAsitencia() {
        return $this->asitencia;
    }

    public function getComidas() {
        return $this->comidas;
    }

    public function getRestriccionesA() {
        return $this->restriccionesA;
    }
    // Métodos Set
    public function setSilla($silla) {
        $this->silla = $silla;
    }

    public function setAsistencia($asitencia) {
        $this->asitencia = $asitencia;
    }

    public function setComidas($comidas) {
        $this->comidas = $comidas;
    }

    public function setRestriccionesA($restriccionesA) {
        $this->restriccionesA = $restriccionesA;
    }
    public function VoF($resp){
        strtolower($resp);
        if($resp=="si"){
            $resp=true;
        }
        else{
            $resp=false;
        }
        return $resp;
    }
    public function __toString() {
        return parent::__toString() . "Silla: " . $this->silla . ", Asistencia: " . $this->asitencia . ", Comidas: " . 
        $this->comidas . ", Restricciones Alimenticias: " . $this->restriccionesA."\n";
    }
    /* Si el pasajero tiene necesidades especiales y requiere silla de ruedas, asistencia y comida especial entonces el 
    pasaje tiene un incremento del 30%; si solo requiere uno de los servicios prestados entonces el incremento es del 15%.*/
    public function darPorcentajeIncremento(){
        $silla=$this->getSilla();
        $asistencia=$this->getAsitencia();
        $comidas=$this->getComidas();
        $silla=$this->VoF($silla);
        $comidas=$this->VoF($comidas);
        $asistencia=$this->VoF($asistencia);
        $inc=30;
        if(($silla && !$asistencia && !$comidas) OR
        (!$silla && $asistencia && !$comidas) OR
        (!$silla && !$asistencia && $comidas) ){
            $inc=15;
        }
        return $inc;
     }
}
