# Installation of the Opensearch Client Bundle

:::info

 This bundle is only supported on OpenDxp Core Framework 1.x.

:::

 ## Bundle Installation

To install the Opensearch Client Bundle, follow the three steps below:

1) Install the required dependencies:

```bash
composer require open-dxp/opensearch-client
```

2) This bundle is a standard symfony bundle. If not required and activated by another bundle, it can be enabled by adding it to the `bundles.php` of your application.

```php
use OpenDxp\Bundle\OpenSearchClientBundle\OpenDxpOpenSearchClientBundle;
// ...
return [
    // ...
    OpenDxpOpenSearchClientBundle::class => ['all' => true],
    // ...
];  
```
