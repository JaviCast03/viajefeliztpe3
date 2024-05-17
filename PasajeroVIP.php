<?php
//La clase "PasajeroVIP" tiene como atributos adicionales el número de viajero frecuente y cantidad de millas de pasajero. 
class PasajeroVIP extends Pasajero{
    
    private $nFrecuente, $millas;
    public function __construct($nombre,$apellido,$telefono,$documento,$nAsiento,$nTicket,$nFrecuente,$millas)
    {
        parent::__construct($nombre,$apellido,$telefono,$documento,$nAsiento,$nTicket);
        $this->nFrecuente=$nFrecuente;
        
        
        $this->nFrecuente=$nFrecuente;
        $this->millas=$millas;
    }
    public function getNFrecuente() {
        return $this->nFrecuente;
    }

    public function setNFrecuente($nFrecuente) {
        $this->nFrecuente = $nFrecuente;
    }
    public function getMillas() {
        return $this->millas;
    }
    public function setMillas($millas) {
        $this->millas = $millas;
    }
   
    public function __toString()
    {
        $cadena=parent::__toString();
        $cadena.=" Nro viajero frecuente: ".$this->getNFrecuente(). " Cantidad de millas del pasajero: ".$this->getMillas();
        return $cadena;
    }
    /*Para un pasajero VIP se incrementa el importe un 35% y si la cantidad de 
    millas acumuladas supera a las 300 millas se realiza un incremento del 30%.
    */
    public function darPorcentajeIncremento(){
        $inc=35;
        if($this->getMillas()>300){
            $inc=30;
        }
        return $inc;

     }
}