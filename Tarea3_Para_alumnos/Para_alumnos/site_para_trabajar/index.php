<?php
session_start();

require_once('./productos.php');
require_once('./funciones.php');



$the_basket = getBasketMarkup();

$the_products = getProductosMarkup();

$the_user = getUserMarkup();



// Initialize the shopping cart if it is not initialized
if (!isset($_SESSION['cartProducts'])) {
  $_SESSION['cartProducts'] = [];
}

// Calculate the total price
$total = 0;
foreach ($_SESSION["cartProducts"] as $key => $product) {
  $product_data = getProductData($key);
  $total += $product_data["precio"] * $product['cantidad'];
}

// Check if add to cart button is pressed
if (isset($_POST['add_to_cart'])) {
  // Get product id from submit button
  $product_id = $_POST['add_to_cart'];
  // Get product data
  $product_data = getProductData($product_id);
  // Check if product is already in the cart
  if (in_array($product_id, array_keys($_SESSION['cartProducts']))) {
    // Increase the quantity if product is already in the cart
    $_SESSION['cartProducts'][$product_id]['cantidad']++;
    // Update total price
    $total += $product_data["precio"];
  } else {
    // Add product to the cart if it is not already in the cart
    $_SESSION['cartProducts'][$product_id] = [
      'cantidad' => 1,
      'nombre' => $product_data['nombre'],
      'precio' => $product_data['precio'],
      'img_url' => $product_data['img_url'],

    ];
    // Update total price
    $total += $product_data["precio"];
  }
}


// Check if update cart button is pressed
if (isset($_POST['update_cart_button'])) {
  // Reset total price
  $total = 0;
  // Loop through all the products in the cart
  foreach ($_POST['cantidad'] as $key => $value) {
    if ($value == 0) {
      //empty cart
      unset($_SESSION["cartProducts"][$key]);
      header("location: home.tpl.php");
    } else {
      // Update quantity in the array
      $_SESSION["cartProducts"][$key]['cantidad'] = $value;
      // Update total price
      $total += $_SESSION["cartProducts"][$key]['precio'] * $_SESSION["cartProducts"][$key]['cantidad'];
    }
  }
}

// Update total price
$the_basket = str_replace('<h6 class="cart-inline-title">Total price:<span> 0 </span></h6>', '<h6 class="cart-inline-title">Total price:<span> ' . $total . ' </span></h6>', $the_basket);





//Aquí puedes gestionar los post. Hay tres funcionalidades en la página (tres formularios): add_to_cart, update_cart_button (actualizar unidades) y activate_blue_theme (asociada al usuario). La manera de sacar los productos de la cesta es poner a 0 el número de unidades que hay en la cesta y pulsar "UPDATE"




include('./home.tpl.php');
