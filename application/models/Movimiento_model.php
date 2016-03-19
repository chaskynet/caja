<?php
/**
* 
*/
class Movimiento_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function apertura_caja($apertura){
		$datos = json_decode($apertura);
		$query = $this->db->query("INSERT INTO inicial (id_inicial, fecha, estado, saldo_inicial, saldo_sig)
									values ('', STR_TO_DATE(REPLACE('$datos->fecha','-','.') ,GET_FORMAT(date,'EUR')), 'Abierto', $datos->saldo_ini, $datos->saldo_ini)");
		return $query;
	}

	public function registra_movimiento($movimiento){
		$datos = json_decode($movimiento);
		if ($datos->moneda == 'usd') {

			$query = $this->db->query("INSERT into movimientos (id_movimiento, id_inicial, tipo_movimiento, descripcion, cantidad, tipo_documento, numero_documento, importe_dolares, tipo_cambio, importe_bolivianos) 
					values('', 1, '$datos->tipo_operacion', '$datos->descripcion', 
							'$datos->monto', '$datos->comprobante', 
							'$datos->num_comprobante', $datos->monto, $datos->tipo_cambio,
							 ($datos->monto * $datos->tipo_cambio))");
		} else{

			$query = $this->db->query("INSERT into movimientos (id_movimiento, id_inicial, tipo_movimiento, descripcion, cantidad, tipo_documento, numero_documento, importe_dolares, tipo_cambio, importe_bolivianos) 
					values('', 1, '$datos->tipo_operacion', '$datos->descripcion', 
							'$datos->monto', '$datos->comprobante', 
							'$datos->num_comprobante', 0, 0,
							 $datos->monto)");
		}
		return $query;
	}
}