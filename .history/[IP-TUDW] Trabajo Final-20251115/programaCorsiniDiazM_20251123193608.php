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
 * Apellido y nombre: Corsini, Agustín.
 * Legajo: FAI-5302.
 * Carrera: TUDW.
 * Mail: agustin.corsini@est.fi.uncoma.edu.ar
 * Usuario GitHub: AgustinCorsini
 * */


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/
/**
 * Funcion que muestra el primer juego ganado del jugador 
 * @param array $partida;
 */
function mostrarPrimerJuegoGanado($partidas) {

    echo "Ingrese el nombre del jugador a buscar: ";
    $nombre = ucfirst(strtolower(trim(fgets(STDIN))));
    $encontro = false;

    foreach ($partidas as $indice => $partida) {

        // Caso 1: Ganó el jugador 1
        if ($partida["ganador"] == 1 && $partida["jugador1"] == $nombre) {
            $encontro = true;

            echo "\n***************************************\n";
            echo "Juego MEMORIA: " . ($indice + 1) . " (ganó jugador 1)\n";
            echo "Jugador 1: " . strtoupper($partida["jugador1"]) . " obtuvo " . $partida["aciertos_j1"] . " aciertos\n";
            echo "Jugador 2: " . strtoupper($partida["jugador2"]) . " obtuvo " . $partida["aciertos_j2"] . " aciertos\n";
            echo "***************************************\n\n";
            break;
        }

        // Caso 2: Ganó el jugador 2
        if ($partida["ganador"] == 2 && $partida["jugador2"] == $nombre) {
            $encontro = true;

            echo "\n***************************************\n";
            echo "Juego MEMORIA: " . ($indice + 1) . " (ganó jugador 2)\n";
            echo "Jugador 1: " . strtoupper($partida["jugador1"]) . " obtuvo " . $partida["aciertos_j1"] . " aciertos\n";
            echo "Jugador 2: " . strtoupper($partida["jugador2"]) . " obtuvo " . $partida["aciertos_j2"] . " aciertos\n";
            echo "***************************************\n\n";
            break;
        }
    }

    if (!$encontro) {
        echo "\nEl jugador $nombre no ganó ningún juego.\n\n";
    }
}

//1) 
function cargarJuegos (){
    /**Carga 10 o más juegos predefinidos en una colección de juegos
     * @param array $coleccionJuegos, $unJuego, $nombres
     * @param int $aciertos1, $aciertos2, $empates, $total
     * @return $array 
     */

    /* H: Explicación: uso un array de nombres para crear nombres aleatorios.
     Uso un for para cargar la colección de juegos. */
    $coleccionJuegos=array();  
    $nombres=array("Sofía", "Alejandro", "María", "Sebastián", "Valentina", "Diego");

    for ($i=0; $i < 10; $i++) { 
        $total=random_int(2,8); // mínimo 2 juegos y máximo 8, lo humanamente razonable
        $empates=random_int(0,3); // establesco hasta 3 empates
        $aciertos1=random_int(0,($total-$empates)); // random entre los totales y los ya empatados  
        $aciertos2=$total-$aciertos1-$empates; // los restantes son aciertos 2
        $unJuego=array("jugador1"=>$nombres[random_int(0,5)], "aciertos1"=>$aciertos1,"jugador2"=>$nombres[random_int(0,5)], "aciertos2"=>$aciertos2);
        $coleccionJuegos[$i]=$unJuego;
    }
    return $coleccionJuegos;
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
function imprimirDatosJuego(array $Juegos, int $indice){
    /**Dada la colección de juegos y un indice, imprime los datos del juego
     * @param array $unJuego
     * @param string $resultadoUnJuego
     */
                            
    $unJuego=$Juegos[$indice];
    $resultadoUnJuego=($unJuego["aciertos1"]>$unJuego["aciertos2"]?"ganó jugador 1":($unJuego["aciertos1"]<$unJuego["aciertos2"]?("ganó jugador 2"):("empate")));
    echo "\n**************************************\n".
        "Juego MEMORIA: ".$indice." ".$resultadoUnJuego." \n".
        "Jugador 1: ".$unJuego["jugador1"]." obtuvo ".$unJuego["aciertos1"]." aciertos \n".//ver de poner el nombre en uppercase
        "Jugador 2: ".$unJuego["jugador2"]." obtuvo ".$unJuego["aciertos2"]." aciertos \n".
        "**************************************\n\n";  
                
}
//5)
function agregarJuego(array $Juegos, array $unJuego){
    /** Lee una colección de juegos y un juego, agrega el juego a la colección
     * @return array    */
    $Juegos[count($Juegos)]=$unJuego;
}
//6)
function primerJuegoGanado(array $Juegos, string $nombreJuegador){
    /**Lee una colección de juegos y un nombre de jugador y retorna el índice del primer juego ganado por dicho jugador
     * @param int $indice, $cont, $cant
     * @param array $unJuego
     * @return int     */
    $indice=-1;
    $cont=0;
    $cant=count($Juegos);
    while ($cont<$cant && $indice==-1) {
        $unJuego=$Juegos[$cont];
        if ($unJuego["jugador1"]==$nombreJuegador && $unJuego["aciertos1"]>$unJuego["aciertos2"]) {
            $indice=$cont;    
        }elseif ($unJuego["jugador2"]==$nombreJuegador && $unJuego["aciertos2"]>$unJuego["aciertos1"]) {
            $indice=$cont;    
        }
        $cont++;
    }
    return $indice;
}

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
/*
 * @param int $cantJuegos, $opcion, $nroJuego
 * @param array $Juegos, $unJuego 
 * @param string $resultadoUnJuego
 */


//Inicialización de variables:
$opcion=0;
$nroJuego=-1;
$resultadoUnJuego="";
//Precargado (Punto 11.a)
$Juegos=cargarJuegos();
$cantJuegos=count($Juegos); //total de juegos en $Juegos

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
            /**
             * Al iniciar se solicitan los nombres de los jugadores (lo hace la funcion en memoria.php)
             * Al finalizar guarda los resultados en una estructura de datos ($Juegos)
             **/
            $unJuego=jugarMemoria();
            $Juegos[$cantJuegos]=$unJuego; //Si ya hay 10 juegos, el índice 10 es correcto para guardar el siguiente juego
            $cantJuegos++;
            //$iniciarJuego = solicitarNombres($juego);
            //$iniciarJuego;
            break;


        case 2:     
            /* 2) MOSTRAR UN JUEGO */
            /* Se solicita al usuario un número de juego y se lo muestra en pantalla */
            echo "Ingrese un número entre 0 y ".($cantJuegos-1)." \n";
            $nroJuego=solicitarNumeroEntre(0,$cantJuegos-1);
            imprimirDatosJuego($Juegos, $nroJuego);                
            break;

        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3
            mostrarPrimerJuegoGanado($partidas);
            break;
        
        case 0: 
            echo "Saliendo...\n";
            break;
        default:
            echo "Opción invalida... \n";
            break;
    }
} while ($opcion != 0);
