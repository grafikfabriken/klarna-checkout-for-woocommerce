<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Compliance with European Union's General Data Protection Regulation.
 *
 * @class    Klarna_Checkout_For_Woocommerce_KSS
 * @version  1.0.0
 * @package  Klarna_Checkout/Classes
 * @category Class
 * @author   Krokedil
 */
class Klarna_Checkout_For_Woocommerce_KSS {
	/**
	 * Class constructor.
	 */
	public function __construct() {
		add_filter( 'woocommerce_package_rates', array( $this, 'woocommerce_package_rates' ), 20, 2 );
	}


	/**
	 * Privacy declarations.
	 *
	 * @return void
	 */
	public function woocommerce_package_rates( $rates, $package ) {

		$kco_wc_kss_data = WC()->session->get( 'kco_wc_kss_data' );
		if ( ! empty( $kco_wc_kss_data ) ) {
			foreach ( $rates as $rate ) {
				// Set the price
				$rate->cost  = $kco_wc_kss_data['price'];
				$rate->label = $kco_wc_kss_data['name'];
				// Set the TAX
				// $rate->taxes[1] = 1000 * 0.2;
			}
		}
		error_log( 'woocommerce_package_rates 2' );

		return $rates;
	}


}
new Klarna_Checkout_For_Woocommerce_KSS();
