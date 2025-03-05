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
        unset($requisa['codigo']);
        unset($requisa['date_requested']);
        unset($requisa['status']);
        $sqlstr = 'insert into requisas (
        date_requested, 
        name_requester, 
        department, 
        quantity, 
        item, 
        unit_cost, 
        total, 
        department_approval, 
        director_approval, 
        date_received, 
        received_by
        ) 
        values(
        now(), 
        :name_requester, 
        :department, 
        :quantity, 
        :item, 
        :unit_cost, 
        :total,
        :department_approval, 
        :director_approval, 
        :date_received, 
        :received_by);';
        
        return self::executeNonQuery($sqlstr, $requisa);
    }

    public static function actualizarRequisa($requisa)
    {
        unset($requisa['date_requested']);
        unset($requisa['status']);
        $sqlstr = "update requisas set 
        name_requester = :name_requester, 
        department = :department, 
        quantity = :quantity, 
        item = :item, 
        unit_cost = :unit_cost, 
        total = :total, 
        department_approval = :department_approval, 
        director_approval = :director_approval, 
        date_received = :date_received, 
        received_by = :received_by 
        where codigo = :codigo;";

        return self::executeNonQuery($sqlstr, $requisa);
    }

    public static function eliminarRequisa($codigo)
    {
        $sqlstr = "delete from requisa where codigo = :codigo;";
        return self::executeNonQuery($sqlstr, ["codigo"=>$codigo]);
    }
}