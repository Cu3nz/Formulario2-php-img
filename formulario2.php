<?php
//* Si pulsamos el boton de enviar existe un post entonces se mete dentro del if
if (isset($_POST['btnEnv'])) {
    //? hemos pulsado el boton de enviar quiero procesar el formulario
    //echo "Vamos a procesar el formulario";
    //todo htmlspecialchars sirve para convertir los caracteres de codigo de javascript en caracteres html hacerlo si o si por seguridad
    $username = htmlspecialchars(trim($_POST['username']));
    echo "El nombre del usuario es: <b>$username</b>";

    //echo "<br>";
    //var_dump($_FILES); //? Devuelve un array con los datos del fichero. Tamaño, nombre, tipo, carpeta_temporal

    //todo Array para validar que archivos podemos subir (extensiones de imagenes)
    $tipo_nime=[
        'image/jpeg',
        'image/webp',
        'image/png',
        'image/ico',
        'image/bmp',
        'image/gif',
    ];

    //? Validacion para saber si se ha subido una foto o no. 
    
    //* si no, es que has subido una imagen con una extension que esta en el array de tipo_nime y te muestra la siguiente imagen

    if(is_uploaded_file($_FILES['foto']['tmp_name'])){ //* si se ha subido una imagen a la carpeta temporal 
        //! no entiendo paco

    if (!in_array($_FILES['foto']['type'],$tipo_nime)){ //! Comprobamos que el archivo que se esta subiendo es una imagen, si el tipo de la foto que es la extension de la foto, no esta en el array de tipos_nime muestra el siguiente error.
        echo "Error, tipo no permitido debes subir una imagen";
    }else { //* si pasa al else es que has subido una imagen
        echo "Has subido una imagen";
        //? Comprobar el tamaño de la imagen, no debera excender los 2M
        //? Si el tamaño de la foto es mayor a 2mb muestre un mensaje de error
        if ($_FILES['foto'] ['size'] > 200000){
            echo "Te has excedido del tamaño permitido";
        } else { // todo si no  El tamaño es correcto y sube el archivo
            echo "El tamaño es adecuado y vamos a subir el archivo";
            //todo hacemos que la imagen tenga un identificar unico, para que a la hora de subirlo no tenga el mismo nombre y se solapen.
            //? uniqid() hace un numero aleatorio que es unico. 
            $nombre = "./imagenes_formulario".uniqid()."_".$_FILES['foto']['name']; //? devuelve ./imagenes_formulario651a9f1315b90_perfil2.jpeg
            echo "<br>$nombre";
            //? mover el fichero a una carpeta, en este caso imagenes_formulario (esta dentro de nombre);

            if (!move_uploaded_file($_FILES['foto'] ['tmp_name'] , $nombre)){ //! si no se ha podido mover a la carpeta, mostramos un error.
                echo "Error, no puedo mover el archivo a la ubicacion deseada";
            } else {
                echo "Arcchivo guardado con exito";
            }


        }
    }
}




    

} else {
    //! cierro la llave del else al final del documento
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

        <h3 class="py-4 text-2xl text-center">Procesar el formulario en la misma pagina</h3>

        <div class="p-4 rounded-x1 border-2 border-teal-600 w-1/2 mx-auto"> <!--Formulario-->

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data"> <!-- //!Dentro del action devuevle el nombre de la pagina actual por lo tanto se va a procesar el formulario en esta misma pagina y para subir ficheros es super importante poner el enctype-->

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
                        <input oninput="verFoto.src=window.URL.createObjectURL(this.files[0])"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="foto" type="file" name="foto" accept="image/*"><!--Para que no acepte una imagen-->
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
} //todo cerramos la llave del else que esta en la parte de arriba
?>