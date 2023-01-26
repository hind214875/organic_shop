<?php
//Las claves de este array (0, 1, 2, 3) son los identificadores de cada producto
//Aunque lo correcto sería realizar una conexión a la base de datos y extraer de allí los datos para rellenar este array, por simplificar el trabajo, puedes utilizar directamente el siguiente array ya rellenado
$productos = array(
  0 => array(
    'nombre' => 'Avocados',
    'precio' => '28.00',
    'img_url' => './images/product-5-270x280.png',
    'img_miniatura' => './images/product-mini-5-108x100.png'
  ),
  1 => array(
    'nombre' => 'Corn',
    'precio' => '27.00',
    'img_url' => './images/product-6-270x280.png',
    'img_miniatura' => './images/product-mini-6-108x100.png'
  ),
  2 => array(
    'nombre' => 'Artichokes',
    'precio' => '23.00',
    'img_url' => './images/product-7-270x280.png',
    'img_miniatura' => './images/product-mini-7-108x100.png'
  ),
  3 => array(
    'nombre' => 'Broccoli',
    'precio' => '25.00',
    'img_url' => './images/product-8-270x280.png',
    'img_miniatura' => './images/product-mini-8-108x100.png'
  ),
);
