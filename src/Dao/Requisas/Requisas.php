<?php

namespace Dao\Requisas;

use Dao\Table;

class Requisas extends Table
{
    public static function obtenerRequisas()
    {
        $sqlstr = 'SELECT * FROM requisas;';
        $requisas = self::obtenerRegistros($sqlstr, []);
        return $requisas;
    }

    public static function obtenerRequisaPorId($id)
    {
        $sqlstr = 'SELECT * from requisas where codigo=:codigo;';
        $requisa = self::obtenerUnRegistro($sqlstr, ["codigo" => $id]);
        return $requisa;
    }

    public static function agregarRequisa($requisa)
    {
        $sqlstr = 'insert into requisas (
        date_requested, name_requester, department, quantity, item, unit_cost, total, department_approval, 
        director_approval, date_received, received_by
        ) 
        values(
        :now(), :name_requester, :department, :quantity, :item, :unit_cost, :total,
        :department_approval, :director_approval, :date_received, :received_by
        );';
        return self::executeNonQuery($sqlstr, $requisa);
    }
}