<?php
include_once("memoria.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/**
 * Apellido, nombre: Corsini, Agustín.
 * Legajo: FAI-5302. 
 * Carrera: TUDW.
 * Mail: agustin.corsini@est.fi.uncoma.edu.ar
 * Usuario GitHub: AgustinCorsini
 * 
 * Apellido, nombre: Diaz Mosqueira, Héctor Hernán. 
 * Legajo: 111293. 
 * Carrera: TUDW.
 * Mail: hector.diaz@est.fi.uncoma.edu.ar
 * Usuario Github: hhdm-institucional
 * */


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

//1)
/** Carga 10 juegos predefinidos en una colección de juegos
 * @return array
 */
function cargarJuegos (){ 
    $coleccionJuegos = array(
    // Jugada 1: 
    0 => array(
        "jugador1" => "Sofía",
        "aciertos1" => 8,
        "jugador2" => "Alejandro",
        "aciertos2" => 3
    ), 

    // Jugada 2: 
    1 => array(
        "jugador1" => "María",
        "aciertos1" => 5,
        "jugador2" => "Sebastián",
        "aciertos2" => 9
    ),

    // Jugada 3: 
    2 => array(
        "jugador1" => "Valentina",
        "aciertos1" => 4,
        "jugador2" => "Diego",
        "aciertos2" => 4
    ),

    // Jugada 4: 
    3 => array(
        "jugador1" => "Alejandro",
        "aciertos1" => 6,
        "jugador2" => "Sofía",
        "aciertos2" => 2
    ),

    // Jugada 5: 
    4 => array(
        "jugador1" => "Diego",
        "aciertos1" => 10,
        "jugador2" => "María",
        "aciertos2" => 7
    ),

    // Jugada 6: 
    5 => array(
        "jugador1" => "Sebastián",
        "aciertos1" => 5,
        "jugador2" => "Valentina",
        "aciertos2" => 5
    ),
    
    // Jugada 7: 
    6 => array(
        "jugador1" => "María",
        "aciertos1" => 7,
        "jugador2" => "Alejandro",
        "aciertos2" => 6
    ),

    // Jugada 8: 
    7 => array(
        "jugador1" => "Valentina",
        "aciertos1" => 2,
        "jugador2" => "Sofía",
        "aciertos2" => 3 
    ),

    // Jugada 9: 
    8 => array(
        "jugador1" => "Diego",
        "aciertos1" => 9,
        "jugador2" => "Sebastián",
        "aciertos2" => 9
    ),

    // Jugada 10: 
    9 => array(
        "jugador1" => "Alejandro",
        "aciertos1" => 15, 
        "jugador2" => "María",
        "aciertos2" => 8
    ) 
    );    

    return $coleccionJuegos;
}
//2) -> En memoria.php como solicitarNumerosEntre($min,$max)
//3)
/** Muestra las opciones del menú en la pantalla, solicita al usuario una opción valida
 * Vuelve a solicitar una opcion si es inválida, la última opción es salir del programa
 * @return int      
 */
function seleccionarOpcion(){
    echo "Ingrese una de las opciones del menú: \n". 
         "1) Jugar Memoria \n".
         "2) Mostrar un juego \n".
         "3) Mostrar el primer juego ganador \n".
         "4) Mostrara el porcentaje de juegos ganados \n".
         "5) Mostrar resumen del jugador \n".
         "6) Mostrar listado de juegos ordenado por jugador 2 \n".
         "7) Salir \n";

    $opcion =solicitarNumeroEntre(1,7); 
    return $opcion;
}

// FUNCION AUXILIAR GANADOR DE UN JUEGO 
/** Recibe unJuego, determina si el ganador es el jugador1 (1), el jugador2(2) o empataron (0)
 * @param array $unJuego
 * @return int
 */
function ganador($unJuego){
    if ($unJuego["aciertos1"] > $unJuego["aciertos2"]) {
            $ganador = 1;
    } elseif ($unJuego["aciertos2"] > $unJuego["aciertos1"]) {
            $ganador = 2;
    } else {
            $ganador = 0; // empate
    }
    return $ganador;
}

//4)
/** Dada la colección de juegos y un indice, imprime los datos del juego
 * @param array $juegos
 * @param int $indice
 */
function imprimirDatosJuego($juegos, $indice){
    $unJuego=$juegos[$indice];
    $resultadoUnJuego=(ganador($unJuego)==1?"ganó jugador 1":(ganador($unJuego)==2?"ganó jugador 2":"empate"));

    echo "\n**************************************\n".
        "Juego MEMORIA: ".($indice+1).", (".$resultadoUnJuego.") \n".
        "Jugador 1: ".strtoupper($unJuego["jugador1"])." obtuvo ".$unJuego["aciertos1"]." aciertos \n".
        "Jugador 2: ".strtoupper($unJuego["jugador2"])." obtuvo ".$unJuego["aciertos2"]." aciertos \n".
        "**************************************\n\n";                  
}
//5)
/** Lee una colección de juegos y un juego, agrega el juego a la colección
 * @param array $juegos
 * @param array $unJuego
 * @return array   
 */
function agregarJuego($juegos, $unJuego){
    $juegos[count($juegos)]=$unJuego;
    return $juegos;
}
//6)
/** Lee una colección de juegos y un nombre de jugador y retorna el índice del primer
 *  juego ganado por dicho jugador, si el jugador no ganó ningún juego retorna -1.
 * @param array $juegos
 * @param string $nombreJugador
 * @return int     
 */
function primerJuegoGanado($juegos, $nombreJugador){
    $indice=-1;
    $cont=0;
    $cant=count($juegos);
    while ($cont<$cant && $indice==-1) {
        $unJuego=$juegos[$cont];
        if ($unJuego["jugador1"]==$nombreJugador && ganador($unJuego)==1) {
            $indice=$cont;    
        }elseif ($unJuego["jugador2"]==$nombreJugador && ganador($unJuego)==2) {
            $indice=$cont;    
        }
        $cont++;
    }
    return $indice;
}
//7)
/** Función que dada la colección de juegos y el nombre de un jugador
 * retorna el resumen del jugador.
 * @param array $juegos
 * @param string $nombreJugador
 * @return array
 */
function resumenJugador($juegos, $nombreJugador) {

    $ganados = 0;
    $perdidos = 0;
    $empatados = 0;
    $acumulado = 0;

    for ($i = 0; $i < count($juegos); $i++) {
        $p = $juegos[$i];

        // Determinar ganador según aciertos
        $g=ganador($p);

        // ¿El jugador participó en esta partida?
        if ($p["jugador1"] == $nombreJugador) {
            $acumulado += $p["aciertos1"];

            if ($g == 1) {
                $ganados++;
            } elseif ($g == 2) {
                $perdidos++;
            } else {
                $empatados++;
            }
        }
        // ¿Jugó como jugador2?
        elseif ($p["jugador2"] == $nombreJugador) {
            $acumulado += $p["aciertos2"];

            if ($g == 2) {
                $ganados++;
            } elseif ($g == 1) {
                $perdidos++;
            } else {
                $empatados++;
            }
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
//8
    /** Dado una colección de juegos cuenta y retorna la cantidad de juegos que fueron ganados por algún jugador 
     * @param array $juegos
     * @return int 
     * */
function cantidadGanados($juegos){
    $cont=0;
    foreach ($juegos as $unJuego) {
        if (ganador($unJuego)!=0) {
            $cont++;
        }
    }
    return $cont;
}
//9
    /** Dada una colección de juegos cuenta los ganados por el jugador nroJugador
     * @param array $juegos
     * @param int $nroJugador
     * @return int
     * */
function cantidadGanadosNroJugador ($juegos, $nroJugador){
    $ganados=0;
    foreach ($juegos as $unJuego){
        if (ganador($unJuego)==$nroJugador) {
            $ganados++;
        }
    }
    return $ganados;
}
//10
/**
 * Dada una colección de juegos, muestra la colección de juegos ordenada por Jugador2  
 * @param array $juegos
*/
function ordenarPorJugador2 ($juegos){
    uasort($juegos,'cmp');
    print_r($juegos);
} 
    /** 
     * Funcion de comparación entre dos juegos  
     * @param array $juego1
     * @param array $juego2
     * @return int    
     * */
function cmp($juego1, $juego2){
    if($juego1["jugador2"]==$juego2["jugador2"]){
        $orden=0;
    }elseif ($juego1["jugador2"]<$juego2["jugador2"]) {
        $orden=-1;
    }else{
        $orden=1;
    }
    return $orden;
}
//


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
/**
 * int $cantJuegos, $opcion, $nroJuego, $ganados, $nroJugador
 * array $juegos, $unJuego
 * string $resultadoUnJuego, $unNombre
 * float $porcentaje
 */

//Inicialización de variables:
$opcion=0;
$nroJuego=-1;
$resultadoUnJuego="";
$unNombre="";
$ganados=0;
$nroJugador=0;
$porcentaje=0;
//Precargado (Punto 11.a)
$juegos=cargarJuegos();
$cantJuegos=count($juegos); //total de juegos en $juegos

do {    
    $opcion =seleccionarOpcion();

    switch ($opcion) {
        case 1: /* 1) JUGAR A MEMORIA */ 
            /* Al iniciar se solicitan los nombres de los jugadores (lo hace la funcion en memoria.php)
            /* Al finalizar guarda los resultados en una estructura de datos ($juegos) */
            echo "\n--- JUGAR A MEMORIA ---\n";
            $unJuego=jugarMemoria(); 
            $juegos=agregarJuego($juegos,$unJuego); 
            $cantJuegos++;
            break;

        case 2: 
            /* 2) MOSTRAR UN JUEGO */
            /* Se solicita al usuario un número de juego y se lo muestra en pantalla */
            echo "\n--- MOSTRAR UN JUEGO ---\n";
            echo "Ingrese un número entre 1 y ".($cantJuegos)." \n";
            $nroJuego=solicitarNumeroEntre(1,$cantJuegos);
            imprimirDatosJuego($juegos, ($nroJuego-1));                
            break;

        case 3:
            /* MOSTRAR EL PRIMER JUEGO GANADOR */
            /* Se solicita el nombre de un jugador y se muestra por pantalla el primer juego ganado por esté */
            echo "\n--- MOSTRAR EL PRIMER JUEGO GANADOR ---\n";
            echo "Ingrese el nombre del jugador:\n";
            $unNombre = ucfirst(strtolower(trim(fgets(STDIN)))); //Primer aseguramos todo en minúscula (strtolower), luego la letra capital (ucfirst)
            $indice = primerJuegoGanado($juegos, $unNombre);

            if ($indice == -1) {
                echo "El jugador '$unNombre' no ganó ningún juego.\n";
            } else {
                imprimirDatosJuego($juegos, $indice);
            }
            break;
        
        case 4:
            /* 4) MOSTRAR PORCENTAJE DE JUEGOS GANADOS */ 
            /* Se solicita al usuario un nro de jugador y se imprime una leyenda con el porcentaje de juegos ganados por ese jugador */
            echo "\n--- MOSTRAR PORCENTAJE DE JUEGOS GANADOS ---\n";
            echo "Ingrese un número de jugador (1 o 2): \n";
            $nroJugador=solicitarNumeroEntre(1, 2);
            $ganados=cantidadGanadosNroJugador($juegos,$nroJugador);
            
            $totalGanados = cantidadGanados($juegos);

            if ($totalGanados > 0) {
                $porcentaje = ($ganados * 100) / $totalGanados;
            } else {
                $porcentaje = 0; // o el valor que quieras mostrar cuando no hay ganadores
            }

            echo "El jugador ".$nroJugador." ganó el ".$porcentaje."% del total de los juegos ganados. \n";
            break;
        
        case 5:
            /* MOSTRAR RESUMEN DEL JUGADOR */
            /* Muestra un resumen de la actividad en los juegos de un jugador ingresado */
            echo "\n--- MOSTRAR RESUMEN DEL JUGADOR ---\n";
            echo "Ingrese el nombre del jugador: ";
            // normalizamos el nombre tal como guardás los nombres en los juegos
            $nombreJugador = ucfirst(strtolower(trim(fgets(STDIN))));

            // capturamos el array que retorna la función
            $resumen = resumenJugador($juegos, $nombreJugador);

            // mostramos el resumen formateado
            echo "**************************************\n";
            echo "Jugador: " . strtoupper($resumen['jugador']). "\n";
            echo "Ganó: " . $resumen['ganados'] . " juegos\n";
            echo "Perdió: " . $resumen['perdidos'] . " juegos\n";
            echo "Empató: " . $resumen['empatados'] . " juegos\n";
            echo "Total de aciertos acumulados: " . $resumen['aciertos'] . " aciertos\n";
            echo "**************************************\n\n";
            break;
        
        case 6:
            /** MOSTRAR LISTADO DE JUEGOS ORDENADO POR JUGADOR 2
             * Se mostrara por pantalla la estructura ordenada alfabéticamente por jugador 2 
             * USA LAS FUNCIONES PREDEFINIDAS DE PHP: UASORT Y PRINT_R
             *      uasort — Ordena un array utilizando una función de comparación (cmp) 
             *      consultar manual: https://www.php.net/manual/es/function.uasort.php 
             *      print_r — Muestra información legible para una variable 
             *      consultar manual: https://www.php.net/manual/es/function.print-r.php
             */
            echo "\n--- MOSTRAR LISTADO DE JUEGOS ORDENADOS POR JUGADOR 2 ---\n";
            ordenarPorJugador2($juegos);  
            break;

        case 7: 
            echo "Saliendo...\n";
            break;
    }
} while ($opcion != 7);
