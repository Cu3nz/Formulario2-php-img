# Formulario2-php-img
formulario que carga una imagen con sus validaciones

<h1>Formulario que carga una imagen y la guarda en una carpeta</h1>

<p>Formulario cuando no hay ninguna foto</p>

![Captura de pantalla 2023-10-04 a las 21 00 06](https://github.com/Cu3nz/Formulario2-php-img/assets/145379555/7e4442fd-9e82-44be-b061-c82c11985561)


<p>Formulario cuando hay una foto</p>

![Captura de pantalla 2023-10-04 a las 21 01 57](https://github.com/Cu3nz/Formulario2-php-img/assets/145379555/b72b635c-2d07-4abe-9587-3c43f19f4f0d)

<P>Este formulario cuenta con las siguientes validaciones</P>

<ul>
  <li>Validacion de email (username linea 16)</li>
  <li>Validacion de contraseña cuando no se introduce ningun caracter en el input (linea 24)</li>
  <li>Vision de lo que devuelve el array $_FILES (En este caso el nombre de array se llama foto porque es el nombre que se le pone al input de tipo file) linea 29 en la que se muestra:</li>
  <ol>
    <li>nombre del campo por el cual se ha subido el archivo. </li>
    <li>nombre original del archivo </li>
    <li>Tipo, basicamente la extension del fichero. </li>
    <li>Tamaño de la imagen</li>
    <li>tmp_name (la mas importante) Carpeta temporal en el servidor donde se almacena el archivo </li>
    <li>Codigo de error (Importante tambien) Codigo que indica si hubo algun error durante la carga del archivo, el valor 0 define que el fichero se ha subido correctamente, pagina para ver los errores: https://www.php.net/manual/es/features.file-upload.errors.php</li>
  </ol>
  <li>Creacion de un array para hacer un filtrado de extensiones que se pueden subir a la carpeta (linea 50) </li>
  <li>Validar si la  estension imagen que se esta subiendo esta dentro de las extensiones de array (linea 70)</li>
  <li>Validar el tamaño maximo de una imagen (linea 78)</li>
  <li>Evitar el error de sobreescribir imagenes con el mismo nombre (linea 87) Creacion de un nombre unico para cada foto subida</li>
  <li>Mover la imagen de la carpeta temporal (tmp_name) a una carpeta especifica (linea 95)</li>
</ul>

