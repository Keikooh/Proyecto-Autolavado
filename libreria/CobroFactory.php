<?php

require_once 'libreria/CobroTractoCamion.php';
require_once 'libreria/CobroCamioneta.php';
require_once 'libreria/CobroAutomovil.php';
enum Vehiculos{
    case Automovil;
    case Camioneta;
    case TractoCamion;
};
    class CobroFactory{

        private static $instance;

        private function __construct(){

        }

        public static function getInstance(){
            if (!self::$instance)
                return new self();

            return self::$instance;
        }

        function Facturar($tipo):IFacturacion{
            switch ($tipo) {
                case Vehiculos::Automovil: return new CobroAutomovil();
                case Vehiculos::Camioneta: return new CobroCamioneta();
                case Vehiculos::TractoCamion: return new CobroTractoCamion();
            }
        }
    }