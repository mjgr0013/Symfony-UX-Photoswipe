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
var PhotoSwipe = require("photoswipe");

// Controller used to check the actual controller was properly booted
class CheckController extends Controller {
    connect() {
        this.element.addEventListener('photoswipe:pre-connect', () => {
            this.element.classList.add('pre-connected');
            this.element.options = event.detail.options;
        });

        this.element.addEventListener('photoswipe:connect', (event) => {
            this.element.classList.add('connected');
            this.element.gallery = event.detail.gallery;
        });
    }
}

const startStimulus = () => {
    const application = Application.start();
    application.register('check', CheckController);
    application.register('photoswipe', PhotoswipeController);
};

const prepareHtml = (options = {}) => {
    return `
        <div
            data-options=${JSON.stringify(options)}
            data-testid="photoswipe"
            data-controller="check photoswipe"
        >
           <div class="pswp" id="pswp" tabindex="-1" role="dialog" aria-hidden="true">

            <!-- Background of PhotoSwipe.
                 It's a separate element as animating opacity is faster than rgba(). -->
            <div class="pswp__bg"></div>
    
            <!-- Slides wrapper with overflow:hidden. -->
            <div class="pswp__scroll-wrap">
    
                <!-- Container that holds slides.
                    PhotoSwipe keeps only 3 of them in the DOM to save memory.
                    Don't modify these 3 pswp__item elements, data is added later on. -->
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>
    
                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                <div class="pswp__ui pswp__ui--hidden">
    
                    <div class="pswp__top-bar">
    
                        <!--  Controls are self-explanatory. Order can be changed. -->
    
                        <div class="pswp__counter"></div>
    
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
    
                        <button class="pswp__button pswp__button--share" title="Share"></button>
    
                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
    
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
    
                        <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                        <!-- element will get class pswp__preloader--active when preloader is running -->
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>
    
                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                    </button>
    
                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                    </button>
    
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
    
                </div>
            </div>
            </div>
           <div 
                 id="gallery" className="gallery" itemScope="" itemType="http://schema.org/ImageGallery">
                <figure itemProp="associatedMedia" itemScope="" itemType="http://schema.org/ImageObject">
                    <!-- Link to the big image, not mandatory, but usefull when there is no JS -->
                    <a href="https://unsplash.it/1200/900/?image=642"
                       data-testid="firstelement"
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
            </div>
        </div>`;
}

describe('PhotoswipeController', () => {
    let container;

    afterEach(() => {
        clearDOM();
    });

    it('connect without options', async () => {
        container = mountDOM(prepareHtml());

        expect(getByTestId(container, 'photoswipe')).not.toHaveClass('pre-connected');
        expect(getByTestId(container, 'photoswipe')).not.toHaveClass('connected');
        
        startStimulus();
        await waitFor(() => {
            expect(getByTestId(container, 'photoswipe')).toHaveClass('pre-connected');
        });

        const options = getByTestId(container, 'photoswipe').options;
        expect(options.arrowKeys).toBe(undefined);
        
        await waitFor(() => {
            getByTestId(container, 'firstelement').click();
            expect(getByTestId(container, 'photoswipe')).toHaveClass('connected');
        });

        const gallery = getByTestId(container, 'photoswipe').gallery;
        expect(gallery).toBeInstanceOf(PhotoSwipe);
    });
    
    it('connect with options', async () => {
        container = mountDOM(prepareHtml({arrowKeys: false, bgOpacity: 0.5}));
        
        expect(getByTestId(container, 'photoswipe')).not.toHaveClass('pre-connected');
        expect(getByTestId(container, 'photoswipe')).not.toHaveClass('connected');

        startStimulus();
        await waitFor(() => {
            expect(getByTestId(container, 'photoswipe')).toHaveClass('pre-connected');
        });

        await waitFor(() => {
            getByTestId(container, 'firstelement').click();
            expect(getByTestId(container, 'photoswipe')).toHaveClass('connected');
        });

        const gallery = getByTestId(container, 'photoswipe').gallery;
        expect(gallery).toBeInstanceOf(PhotoSwipe);

        const options = getByTestId(container, 'photoswipe').options;
        expect(options.arrowKeys).toBe(false);
        expect(options.bgOpacity).toBe(0.5);
    });
});
