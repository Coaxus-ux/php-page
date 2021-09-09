<?php
class Movimientos{
    private $id;
    private $tipo_movimiento;
    private $cedula_movimiento;
    private $nombre_movimiento;
    private $fecha_movimiento;
    private $valor_total;

    function __construct(){}


    public function getTipoMovimiento()
    {
        return $this->tipo_movimiento;
    }


    public function setTipoMovimiento($tipo_movimiento)
    {
        $this->tipo_movimiento = $tipo_movimiento;
    }


    public function getCedulaMovimiento()
    {
        return $this->cedula_movimiento;
    }


    public function setCedulaMovimiento($cedula_movimiento)
    {
        $this->cedula_movimiento = $cedula_movimiento;
    }

    public function getNombreMovimiento()
    {
        return $this->nombre_movimiento;
    }

    public function setNombreMovimiento($nombre_movimiento)
    {
        $this->nombre_movimiento = $nombre_movimiento;
    }

    public function getFechaMovimiento()
    {
        return $this->fecha_movimiento;
    }

    public function setFechaMovimiento($fecha_movimiento)
    {
        $this->fecha_movimiento = $fecha_movimiento;
    }

    public function getValorTotal()
    {
        return $this->valor_total;
    }

    public function setValorTotal($valor_total)
    {
        $this->valor_total = $valor_total;
    }

}
