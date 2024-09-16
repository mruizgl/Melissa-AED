## Práctica 2 
```
<?php
$un_bool = TRUE; // un valor booleano
$un_str = "foo"; // una cadena de caracteres
$un_str2 = 'foo'; // una cadena de caracteres
$un_int = 12; // un número entero
echo gettype($un_bool); // imprime: boolean
echo gettype($un_str); // imprime: string
// Si este valor es un entero, incrementarlo en cuatro
if (is_int($un_int)) {
 $un_int += 4;
}
// Si $un_bool es una cadena, imprimirla
// (no imprime nada)
if (is_string($un_bool)) {
 echo "Cadena: $un_bool";
}
?>
```
Crear el script anterior. Modificarlo para sumar a $un_str el valor de $un_int y
mostrarlo en pantalla ¿ qué ocurre ? .
Sumar $un_str con $un_str2 ¿ qué ocurre ? ¿ se puede concatenar una cadena con comillas
simples con una con comillas dobles ?


### Explicación de los Resultados

1. **Concatenar `$un_str` con `$un_int`:**
   - Cuando concatenas una cadena con un entero en PHP, el entero se convierte en una cadena y luego se concatenan.
   - **Resultado:** `"foo12"`

2. **Concatenar `$un_str` con `$un_str2`:**
   - Aquí simplemente concatenas dos cadenas.
   - **Resultado:** `"foofoo"`

**Nota sobre comillas simples y dobles:**

- Las comillas simples (`'`) en PHP no interpretan variables dentro de la cadena. Por ejemplo, `'foo'` siempre será `"foo"` y no interpretará ninguna variable dentro.
- Las comillas dobles (`"`) permiten la interpretación de variables y secuencias de escape, así que `"foo"` es interpretado como `"foo"` y las variables dentro de la cadena serán reemplazadas por su valor.

Por lo tanto, la concatenación entre cadenas con comillas simples y dobles funcionará igual en el contexto de la concatenación, porque estás concatenando cadenas con cadenas, no variables.
