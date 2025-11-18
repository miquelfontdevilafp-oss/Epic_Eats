<?php
class Proveidor{
    private int $id;
    private string $nom;
    private string $correu;
    private string $telefon;
    
    public function __construct(string $nom, string $correu, string $telefon){
        $this-> nom = $nom;
        $this-> correu = $correu;
        $this-> telefon = $telefon;
    }
}