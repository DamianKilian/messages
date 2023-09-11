/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

import axios from 'axios';
import {createApp} from 'vue';


window.axios = axios;
const app = createApp({});


import MessageIndex from './components/MessageIndex.vue';
app.component('message-index', MessageIndex)
import MessageNew from './components/MessageNew.vue';
app.component('message-new', MessageNew)

app.mount("#app");
