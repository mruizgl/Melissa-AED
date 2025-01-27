### Práctica 3
```
<html>
 <head>
 <meta charset="UTF-8">
 <title></title>
 </head>
 <body>
 <?php
 function sum( int $a, int $b): int {
 return $a + $b;
 }
 echo "<p> la suma de uno más dos es: ";
 $resultado = sum(1,2);
 print sum(1,2);
 echo "</p>"
 ?>
 </body>
</html>
```

Realizar el código anterior y tomar captura de pantalla del resultado. ¿qué es lo
que ha ocurrido ?. Poner código html antes de la declaración de strict_types y probar de
nuevo ¿ qué ocurre ahora ?


   ![alt text](image-1.png)

   Si el declare está al principio me da error 
   ![alt text](image-2.png)
   ![alt text](image-3.png)

Nota para mí: las declaraciones de tipo deben siempre estar al principio.
