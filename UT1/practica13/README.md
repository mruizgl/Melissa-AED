### Practica 13
<div align="justify">

```
<?php
$variable = 'dato';
$dato = 5;
echo $$variable.'<br>';
?>
````

Probar el script anterior y observar que ocurre. Probar ahora con llaves:
${$variable} ¿ hay diferencia ?



En el script anterior, sin llaves, \$$variable se interpreta como $dato, porque $variable tiene el valor 'dato'. Por lo tanto, \\$$variable es equivalente a $dato, que contiene el valor 5. El resultado de echo $$variable será 5.

NOTA Variables Variables: Esta característica de PHP permite usar el valor de una variable como el nombre de otra variable.

__Con llaves:__

```
<?php>
$variable = 'dato';
$dato = 5;
echo ${$variable}.'<br>';
?>
```
En este caso, ${$variable} también se interpreta como $dato. Las llaves {} se utilizan para asegurar que el nombre de la variable se interprete correctamente, especialmente cuando se usan nombres de variables dinámicos o se necesita mayor claridad en la sintaxis. En este caso, no hay una diferencia funcional en comparación con el uso sin llaves, ya que {$variable} se resuelve de la misma manera a $dato.

En resumen, ambos enfoques ($$variable y ${$variable}) producirán el mismo resultado: 5. Las llaves son útiles para mejorar la claridad, especialmente en casos más complejos o cuando se combinan con otros elementos de sintaxis.

</div>