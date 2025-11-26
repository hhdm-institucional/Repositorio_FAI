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
 * Usuario Github: hhdm-institucional
 * 
 * Apéllido, nombre: Corsini, Agustín.
 * Legajo: FAI-5302. 
 * Carrera: TUDW.
 * Mail: agustin.corsini@est.fi.uncoma.edu.ar
 * Usuario GitHub: AgustinCorsini*/


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
         "2) Mostrar un juego \n".
         "3) Mostrar el primer juego ganador \n".
         "4) Mostrara el porcentaje de juegos ganados \n"
         ;

    $opcion =solicitarNumeroEntre(0,4); // A modificar $max cuando se agregen mas opciones 
    /* 
    echo "Ingrese una de las opciones del menú (0 para salir):\n";
    echo "1) Jugar Memoria\n";
    echo "2) Mostrar un juego\n";
    echo "3) Mostrar primer juego ganado\n";
    echo "4) Mostrar resumen de jugador\n";
    echo "5) Agregar un juego nuevo\n";
    echo "0) Salir\n";

    $opcion = solicitarNumeroEntre(0, 5);
    */
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
    
    /*
    if ($unJuego["aciertos1"] > $unJuego["aciertos2"]) {
        $resultado = "Ganó jugador 1";
    } elseif ($unJuego["aciertos2"] > $unJuego["aciertos1"]) {
        $resultado = "Ganó jugador 2";
    } else {
        $resultado = "Empate";
    }

    */
    
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
function primerJuegoGanado(array $juegos, string $nombreJugador){
    /**Lee una colección de juegos y un nombre de jugador y retorna el índice del primer juego ganado por dicho jugador
     * @param int $indice, $cont, $cant
     * @param array $unJuego
     * @return int     */
    $indice=-1;
    $cont=0;
    $cant=count($juegos);
    while ($cont<$cant && $indice==-1) {
        $unJuego=$juegos[$cont];
        if ($unJuego["jugador1"]==$nombreJugador && $unJuego["aciertos1"]>$unJuego["aciertos2"]) {
            $indice=$cont;    
        }elseif ($unJuego["jugador2"]==$nombreJugador && $unJuego["aciertos2"]>$unJuego["aciertos1"]) {
            $indice=$cont;    
        }
        $cont++;
    }
    return $indice;
}

// 7)
/**
 * Función que dada la colleción de juegos y el nombre de un jugador
 * retorna el resumen del jugador.
 * @param array $juegos
 * @param string $nombreJugador
 * @return array
 */
function resumenJugador (array $juegos, string $nombreJugador){

    $ganados = 0;
    $perdidos = 0;
    $empatados = 0;
    $acumulado = 0;
    //$aciertos = 0;
    
    // recorrer todas las partidas
    for ($i = 0; $i < count($juegos); $i++) {

        $p = $juegos[$i];

        // Determinar ganador segun aciertos
        if ($p["aciertos1"] > $p["aciertos2"]) {
            $gano = 1;  //ganó como jugador 1
        } elseif ($p["aciertos2"] > $p["aciertos1"]) {
            $gano = 2;  //ganó como jugador 2
        } else {
            $gano = 0; // empate
        }

        // ¿El jugador participó en esta partida?
        // Si el jugador participó como jugador 1 entonces:
        if ($p["jugador1"] == $nombreJugador) {

            // acumula aciertos
            $acumulado = $acumulado + $p["aciertos1"];

            // resultado
            if ($gano == 1) {
                $ganados++;
            } elseif ($gano == 2) {
                $perdidos++;
            } else {
                $empatados++;
            }
        }
        // Si el jugador participó como jugador 2 entonces:
        elseif ($p["jugador2"] == $nombreJugador) {

            // acumula aciertos
            $acumulado = $acumulado + $p["aciertos2"];

            // resultado
            if ($gano == 2) {
                $ganados++;
            } elseif ($gano == 1) {
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

// FUNCION AUXILIAR GANADOR DE UN JUEGO 
function ganador(array $unJuego){
    /** Recibe unJuego, determina si el ganador es el jugador1 (1) el jugador2(2) o empataron (0)
     * @param int $ganador
     * @return int */
    if ($unJuego["aciertos1"] > $unJuego["aciertos2"]) {
            $ganador = 1;
    } elseif ($unJuego["aciertos2"] > $unJuego["aciertos1"]) {
            $ganador = 2;
    } else {
            $ganador = 0; // empate
    }
    return $ganador;
}
//8
function cantidadGanados(array $juegos){
    /**Dado una colección de juegos cuenta y retorna la cantidad de juegos que fueron ganados por algún jugador 
     * @param int $cont
     * @return int */
    $cont=0;
    foreach ($juegos as $indice => $unJuego) {
        if (ganador($unJuego)<>0) {
            $cont++;
        }
    }
    return $cont;
}

//9
function cantidadGanadosNroJugador (array $juegos, int $nroJugador){
    /**Dada una colección de juegos cuenta los ganados por el jugador nroJugador
     * @param int $ganados
     * @return int     */
    $ganados=0;
    foreach ($juegos as $indice=>$unJuego){
        if (ganador($unJuego)==$nroJugador) {
            $ganados++;
        }
    }
    return $ganados;
}

//10
function ordenarPorJugador2 (array $juegos){
    /**Dada una colección de juegos, muestra la colección de juegos ordenada por Jugador2  */
    uasort($juegos,'cmp');
    print_r($juegos);
} 
function cmp(array $juego1, array $juego2){
    /**Funcion de comparación entre dos juegos  
     * @param int orden
     * @ruturn int    */

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
/*
 * @param int $cantjuegos, $opcion, $nroJuego, $ganados, $nroJugador
 * @param array $juegos, $unJuego 
 * @param string $resultadoUnJuego, $unNombre
 * @param float $porcentaje
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
            /** 3) MOSTRAR EL PRIMER JUEGO GANADOR
             * Se solicita al usuario un nombre de jugador y se muestra por pantalla el primer juego ganado por dicho jugador */
            echo "Ingrese el nombre del jugador: \n";
            $unNombre=trim(fgets(STDIN)); // ver de asegurar letra capital 
            imprimirDatosJuego($juegos, primerJuegoGanado($juegos,$unNombre));           
            break;
        case 4:
            /** 4) MOSTRAR PORCENTAJE DE JUEGOS GANADOS 
             * Se solicita al usuario un nro de jugador y se imprime una leyenda con el porcentaje de juegos ganados por ese jugador */
            echo "Ingrese un número de jugador (1 o 2): \n";
            $nroJugador=solicitarNumeroEntre(1, 2);
            $ganados=cantidadGanadosNroJugador($juegos,$nroJugador);
            $porcentaje=($ganados*100)/(cantidadGanados($juegos));
            echo "El jugador ".$nroJugador." ganó el ".$porcentaje."% de los juegos ganados. \n";
            break;
        
        case 0: 
            echo "Saliendo...\n";
            break;
        default:
            echo "Opción invalida... \n";
            break;
    }
} while ($opcion != 0);
