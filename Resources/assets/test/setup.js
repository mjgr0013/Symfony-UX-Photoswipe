/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

'use strict';

import '@symfony/stimulus-testing/setup';
import 'jest-canvas-mock';
import 'regenerator-runtime/runtime'
import Enzyme from 'enzyme'
import EnzymeAdapter from 'enzyme-adapter-react-16'

Enzyme.configure({
    adapter: new EnzymeAdapter()
})
