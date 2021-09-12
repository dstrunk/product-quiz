# Product Quiz Recommendations for Magento 2.x

This module allows business-users to create product quiz recommendations within the Magento 2 admin dashboard.

## Installation

This package is best installed via composer. To install using the recommended method, run the following:

```shell
composer require silentpost/module-product-quiz
bin/magento module:enable Silentpost_ProductQuiz
bin/magento setup:upgrade
bin/magento setup:di:compile
```

### Packagist

This module is hosted on [packagist][packagist]. If you are using the default Magento metapackage, you will need to 
add the packagist repository to your store's `composer.json`:

```json
{
    "repositories": [
        {
            "type": "composer",
            "url": "https://repo.magento.com"
        },
        {
            "type": "composer",
            "url": "https://packagist.org"
        }
    ]
}
```

[packagist]: https://packagist.org/

## Setup

Setting up a Product Quiz from scratch in the Magento 2 admin can be found on the Product Quiz project's wiki, [found 
here][product-quiz-wiki].

[product-quiz-wiki]: https://github.com/dstrunk/product-quiz/wiki

## Frontend development

Currently, this quiz has no frontend configuration available via the Magento admin. Because of this, additional
development is required for the following:

  - Layout XML
  - Knockout Templates
  - CSS

### Layout XML

Adding the quiz to the frontend will require changes to the desired `layout.xml` file. A sample `layout.xml` can be seen
here:

```xml
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceContainer name="content">
            <block class="Silentpost\ProductQuiz\Block\Quiz" name="product-quiz" as="product-quiz" before="-" template="Silentpost_ProductQuiz::product-quiz.phtml" />
        </referenceContainer>
    </body>
</page>
```

### Knockout Templates

In the future other frameworks may be considered (e.g. AlpineJS using the Hyvä theme), but currently the frontend 
is completely driven by Knockout JS.

To customize Knockout templates, copy this package's `view/frontend/web/template` directory to the following directory,
`app/design/frontend/<Vendor>/<theme>/Silentpost_ProductQuiz`:

```shell
# Path: app/design/frontend/<Vendor>/<theme>/Silentpost_ProductQuiz 

web/template
├── product-quiz
│   └── stage
│       ├── error.html
│       ├── intro.html
│       ├── quiz
│       │   ├── answer.html
│       │   └── question.html
│       └── quiz.html
└── product-quiz.html

3 directories, 6 files
```

### CSS

The Product Quiz has no defined conventions around how it should look; stakeholders may wish to inline the quiz on a
homepage, display the quiz as a modal overlay, or a combination of the two. With this in mind, styles for the product
quiz is intentionally bare bones. For reference, there is a sample Less file of styling the Product Quiz on the
project's Wiki, [seen here][product-quiz-wiki].

**Note**: The Product Quiz departs from Magento 2's frontend CSS recommendations. Instead, the Product Quiz utilizes BEM
for CSS conventions. For more information about BEM, [see this link][bem].

To make CSS additions to the frontend of the Product Quiz, add the following file to a new 
`app/design/frontend/<Vendor>/<theme>/Silentpost_ProductQuiz` directory:

```shell
# Path: app/design/frontend/<Vendor>/<theme>/Silentpost_ProductQuiz 

web
└── css
    └── source
        └── _module.less

2 directories, 1 file
```

[bem]: http://getbem.com/

## Contributing

Please see `CONTRIBUTING.md` for details on the contributor code of conduct, as well as the process for submitting 
pull requests.

## Versioning

This project attempts to use [Semantic Versioning][semver] as closely as possible. For the versions available, see 
the [tags on this repository][tags].

[semver]: https://semver.org/
[tags]: https://github.com/dstrunk/Product-Quiz/tags

## License

Distributed under the MIT License. See `LICENSE.md` for more information.
