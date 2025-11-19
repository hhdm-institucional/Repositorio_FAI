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
     * @param int $aciertos1, $aciertos2, $empates, $total
     * @return $array 
     */

    /* H: Explicación: uso un array de nombres para crear nombres aleatorios.
     Uso un for para cargar la colección de juegos. */
    $coleccionJuegos=array();  
    $nombres=array("Sofía", "Alejandro", "María", "Sebastián", "Valentina", "Diego");

    for ($i=0; $i < 11; $i++) { 
        $total=random_int(2,8); // mínimo 2 juegos y máximo 8, lo humanamente razonable
        $empates=random_int(0,3); // establesco hasta 3 empates
        $aciertos1=random_int(0,$total-$empates); // random entre los totales y los ya empatados  
        $aciertos2=$total-$aciertos1-$empates; // los restantes son aciertos 2
        $unJuego=array("jugador1"=>$nombres[random_int(0,5)], "aciertos1"=>$aciertos1,"jugador2"=>$nombres[random_int(0,5)], "aciertos2"=>$aciertos2);
        $coleccionJuegos[$i]=$unJuego;
    }
    return $coleccionJuegos;
}


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
/*
 * @param int $cantJuegos, $opcion
 * @param array $Juegos, $unJuego 
 */


//Inicialización de variables:
$opcion=0;
//Precargado (Punto 11.a)
$Juegos=cargarJuegos();
$cantJuegos=count($Juegos); //total de juegos en $Juegos

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
            /* Al iniciar se solicitan los nombres de los jugadores (lo hace la funcion en memoria.php)
            * Al finalizar guarda los resultados en una estructura de datos ($Juegos)
            */
            $unJuego=jugarMemoria();
            $Juegos[$cantJuegos]=$unJuego; //Si ya hay 10 juegos, el índice 10 es correcto para guardar el siguiente juego
            $cantJuegos++;
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
