import './bootstrap';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import focus from '@alpinejs/focus'
import {Tooltip, initTE } from "tw-elements";
initTE({ Tooltip });

Alpine.plugin(focus)
window.Alpine = Alpine;
window.Tooltip = Tooltip;

Livewire.start();
