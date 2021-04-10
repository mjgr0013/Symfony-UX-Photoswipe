/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

'use strict';

import { Controller } from 'stimulus';
import { Chart } from 'chart.js';

var PhotoSwipe = require("photoswipe");
var PhotoSwipeUI_Default = require("photoswipe/dist/photoswipe-ui-default");

require("photoswipe/dist/photoswipe.css");
require("photoswipe/dist/default-skin/default-skin.css");

export default class extends Controller {
    connect() {
        let pswpElement = document.querySelector('#pswp'), elements = [];

        let definedOptions = JSON.parse(pswpElement.parentElement.dataset.options);

        for (let key in definedOptions) {
            let value = definedOptions[key];

            // Parse float values
            if (!isNaN(parseFloat(value))) {
                definedOptions[key] = parseFloat(value);
            }

            // Parse boolean values
            if (["true", "false"].includes(value)) {
                definedOptions[key] = (definedOptions[key] === "true");
            }
        }

        this._dispatchEvent('photoswipe:pre-connect', { options: definedOptions });


        document.querySelectorAll('figure').forEach(element => {
            var $link = element.querySelector('a'),
                item = {
                    src: $link.getAttribute('href'),
                    w: $link.dataset.width,
                    h: $link.dataset.height,
                    title: $link.dataset.caption
                };
            elements.push(item);
        });

        document.querySelectorAll('a[itemprop="contentUrl"]').forEach(element => {
            element.addEventListener('click', (event) => {
                event.preventDefault();
                
                definedOptions.index = parseInt(event.target.dataset.key);
                var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, elements, definedOptions);
                gallery.init();

                this._dispatchEvent('photoswipe:connect', { gallery: gallery, options: definedOptions });
            })
        })
    }

    _dispatchEvent(name, payload = null, canBubble = false, cancelable = false) {
        const userEvent = document.createEvent('CustomEvent');
        userEvent.initCustomEvent(name, canBubble, cancelable, payload);

        this.element.dispatchEvent(userEvent);
    }
}
