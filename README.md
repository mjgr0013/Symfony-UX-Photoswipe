# Symfony UX Photoswipe

Symfony UX Photoswipe is a Symfony bundle integrating the [Photoswipe](https://photoswipe.com/)
library in Symfony applications. It is part of [the Symfony UX initiative](https://symfony.com/ux).

## Installation

Symfony UX Photoswipe requires PHP 7.2+ and Symfony 4.4+.

Install this bundle using Composer and Symfony Flex:

```sh
composer require symfony/ux-photoswipe

# Don't forget to install the JavaScript dependencies as well and compile
yarn install --force
yarn encore dev
```

Also make sure you have at least version 2.0 of [@symfony/stimulus-bridge](https://github.com/symfony/stimulus-bridge)
in your `package.json` file.

## Usage

To use Symfony UX Chart.js, inject the `GalleryBuilderInterface` service and
create charts in PHP:

```php
// ...
use Symfony\UX\Photoswipe\Builder\GalleryBuilderInterface;
use Symfony\UX\Photoswipe\Model\Gallery;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(GalleryBuilderInterface $galleryBuilder): Response
    {
        $images = [];

        for ($i = 0; $i<=5; $i++) {
            $rand = rand(0, 1000);

            array_push($images, [
                'href' => "https://unsplash.it/1200/900/?image={$rand}",
                'src' => "https://unsplash.it/400/300/?image={$rand}",
                'data-caption' => "Sea side, south shore<br><em class='text-muted'>© Dominik Schröder</em>"
            ]);
        }

        /** @var Gallery $gallery */
        $gallery = $galleryBuilder->createGallery();
        $gallery->addOption('arrowKeys', "false");
        $gallery->addOption('bgOpacity', 0.5);
        
        // Also yo can assign massively options
        $gallery->setOptions([
            'arrowKeys' => "false",
            'bgOpacity' => 0.5
        ]);
        
        // Also you can combine into single instantiation
        $gallery = $galleryBuilder->createGallery(
            ['arrowKeys' => false, 'bgOpacity' => 0.5],
            'hello'
        );

        foreach ($images as $image) {
            $gallery->addImage(new Image($image['href'], $image['src'],$image['data-caption']));
        }

        return $this->render('home/index.html.twig', [
            'gallery' => $gallery
        ]);
    }
}
```

All options and data are provided as-is to Chart.js. You can read
[Photoswipe documentation](https://photoswipe.com/documentation/options.html) to discover them all.

Once created in PHP, a chart can be displayed using Twig:

```twig
{{ render_gallery(gallery) }}

{# You can pass HTML attributes as a second argument to add them on the <canvas> tag #}
{{ render_chart(chart) }}
```

### Extend the default behavior

Symfony UX Photoswipe allows you to extend its default behavior using a custom Stimulus controller:

```js
// gallery_controller.js

import { Controller } from 'stimulus';

export default class extends Controller {
    connect() {
        this.element.addEventListener('photoswipe:pre-connect', this._onPreConnect);
        this.element.addEventListener('photoswipe:connect', this._onConnect);
    }

    disconnect() {
        // You should always remove listeners when the controller is disconnected to avoid side effects
        this.element.removeEventListener('photoswipe:pre-connect', this._onPreConnect);
        this.element.removeEventListener('photoswipe:connect', this._onConnect);
    }

    _onPreConnect(event) {
        // The chart is not yet created
        console.log(event.detail); // You can access the chart options using the event details

        // Update some options
        event.detail.options.arrowKeys = true;

    }

    _onConnect(event) {
        // The gallery was just created
        console.log(event.detail.gallery); // You can access the gallery instance using the event details
    }
}
```

Then in your render call, add your controller as an HTML attribute:

```php
/** @var Gallery $gallery */
$gallery = $galleryBuilder->createGallery([], 'home');
```

## Backward Compatibility promise

This bundle aims at following the same Backward Compatibility promise as the Symfony framework:
[https://symfony.com/doc/current/contributing/code/bc.html](https://symfony.com/doc/current/contributing/code/bc.html)

However it is currently considered
[**experimental**](https://symfony.com/doc/current/contributing/code/experimental.html),
meaning it is not bound to Symfony's BC policy for the moment.

## Run tests

### PHP tests

```sh
php vendor/bin/simple-phpunit Tests
```

### JavaScript tests

```sh
cd Resources/assets
yarn test
```
