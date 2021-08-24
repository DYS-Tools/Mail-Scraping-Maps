import React from 'react';
import {BrowserRouter, NavLink, Route, Switch} from 'react-router-dom';
import Scrap from './Components/Scrap.js';
import { render } from 'react-dom';

console.log('Hello from front part');

render(<Scrap />, document.getElementById('javascript-result'));