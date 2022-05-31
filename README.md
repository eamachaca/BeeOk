<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Obligatorios

### usuario administrar una lista de tareas.

Básicamente lo que entiendo es que un usuario va a poder sólo mirar sus propias listas de tareas y las de ningún otro
usuario más

- Instalaré la versión sencilla para mi de login que viene en LaravelUI y genero el scaffold.

### Debe ser posible etiquetar cada tarea de la lista (ej: "Supermercado", "Trabajo", etc).

- Agregué una relación de muchos a muchos Tag y TaskTag para relacionar las tareas y los tags

### Debe ser posible filtrar las tareas por una o más etiquetas.

- Agregué una ruta para conforme una etiqueta seleccionada filtre las tareas de esa etiqueta.
- Agregué una ruta para que filtre las tareas de muchas etiquetas seleccionadas utilizando select2.

### Debe ser posible marcar una tarea como finalizada.

- Se agregó la columna estado, podría ser un booleano, pero prefiero ponerle un entero por que en tareas pueden existir
  diferentes estados en un planteamiento futuro (aunque lo esté utilizando como booleano D:)
- He utilizado el HTTP method update para cambiar el estado de la tarea.

# Adicionales

### Agregar la opción de etiquetar múltiples tareas a la vez.

- He agregado una función para crear o actualizar un tag para que pueda utilizarlo cómo para seleccionar varias tareas y
  utilizando el sync he podido realizar que un tag se enlace con muchas tareas

### Debe ser posible modificar el orden en que se muestran las tareas.
