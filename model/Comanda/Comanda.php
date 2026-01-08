<?php
class Comanda{
    private int $id;
    private float $preu_total;
    /**
     * IMPORTANT:
     * - The DB column is `comanda.id_usuaris` (plural).
     * - Using the same name here ensures mysqli::fetch_object('Comanda') hydrates it.
     */
    private int $id_usuaris;

    // public function __construct(float $preu_total, int $id_usuari){
    //         $this -> preu_total = $preu_total;
    //         $this -> id_usuari = $id_usuari;
    //     }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of preu_total
     */ 
    public function getPreuTotal()
    {
        return $this->preu_total;
    }

    /**
     * Get the value of id_usuaris (DB column)
     */ 
    public function getIdUsuaris()
    {
        return $this->id_usuaris;
    }

    /**
     * Backwards-compatible aliases.
     * Some parts of the codebase call these variants.
     */
    public function getIdUsuari() { return $this->getIdUsuaris(); }
    public function getId_usuari() { return $this->getIdUsuaris(); }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of preu_total
     *
     * @return  self
     */ 
    public function setPreuTotal($preu_total)
    {
        $this->preu_total = $preu_total;

        return $this;
    }

    /**
     * Set the value of id_usuaris
     *
     * @return  self
     */ 
    public function setIdUsuaris($id_usuaris)
    {
        $this->id_usuaris = $id_usuaris;

        return $this;
    }

    /**
     * Backwards-compatible aliases.
     */
    public function setIdUsuari($id_usuari) { return $this->setIdUsuaris($id_usuari); }
    public function setId_usuari($id_usuari) { return $this->setIdUsuaris($id_usuari); }
}

?>