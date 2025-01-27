<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

class Jugador //extends Model
{
    private $cartas;
    private $perdido = false;

    public function __construct(Mazo $mazo) {
        for($i=0; $i<2; $i++){
            $this->cartas[]=$mazo->barajar();
        }
        $this->cartas[] = $mazo->barajar();
        $this->cartas[] = $mazo->barajar();
    }

    public function obtenerCarta() {
        if(count($this->cartas) == 0){
            $this->perdido = true;
            return null;
        }
        $carta = array_shift($this->cartas);
        return $carta;
    }

    public function getCartas() {
        return $this->cartas;
    }



    public function surrender(){

        $this->perdido= true;

    }

    public function getScore(){

        $playerScore = 0;
        $cards = $this->cartas;

        foreach ($cards as $card){
            $playerScore += $card->getValue();
        }
        return $playerScore;
    }

    //stand does not have a method in the player class but will instead call hit on the dealer instance.


    //hasLost will return the bool of the lost property.
    public function hasLost(){

        return $this->perdido;

    }
}
