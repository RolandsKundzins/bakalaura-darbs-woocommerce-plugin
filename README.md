# LV - Bakalaura darba WooCommerce lietotne

Šis projekts tiek lietots pētnieciskajai daļai bakalaura darbā "SPRAUDŅU IZSTRĀDE VAIRĀKĀM E-KOMERCIJAS PLATFORMĀM: IEGUVUMI, IZAICINĀJUMI UN IESPĒJAS UZLABOŠANAI".

Veidojot šo lietotni, galvenais mērķis ir pārbaudīt tieši WooCommerce platformas spējas, nevis pārlieku pievērst uzmanību sarežģītas uzņēmējdarbības loģikas izpratnei un implementācijai, jo šo aspektu ieviešana būtu līdzvērtīga risinājumam, kas veidots no pamatiem, neizmantojot WooCommerce. Noskaidrosim arī tehnisko rīku izmantošanas iespējas un ērtumu priekš izstrādātāja.

## Lietotnes palaišana (iespējams kāds solis ir izlaists)
- [Instalēt Local Wordpress](https://localwp.com/)
- Iekš mapes wp-content/plugins ieklonēt šo repozitoriju
- Iegūt Node.js versiju 20 (var izmantot NVM - node version manager)
- npm install
- npm start
- Doties uz Wordpress Admin un instalēt WooCommerce spraudni
- Izveidot testa produktus un iegūt block-based veikala veidni, piemēram, "Storefront"
- Doties uz Wordpress Admin -> Plugins un aktivizēt spraudni ar nosaukumu "Bakalaura Parcel Machine Plugin"
- Doties uz pirkuma noformēšanas lapu un pārbaudīt vai parādās pakomātu izvēlne
- Iekš "wp-config.php" un pievienot:
    ```
    define( 'WP_DEBUG', true );
    define( 'WP_DEBUG_LOG', true );
    ```
- Doties uz wp-content/debug.log un pārbaudīt vai parādās jauni ieraksti nomainot izvēlēto pakomātu, piemēram:
    ```
    [13-Apr-2025 08:52:42 UTC] Order ID: 172 - Selected Parcel Machine: machine_3
    ```

Pamācības:
- https://github.com/woocommerce/woocommerce/blob/trunk/packages/js/extend-cart-checkout-block/README.md
- https://developer.woocommerce.com/docs/cart-and-checkout-extensibility-getting-started-guide/
- https://developer.woocommerce.com/docs/customizing-checkout-fields-using-actions-and-filters/


# ENG - Bachelors work Shopify app

This project is used for investigatory part of bachelors work "DEVELOPMENT OF PLUGINS FOR MULTIPLE E-COMMERCE PLATFORMS: BENEFITS, CHALLENGES, AND OPPORTUNITIES FOR IMPROVEMENT".

The main goal of creating this application is to test the capabilities of the WooCommerce platform rather than focusing too much on understanding and implementing complex business logic, as implementing these aspects would be equivalent to creating a solution from scratch without using WooCommerce. We will also explore the possibilities and ease of use of technical tools for developers.

## Application Launch (some steps might be skipped)
- [Install Local Wordpress](https://localwp.com/)
- Clone this repository into the wp-content/plugins folder
- Obtain Node.js version 20 (you can use NVM - Node Version Manager)
- npm install
- npm start
- Go to Wordpress Admin and install the WooCommerce plugin
- Create test products and obtain a block-based store theme, such as "Storefront"
- Go to Wordpress Admin -> Plugins and activate the plugin named "Bakalaura Parcel Machine Plugin"
- Go to the checkout page and check if the parcel machine selection appears
- In "wp-config.php" add:
    ```
    define( 'WP_DEBUG', true );
    define( 'WP_DEBUG_LOG', true );
    ```
- Go to wp-content/debug.log and check if new entries appear when changing the selected parcel machine, for example:
    ```
    [13-Apr-2025 08:52:42 UTC] Order ID: 172 - Selected Parcel Machine: machine_3
    ```

Guides:
- https://github.com/woocommerce/woocommerce/blob/trunk/packages/js/extend-cart-checkout-block/README.md
- https://developer.woocommerce.com/docs/cart-and-checkout-extensibility-getting-started-guide/
- https://developer.woocommerce.com/docs/customizing-checkout-fields-using-actions-and-filters/
