<?php
require "vendor/autoload.php";
$server=new nusoap_server;
$server->configureWSDL('server','urn:server');
$server->wsdl->schemaTargertNamespace='urn:sever';
$server->register('notas',
                array('alumno'=>'xsd:string','v1'=>'xsd:float','v2'=>'xsd:float','v3'=>'xsd:float'),
                array('return'=>'xsd:string','return'=>'xsd:float'),
                'urn:server',
                'urn:server#notaserver',
                'rpc',
                'encoded',
                'Funcion promedio notas alumnos'
);

function notas($alumno,$v1,$v2,$v3) {
    $total=0;
    for ($i=$v1*0.25;$i=$v2*0.25;$i=$v3*0.5;$i++) {
        $total+=$i/3;
    }
    return $total;
}

$server->wsdl->addComplextype(
    'alumno',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'idalu'=>array('idalu'=>'id_user','type'=>'xsd:int'),
        'nombre'=>array("nombre"=>'fullname',"type"=>'xsd:string'),
        'lalb1'=>array('lalb1'=>'lab1','type'=>'xsd:float'),
        'lab2'=>array('lab2'=>'lab2','type'=>'xsd:float'),
        'parcial'=>array('parcial'=>'parcial','type'=>'xsd:float'),
    )
    );

    class baseDeDatos {
        protected $conexion;
        protected $isConnected=false;
    
        public function conectar() {
            $this->conexion= new mysqli("localhost","usernoticias","catolica","REGISTRO_MIGUEL");
            if ($this->conexion->connect_error) {
                echo "Error de conexion".
                $this->conexion->connect_error;
                $this->isConnected=false;
            } else {
                $this->isConnected=true;
            }
            return $this->isConnected;       
            
        }
        public function getArrayfromResult($result) {
            $records=array();
            while($row=$result->fetch_assoc()) {
                $records[]=$row;
            }
            return $records;
        }
        //insert into alumno_miguel values(null, alumno, v1, v2, v3)

    }
$server->service(file_get_contents("php://input"));