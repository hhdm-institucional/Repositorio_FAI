<?php
include_once("memoria.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/


/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* ... COMPLETAR ... */

/**Apellido, nombre: Diaz Mosqueira, Héctor Hernán. 
 * Legajo: 111293. 
 * Carrera: TUDW.
 * Mail: hector.diaz@est.fi.uncoma.edu.ar
 * Usuario Github: hhdm-institucional */


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

//1) 
function cargarjuegos (){
    /**Carga 10 o más juegos predefinidos en una colección de juegos
     * @param array $coleccionjuegos, $unJuego, $nombres
     * @param int $aciertos1, $aciertos2, $empates, $total
     * @return $array 
     */

    /* H: Explicación: uso un array de nombres para crear nombres aleatorios.
     Uso un for para cargar la colección de juegos. */
    $coleccionjuegos=array();  
    $nombres=array("Sofía", "Alejandro", "María", "Sebastián", "Valentina", "Diego");

    for ($i=0; $i < 10; $i++) { 
        $total=random_int(2,8); // mínimo 2 juegos y máximo 8, lo humanamente razonable
        $empates=random_int(0,3); // establesco hasta 3 empates
        $aciertos1=random_int(0,($total-$empates)); // random entre los totales y los ya empatados  
        $aciertos2=$total-$aciertos1-$empates; // los restantes son aciertos 2
        $unJuego=array("jugador1"=>$nombres[random_int(0,5)], "aciertos1"=>$aciertos1,"jugador2"=>$nombres[random_int(0,5)], "aciertos2"=>$aciertos2);
        $coleccionjuegos[$i]=$unJuego;
    }
    return $coleccionjuegos;
}
//2) -> En memoria.php como solicitarNumerosEntre($min,$max)
//3)
function seleccionarOpcion(){
    /**Muestra las opciones del menú en la pantalla, solicita al usuario una opción valida
     * Vuelve a solicitar una opcion si es inválida, la última opcón debe ser Salir
     * @param int $opcion 
     * @return int       */
    
    echo "Ingrese una de las opciones del menú (0 para salir): \n". //LA ULTIMA OPCION DEBE SER SALIR
         "1) Jugar Memoria \n".
         "2) Mostrar un juego \n"
         ;

    $opcion =solicitarNumeroEntre(0,2); // A modificar $max cuando se agregen mas opciones 
    return $opcion;
}
//4)
function imprimirDatosJuego(array $juegos, int $indice){
    /**Dada la colección de juegos y un indice, imprime los datos del juego
     * @param array $unJuego
     * @param string $resultadoUnJuego
     */
                            
    $unJuego=$juegos[$indice];
    $resultadoUnJuego=($unJuego["aciertos1"]>$unJuego["aciertos2"]?"ganó jugador 1":($unJuego["aciertos1"]<$unJuego["aciertos2"]?("ganó jugador 2"):("empate")));
    echo "\n**************************************\n".
        "Juego MEMORIA: ".$indice." ".$resultadoUnJuego." \n".
        "Jugador 1: ".$unJuego["jugador1"]." obtuvo ".$unJuego["aciertos1"]." aciertos \n".//ver de poner el nombre en uppercase
        "Jugador 2: ".$unJuego["jugador2"]." obtuvo ".$unJuego["aciertos2"]." aciertos \n".
        "**************************************\n\n";  
                
}
//5)
function agregarJuego(array $juegos, array $unJuego){
    /** Lee una colección de juegos y un juego, agrega el juego a la colección
     * @return array    */
    $juegos[count($juegos)]=$unJuego;
}
//6)
function primerJuegoGanado(array $juegos, string $nombreJuegador){
    /**Lee una colección de juegos y un nombre de jugador y retorna el índice del primer juego ganado por dicho jugador
     * @param int $indice, $cont, $cant
     * @param array $unJuego
     * @return int     */
    $indice=-1;
    $cont=0;
    $cant=count($juegos);
    while ($cont<$cant && $indice==-1) {
        $unJuego=$juegos[$cont];
        if ($unJuego["jugador1"]==$nombreJuegador && $unJuego["aciertos1"]>$unJuego["aciertos2"]) {
            $indice=$cont;    
        }elseif ($unJuego["jugador2"]==$nombreJuegador && $unJuego["aciertos2"]>$unJuego["aciertos1"]) {
            $indice=$cont;    
        }
        $cont++;
    }
    return $indice;
}

// 6)
/**
 * Retorna el índice del primer juego ganado por el jugador dado.
 * Si no ganó ningún juego, retorna -1.
 * @param array $partidas
 * @param string $nombre
 * @return int
 */
function indicePrimerJuegoGanado($partidas, $nombre) {

    for ($i = 0; $i < count($partidas); $i++) {

        $jug1 = $partidas[$i]["jugador1"];
        $jug2 = $partidas[$i]["jugador2"];

        // ganó jugador 1
        if ($jug1 == $nombre && $partidas[$i]["aciertos1"] > $partidas[$i]["aciertos2"]) {
            return $i;
        }

        // ganó jugador 2
        if ($jug2 == $nombre && $partidas[$i]["aciertos2"] > $partidas[$i]["aciertos1"]) {
            return $i;
        }
    }

    return -1; // no ganó nunca
}

// 7)
/**
 * Función que dada la colleción de juegos y el nombre de un jugador
 * retorna el resumen del jugador.
 * @param array $juegos
 * @param string $nombreJugador
 * @return array
 */
function resumenJugador (array $iniciarJuego, string $nombreJugador){

    $ganados = 0;
    $perdidos = 0;
    $empatados = 0;
    $acumulado = 0;
    $aciertos = 0;
    
    // recorrer todas las partidas
    for ($i = 0; $i < count($iniciarJuego); $i++) {

        $p = $iniciarJuego[$i];

        // ¿el jugador participó?
        if ($p["jugador1"] == $nombreJugador) {

            if ($p["gano"] == 1) {
                $ganados++;
            } elseif ($p["gano"] == 2) {
                $perdidos++;
            } else {
                $empatados++;
            }

            $acumulado = $acumulado + $p["aciertos1"];
        }else if ($p["jugador2"] == $nombreJugador) {

            if ($p["gano"] == 2) {
                $ganados++;
            } elseif ($p["gano"] == 1) {
                $perdidos++;
            } else {
                $empatados++;
            }

            $acumulado = $acumulado + $p["aciertos2"];
        }
    }
    
    return [
        "jugador" => $nombreJugador,
        "ganados" => $ganados,
        "perdidos" => $perdidos,
        "empatados" => $empatados,
        "aciertos" => $acumulado
    ];

}


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
/*
 * @param int $cantjuegos, $opcion, $nroJuego
 * @param array $juegos, $unJuego 
 * @param string $resultadoUnJuego
 */


//Inicialización de variables:
$opcion=0;
$nroJuego=-1;
$resultadoUnJuego="";
//Precargado (Punto 11.a)
$juegos=cargarjuegos();
$cantjuegos=count($juegos); //total de juegos en $juegos

//Proceso:

// Estas 3 líneas de código ejecutan el juego y muestran el arreglo retornado con los resultado
// Probar la primera vez y luego comentar/borrar
//>$juego = jugarMemoria();
//>echo "jugador 1 " . $juego["jugador1"] . ": " . $juego["aciertos1"] . " aciertos" . "\n";
//>echo "jugador 2 " . $juego["jugador2"] . ": " . $juego["aciertos2"] . " aciertos" . "\n";



do {    
    $opcion =seleccionarOpcion();

    switch ($opcion) {
        case 1: /* 1) JUGAR A MEMORIA */ 
            /* Al iniciar se solicitan los nombres de los jugadores (lo hace la funcion en memoria.php)
            * Al finalizar guarda los resultados en una estructura de datos ($juegos)  */
            $unJuego=jugarMemoria();
            $juegos[$cantjuegos]=$unJuego; //Si ya hay 10 juegos, el índice 10 es correcto para guardar el siguiente juego
            $cantjuegos++;
            break;

        case 2: 
            /* 2) MOSTRAR UN JUEGO */
            /* Se solicita al usuario un número de juego y se lo muestra en pantalla */
            echo "Ingrese un número entre 0 y ".($cantjuegos-1)." \n";
            $nroJuego=solicitarNumeroEntre(0,$cantjuegos-1);
            imprimirDatosJuego($juegos, $nroJuego);                
            break;

        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
        case 0: 
            echo "Saliendo...\n";
            break;
        default:
            echo "Opción invalida... \n";
            break;
    }
} while ($opcion != 0);
