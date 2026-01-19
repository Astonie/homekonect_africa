import './bootstrap';

import Alpine from 'alpinejs';
import { PropertyGallery } from './components/PropertyGallery';
import { PropertyMap } from './components/PropertyMap';

window.Alpine = Alpine;
window.PropertyGallery = PropertyGallery;
window.PropertyMap = PropertyMap;

Alpine.start();
