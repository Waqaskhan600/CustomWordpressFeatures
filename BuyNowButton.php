<?php
/* Dynamic Button for Simple & Variable Product */

/**
 * Main Functions
*/

function sbw_wc_add_buy_now_button_single()
{
    global $product;
    printf( '<button id="sbw_wc-adding-button" type="submit" name="sbw-wc-buy-now" value="%d" class="single_add_to_cart_button buy_now_button button alt">%s</button>', $product->get_ID(), esc_html__( 'Buy Now', 'sbw-wc' ) );
}

add_action( 'woocommerce_after_add_to_cart_button', 'sbw_wc_add_buy_now_button_single' );



/*** Handle for click on buy now ***/

function sbw_wc_handle_buy_now()
{
    if ( !isset( $_REQUEST['sbw-wc-buy-now'] ) )
    {
        return false;
    }

    WC()->cart->empty_cart();

    $product_id = absint( $_REQUEST['sbw-wc-buy-now'] );
    $quantity = absint( $_REQUEST['quantity'] );

    if ( isset( $_REQUEST['variation_id'] ) ) {

        $variation_id = absint( $_REQUEST['variation_id'] );
        WC()->cart->add_to_cart( $product_id, 1, $variation_id );

    }else{
        WC()->cart->add_to_cart( $product_id, $quantity );
    }

    wp_safe_redirect( wc_get_checkout_url() );
    exit;
}

add_action( 'wp_loaded', 'sbw_wc_handle_buy_now' );

/* Dynamic Button for Simple & Variable Product Closed */
