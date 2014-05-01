$ = jQuery;
var shoppingCart;

$(".add_to_cart_button").click(function(){
    getShoppingCart();
});

function getShoppingCart() {
    shoppingCart = $.load(window.location +  ' #shopping-cart');
    alert(shoppingCart);
}