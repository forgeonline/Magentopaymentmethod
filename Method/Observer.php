<?php
/**
 * Forge
 * NOTICE OF LICENSE
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Forge
 * @package     Forge_Paymentmethodtest
 * @copyright   Copyright (c) 2014 Forge. (http://www.forge.co.nz)
 * @license     http://www.forge.co.nz
 */
class Forge_Paymentmethodtest_Model_Observer{
	public function paymentMethodFilter( $observer ){
		$event           = $observer->getEvent();
		$method          = $event->getMethodInstance();
		$result          = $event->getResult();
		$currencyCode    = Mage::app()->getStore()->getCurrentCurrencyCode();

		if($method->getCode($method->getCode()) == 'cashondelivery' ){
			$result->isAvailable = false;
		}
		
		$login = Mage::getSingleton( 'customer/session' )->isLoggedIn(); //Check if User is Logged In 
		if($login) {
			$customer =  Mage::getSingleton( 'customer/session' )->getCustomer();
			if( $customer->getId()==20 ){
				if($method->getCode($method->getCode()) == 'cashondelivery' ){
					$result->isAvailable = false;
				}
			}
		}
	}
}