<?php
class Productos
{
    private $id;
    private $descripcion;
    private $stock;
    private $ultimo_costo;
    private $id_linea;
    private $id_sublinea;

    function __construct()
    {
    }


    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }

    public function getUltimoCosto()
    {
        return $this->ultimo_costo;
    }
    public function setUltimoCosto($ultimo_costo)
    {
        $this->ultimo_costo = $ultimo_costo;
        return $this;
    }
    public function getIdLinea()
    {
        return $this->id_linea;
    }

    public function setIdLinea($id_linea)
    {
        $this->id_linea = $id_linea;
        return $this;
    }

    public function getIdSublinea()
    {
        return $this->id_sublinea;
    }

    public function setIdSublinea($id_sublinea)
    {
        $this->id_sublinea = $id_sublinea;
        return $this;
    }
}
