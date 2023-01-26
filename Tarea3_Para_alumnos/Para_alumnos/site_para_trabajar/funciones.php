<?php

function getProductData($product_id) {
  global $productos;
  return $productos[$product_id];
}


/** La siguiente función debe generar el código HTML de la cesta, y su formulario asociado
 * Ten presente los ámbitos de las variables y los modificadores que puedes utilizar para cambiarlo
 */


//Function to get the basket markup
function getBasketMarkup()
{
  //<!-- RD Navbar Basket-->

  if (is_user_logged_in()) {
    $total = 0;
    $basket_markup = ' <div class="rd-navbar-basket-wrap">
 <button class="rd-navbar-basket fl-bigmug-line-shopping198" data-rd-navbar-toggle=".cart-inline"><span>' . count($_SESSION["cartProducts"]) . '</span></button>
 <form action="./index.php" method="post">
 <div class="cart-inline">
 <div class="cart-inline-header">
 <h5 class="cart-inline-title">In cart:<span> ' . count($_SESSION["cartProducts"]) . '</span> Products</h5>
 <h6 class="cart-inline-title">Total price:<span> ' . $total . ' </span></h6>
 </div>
 <div class="cart-inline-body">
 ';
    //loop to get the products from the array
    foreach ($_SESSION["cartProducts"] as $key => $product) {
      $product_data = getProductData($key);
      $total += $product_data["precio"] * $product['cantidad'];
      $basket_markup .= '
  <div class="cart-inline-item">
    <div class="unit align-items-center">
      <div class="unit-left"><img src="' . $product_data["img_url"] . '" alt="" width="108" height="100"/></div>
      <div class="unit-body">
        <h6 class="cart-inline-name">' . $product_data["nombre"] . '</h6>
        <div>
          <div class="group-xs group-inline-middle">
            <div class="table-cart-stepper">
              <input class="form-input" type="number" data-zeros="true" value="'. $product['cantidad'] .'" min="0" max="1000" name="cantidad['.$key.']">
            </div>
            <h6 class="cart-inline-title">$' . $product_data["precio"] * $product['cantidad'] . '</h6>
          </div>
        </div>
      </div>
    </div>
  </div>';
    }
    $basket_markup .= '
  </div>
  <div class="cart-inline-footer">
    <div class="group-sm"><a class="button button-md button-default-outline-2 button-wapasha" href="./cart.php">Go to cart</a>
    <input style="background-color: #3c6a36;" type="submit" class="button button-md button-primary button-pipaluk" value="update" name="update_cart_button"></div>
  </div>
</div>
</form>
</div>
<a class="rd-navbar-basket rd-navbar-basket-mobile fl-bigmug-line-shopping198" href="#"><span>' . count($_SESSION["cartProducts"]) . '</span></a>
';
    return $basket_markup;
  }
}



/** La siguiente función debe generar el código HTML de los productos, con sus botones de 'add to cart' cesta
 * Ten presente los ámbitos de las variables y los modificadores que puedes utilizar para cambiarlo
 */
function getProductosMarkup()
{


  include "productos.php";
  if (is_user_logged_in()) {
    //Ejemplo del HTML generado: ( no tiene por qué coincidir exactamente con el presente en la plantilla HTML  y dependerá de si el usuario está conectado o no)
    $productos_markup = '
  <div class="col-md-5 col-lg-6">
      <form class="row row-30 justify-content-center" method="post" action="./index.php">';
    //loop to get the products from the array
    foreach ($productos as $key => $product) {
      $productos_markup .= '
        <div class="col-sm-6 col-md-12 col-lg-6">
          <div class="oh-desktop">
            <!-- Product-->
            <article class="product product-2 box-ordered-item wow slideInRight" data-wow-delay="0s">
              <div class="unit flex-row flex-lg-column">
                <div class="unit-left">
                  <div class="product-figure"><img src="' . $product["img_url"] . '"  alt="" width="270" height="280"/>
                    <div class="product-button"><!--<a class="button button-md button-white button-ujarak" href="#">Add to cart</a>-->
                    <button type="submit" name="add_to_cart"  value="' . $key . '">Add to cart</button>
                    </div>
                  </div>
                </div>
                <div class="unit-body">
                  <h6 class="product-title"><a href="#">' . $product["nombre"] . '</a></h6>
                  <div class="product-price-wrap">
                    <div class="product-price">$' . $product["precio"] . '</div>
                  </div>
                  <!--<a class="button button-sm button-secondary button-ujarak" href="">Add to cart</a>-->
                 <button type="submit" name="add_to_cart"  value="' . $key . '">Add to cart</button>
                </div>
              </div>
            </article>
          </div>
        </div>';
    }
    $productos_markup .=
      '</form>
    </div> ';


    return $productos_markup;
  }
}



/** La siguiente función comprueba si el usuario está logueado o no (devuelve true o false) */
function is_user_logged_in()
{
  $logeado = false;
  if (isset($_SESSION['username'])) {
    $logeado = true;
  }
  return $logeado;
}
/** La siguiente función debe generar el código HTML del icono de usuario según las restricciones pedidas
 * Ten presente los ámbitos de las variables y los modificadores que puedes utilizar para cambiarlo
 */
function getUserMarkup()
{
  //Esta vez debes adaptar tú mismo el código de la plantilla para otorgar la funcionalidad del backend
  if (is_user_logged_in()) {
    return $_SESSION['username'];
  }
}
