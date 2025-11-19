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

function cargarJuegos (){
    /**Carga 10 o más juegos predefinidos en una colección de juegos
     * @param array $coleccionJuegos, $unJuego, $nombres
     * @param int $aciertos1, $aciertos2
     * @return $array 
     */

    /* H: Explicación: uso un array de nombres para crear nombres aleatorios, supongo
    que juegan 5 veces cada juego. Uso un for para cargar la colección de juegos. */
    $coleccionJuegos=array();  
    $nombres=array("Sofía", "Alejandro", "María", "Sebastián", "Valentina", "Diego");

    for ($i=0; $i < 11; $i++) { 
        $aciertos1=random_int(0,5);
        $aciertos2=5-$aciertos1;
        $unJuego=array("jugador1"=>$nombres[random_int(0,5)], "aciertos1"=>$aciertos1,"jugador2"=>$nombres[random_int(0,5)], "aciertos2"=>$aciertos2);
        $coleccionJuegos[i]=$unJuego;
    }
    return $coleccionJuegos;
}


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
/* @param string $nombre1, $nombre2 
 * @param int $nroJuego
 */


//Inicialización de variables:
$nombre1="";
$nombre2="";


//Proceso:

// Estas 3 líneas de código ejecutan el juego y muestran el arreglo retornado con los resultado
// Probar la primera vez y luego comentar/borrar
$juego = jugarMemoria();
echo "jugador 1 " . $juego["jugador1"] . ": " . $juego["aciertos1"] . " aciertos" . "\n";
echo "jugador 2 " . $juego["jugador2"] . ": " . $juego["aciertos2"] . " aciertos" . "\n";





do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: /* 1) JUGAR A MEMORIA */ 
            /* Al iniciar se solicitan los nombres de los jugadores
            * Al finalizar guarda los resultados en una estructura de datos
            */
            echo "Ingrese los nombres de ambos juadores: \nJugador 1: \n";
            $nombre1=trim(fgets(STDIN));
            echo "Jugador 2: \n";
            $nombre2=trim(fgets(STDIN));

            //CONTINUAR...

            break;

        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;

        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
        //...
    }
} while ($opcion != 7);
