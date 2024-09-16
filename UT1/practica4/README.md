### Practica 4
Tomar captura de pantalla de: ( y explicar lo ocurrido )
- probar el código anterior ¿ da error ? Por qué ?
- quitar el comentario a: return $a; ¿ da error ahora ?por qué ?
- quitar comentario a: print fun(“e”,3); ¿ da error ?

![alt text](image.png)

Al descomentar return $a;, la función intentará devolver una cadena ("o"), lo que causará un error debido a que el tipo de retorno debe ser int.

Mensaje de Error:
Fatal error: Return value of fun() must be of the type int, string returned
![alt text](image-1.png)

La función fun está declarada para devolver un valor de tipo int. Al devolver $a, que es una cadena, PHP produce un error de tipo estricto porque la cadena no cumple con el tipo int esperado.

#### Conclusión
Probar el código original (print fun(1, 2);): La ejecución es correcta y muestra 2, ya que el valor de retorno es del tipo esperado (int).
Descomentar return $a;: Genera un error porque return $a; intenta devolver una cadena ("o") en lugar de un entero (int).