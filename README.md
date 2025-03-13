# ProxiBlue_TaxByDefaultShippingAddress module

Simply sets the default shipping address as the tax address used for any tax calculations.

This module allows Hyva cart to use the logged-in user default shipping address
for cart tax lookup.

My fix involves an after plugin onto a core method. I am sure there is a better 'hyva-way' to fix this, so this module exists as an interim solution.

## Reproduce
Ref: https://gitlab.hyva.io/hyva-themes/magento2-default-theme/-/issues/1182

## Install

You can install via composer:

* composer config repositories.github.repo.repman.io composer https://github.repo.repman.io
* composer require proxi-blue/module-tax-by-default-shipping-address
* ./bin/magento module:enable ProxiBlue_TaxByDefaultShippingAddress
* ./bin/magento setup:upgrade
* ./bin/magento setup:di:compile




