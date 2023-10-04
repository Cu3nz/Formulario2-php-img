<?php
//* Para verificar que se ha enviado el formulario tenemos que hacer lo siguiente. 

//! ----------------------------------------- Validaciones de si se ha enviado el formulario, correo correcto y contraseña correcta

if (isset($_POST['btnEnv'])) {
    //* Si estamos dentro de aqui, es porque hemos hecho click en el boton de enviar el formulario
    //echo "Has pulsado el boton de enviar el formulario";
    $username = htmlspecialchars(trim($_POST['username'])); //? Almacenamos el usuario introducido en el formulario en la variable username
    //echo "El username que has introducido por teclado es: ", $username;
    $password = htmlspecialchars(trim($_POST['pass'])); //? Almacenamos la contraseña en esta variable


   

    // todo Validamos el correo, para que meta un correo correcto mediante los filtros.
    //! si el correo que se introduce por teclado, no pasa los filtros muestra un mensaje de error.
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        echo "El correo que has introducido no es correcto";
    } else { //? si no es que lo ha pasado y es correcto.
        echo "El correo que has introducido  es correcto";
    }

     // todo Validamos la contraseña
     if (strlen($password) == 0) { //? Comprueba la longitud de la variable password, si es 0 mandamos un error por pantalla.
        echo "<p class='error'>Has introducido una contrasñea que tiene 0 caracteres</p>";
    }

    var_dump($_FILES); //* Muestra informacion sobre los archivos que se suben al servidor a traves de un formulario HTML en el input de tipo file. Al utilizar var_dump($_FILES) obtenemos informacion detallada sobre la carga de archivos incluyendo*/ 
    /**
     * ? nombre del campo por el cual se ha subido el archivo. 
     * ? nombre original del archivo 
     * ? Tipo, basicamente la extension del fichero. 
     * ? Tamaño de la imagen
     * ? tmp_name (la mas importante) Carpeta temporal en el servidor donde se almacena el archivo 
     * ? Codigo de error (Importante tambien) Codigo que indica si hubo algun error durante la carga del archivo, el valor 0 define que el fichero se ha subido correctamente, pagina para ver los errores: https://www.php.net/manual/es/features.file-upload.errors.php
     
     */





    //! ----------------------------------------- Fin Validaciones de si se ha enviado el formulario, correo correcto y contraseña correcta



    // todo creacion del array tipos_nime, donde vamos a almacenar algunas de las extensiones de imagen que hay en la actualidad para controlar que solo se puedan subir esas imagenes. 

    $tipos_nime = [
        'image/jpeg',
        'image/webp',
        'image/ico',
        'image/bmp',
        'image/svg+xml',
        'image/png',
        'image/gif'

    ];

    

    //todo validar si la imagen que se ha subido esta dentro del array o no 

    //* Si en el array foto (el nombre del array que almacena la variable $_FILES se puede comprobar haciendo var_dump($_FILES)) el valor de extension que almacena la clave type NO esta definida en el array de $tipos_nime muestra el siguiente error. 

    //* Si dentro del array foto (que es el nombre del array que almacena la variable $_FILES se puede comprobar haciendo var_dump($_FILES)) la clave type almacena o devuelve una extension que NO esta almacenada o definida en el array $tipos_nime muestro el siguiente error.
    //? la clave type del array foto devuelve por ejemplo lo siguiente: ["type"]=> string(10) "image/jpeg", esta justo esta definida en el array (la primera).

    if (!in_array($_FILES['foto']['type'] , $tipos_nime)){
        echo "<p class='error'>Has subido una imagen con una extension que no esta en el array o has subido otro fichero que no sea una imagen</p>";
    } else { //* Si no, has subido la imagen abre la llave del else cuando la extension de la imagen esta definida dentro del array y el archivo se sube.
        echo "<br>Has subido la imagen con nombre",var_dump($_FILES['foto']['name']); //! foto es el nombre del array ($_FILES).

        //todo Validamos el tamaño de la imagen

        //* Si en el array de foto, la clave size almacena mas de 200000 enviamos un mensaje de error
        if ($_FILES['foto']['size'] > 2000000){
            echo "<br>La imagen que has subido excede el tamaño de 200000MB , tu foto tiene " , $_FILES['foto']['size'];
        } else{ //? si no es porque el tamaño de la imagen esta bien.
            echo "<br>El tamaño de la imagen no excede el tamaño";

            //todo Evitar el error de sobreescribir una imagen cuando tiene el mismo nombre y extension.

            //? Coge el nombre de la carpeta, con un generador de numeros aleatorios unicos (uniquid()), pone una _ y el nombre del fichero que se sube. Un ejemplo de lo que devuelve puede ser este: ./imagenes_formulario/651da28c802f2_perfil2.jpeg
            //* Generador de numero aleatorio y unico uniquid().
            $nombre = "./imagenes_formulario/" . uniqid() . "_" . $_FILES['foto']['name'];
            echo "<br>La imagen con el nombre unico es: $nombre"; // Ejemplo que devuelve: ./imagenes_formulario/651da28c802f2_perfil2.jpeg

            // todo Mover la imagen de la carpeta temporal (tmp_name) a otra carpeta en este caso imagenes_formulario.
            //! move_uploaded_file se utiliza para mover un archivo cargado desde su ubicación temporal (donde se almacena temporalmente después de ser cargado por el usuario) a una ubicación definitiva en el servidor. Sintaxis: 
            //* move_uploaded_file(ubicacion_temporal, ubicacion_definitiva);
            //? En este caso mueve el archivo de la carpeta temporal (tmp_name) que esta en el array de foto a la ruta que hay en $nombre en mi caso --> ./imagenes_formulario/ con un nombre ya creado

            if (!move_uploaded_file($_FILES['foto']['tmp_name'] , $nombre)){
                echo "<br><br>Error no se puede movel el archivo a la ubicacion deseada, $nombre";
            } else {
                echo "<br><br>El archivo se ha movido a la ubicacion <b>$nombre</b>, de forma correcta ";
            }

        }

    } //* llave que cierra el else, de cuando la extension de la imagen esta definida dentro del array y el archivo se sube.    

} else { //! Si no, cargamos de nuevo el formulario, cierra la llave al final del documento (buscar por cierre)


?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Tailwindcss -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- CDN Fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Procesar el formulario en la misma pagina</title>
    </head>

    <body bgcolor="#000" text="#fff">

    <style>
        .error{
            font-size: 20px;
            color: red;
            font-weight: 700;
        }
    </style>

        <h3 class="py-4 text-2xl text-center">Procesar el formulario en la misma pagina</h3>

        <div class="p-4 rounded-x1 border-2 border-teal-600 w-1/2 mx-auto"> <!--Formulario-->

            <!-- //!Dentro del action devuevle el nombre de la pagina actual por lo tanto se va a procesar el formulario en esta misma pagina 
        //? y para subir ficheros es super importante poner el enctype="multipart/form-data para poder subir ficheros, sin esto no funciona-->

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                <div class="w-full max-w-xs">
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Username
                            </label>
                            <input name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                        </div>
                        <!--password-->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="pass">
                                password
                            </label>
                            <input name="pass" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pass" type="password" placeholder="contraseña">
                        </div>

                        <div class="mb-4" flex>
                            <div class="w-full mr-4 flex-1">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="foto">
                                    Foto de perfil
                                </label>
                                <!--<input type="hidden" name="MAX_FILE_SIZE" value="10">  //! esto no se recomienda poner-->
                                <input oninput="verFoto.src=window.URL.createObjectURL(this.files[0])" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="foto" type="file" name="foto" accept="image/*"> <!--//! accept="image/* valor para que nos acepte subir solamente una imagen, con cualquier extension, luego controlamos eso con el array tipos_nime -->
                            </div>
                            <div>
                                <img src="imagenes_formulario/noimagen.png" id="verFoto" class="w-60" /> <!--Cuando no tenemos selecionado ninguna foto, nos muestra la siguiente-->
                            </div>
                        </div>

                        <div class="flex flex-row-reverse">
                            <button type="submit" name="btnEnv" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Enviar
                            </button>

                            <button type="reset" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                reset
                            </button>
                        </div>
                    </form>
                </div>

    </body>

    </html>
<?php
} //todo cerramos la llave del else que esta en la parte de arriba cierre de llave
?>