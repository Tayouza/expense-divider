import './bootstrap';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import focus from '@alpinejs/focus'
 
Alpine.plugin(focus)
window.Alpine = Alpine;

Livewire.start();
