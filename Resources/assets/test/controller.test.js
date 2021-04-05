/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

'use strict';

import {Application, Controller} from 'stimulus';
import {getByTestId, waitFor} from '@testing-library/dom';
import {clearDOM, mountDOM} from '@symfony/stimulus-testing';
import PhotoswipeController from '../dist/controller';
import 'regenerator-runtime/runtime'
import {toHaveStyle} from '@testing-library/jest-dom'

// Controller used to check the actual controller was properly booted
class CheckController extends Controller {
    connect() {
        this.element.addEventListener('photoswipe:pre-connect', () => {
            this.element.classList.add('pre-connected');
        });

        this.element.addEventListener('photoswipe:connect', (event) => {
            this.element.classList.add('connected');
            this.element.options = event.detail.options;
        });
    }
}

const startStimulus = () => {
    const application = Application.start();
    application.register('check', CheckController);
    application.register('photoswipe', PhotoswipeController);
};

describe('PhotoswipeController', () => {
    let container;
    let galleryHtml = `
        <div id="pswp">

        </div>
        <div data-testid="photoswipe"
             data-controller="check photoswipe"
             id="gallery" className="gallery" itemScope="" itemType="http://schema.org/ImageGallery">
            <figure itemProp="associatedMedia" itemScope="" itemType="http://schema.org/ImageObject">
                <!-- Link to the big image, not mandatory, but usefull when there is no JS -->
                <a href="https://unsplash.it/1200/900/?image=642"
                   data-caption="Sea side, south shore<br><em class='text-muted'>© Dominik Schröder</em>" data-width="1200"
                   data-height="700" itemProp="contentUrl">
                    <!-- Thumbnail -->
                    <img data-key="0" src="https://unsplash.it/400/300/?image=642" itemProp="thumbnail"
                         alt="Image description">
                </a>
            </figure>
            <figure itemProp="associatedMedia" itemScope="" itemType="http://schema.org/ImageObject">
                <!-- Link to the big image, not mandatory, but usefull when there is no JS -->
                <a href="https://unsplash.it/1200/900/?image=876"
                   data-caption="Sea side, south shore<br><em class='text-muted'>© Dominik Schröder</em>" data-width="1200"
                   data-height="700" itemProp="contentUrl">
                    <!-- Thumbnail -->
                    <img data-key="1" src="https://unsplash.it/400/300/?image=876" itemProp="thumbnail"
                         alt="Image description">
                </a>
            </figure>
            <figure itemProp="associatedMedia" itemScope="" itemType="http://schema.org/ImageObject">
                <!-- Link to the big image, not mandatory, but usefull when there is no JS -->
                <a href="https://unsplash.it/1200/900/?image=764"
                   data-caption="Sea side, south shore<br><em class='text-muted'>© Dominik Schröder</em>" data-width="1200"
                   data-height="700" itemProp="contentUrl">
                    <!-- Thumbnail -->
                    <img data-key="2" src="https://unsplash.it/400/300/?image=764" itemProp="thumbnail"
                         alt="Image description">
                </a>
            </figure>
            <figure itemProp="associatedMedia" itemScope="" itemType="http://schema.org/ImageObject">
                <!-- Link to the big image, not mandatory, but usefull when there is no JS -->
                <a href="https://unsplash.it/1200/900/?image=208"
                   data-caption="Sea side, south shore<br><em class='text-muted'>© Dominik Schröder</em>" data-width="1200"
                   data-height="700" itemProp="contentUrl">
                    <!-- Thumbnail -->
                    <img data-key="3" src="https://unsplash.it/400/300/?image=208" itemProp="thumbnail"
                         alt="Image description">
                </a>
            </figure>
            <figure itemProp="associatedMedia" itemScope="" itemType="http://schema.org/ImageObject">
                <!-- Link to the big image, not mandatory, but usefull when there is no JS -->
                <a href="https://unsplash.it/1200/900/?image=626"
                   data-caption="Sea side, south shore<br><em class='text-muted'>© Dominik Schröder</em>" data-width="1200"
                   data-height="700" itemProp="contentUrl">
                    <!-- Thumbnail -->
                    <img data-key="4" src="https://unsplash.it/400/300/?image=626" itemProp="thumbnail"
                         alt="Image description">
                </a>
            </figure>
            <figure itemProp="associatedMedia" itemScope="" itemType="http://schema.org/ImageObject">
                <!-- Link to the big image, not mandatory, but usefull when there is no JS -->
                <a href="https://unsplash.it/1200/900/?image=436"
                   data-caption="Sea side, south shore<br><em class='text-muted'>© Dominik Schröder</em>" data-width="1200"
                   data-height="700" itemProp="contentUrl">
                    <!-- Thumbnail -->
                    <img data-key="5" src="https://unsplash.it/400/300/?image=436" itemProp="thumbnail"
                         alt="Image description">
                </a>
            </figure>
        </div>`;

    afterEach(() => {
        clearDOM();
    });

    it('connect without options', async () => {
        container = mountDOM(`
            <div data-options='{}'>
                ${galleryHtml}
            </div>
        `);

        expect(getByTestId(container, 'photoswipe')).not.toHaveClass('pre-connected');
        expect(getByTestId(container, 'photoswipe')).not.toHaveClass('connected');

        startStimulus();
        await waitFor(() => {
            expect(getByTestId(container, 'photoswipe')).toHaveClass('pre-connected');
            expect(getByTestId(container, 'photoswipe')).toHaveClass('connected');
        });

        const options = getByTestId(container, 'photoswipe').options;
        expect(options.arrowKeys).toBe(undefined);
    });

    return;

    it('connect with options', async () => {
        container = mountDOM(`
            <div data-options='{"arrowKeys":"false","bgOpacity":"0.5"}'>
                 ${galleryHtml}
            </div>
        `);

        expect(getByTestId(container, 'photoswipe')).not.toHaveClass('pre-connected');
        expect(getByTestId(container, 'photoswipe')).not.toHaveClass('connected');

        startStimulus();
        await waitFor(() => {
            expect(getByTestId(container, 'photoswipe')).toHaveClass('pre-connected');
            expect(getByTestId(container, 'photoswipe')).toHaveClass('connected');
        });

        const options = getByTestId(container, 'photoswipe').options;
        expect(options.arrowKeys).toBe(false);
    });
});
