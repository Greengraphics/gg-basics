import { createRoot, render, createElement } from '@wordpress/element';

import './index.css';
import App from './App';

const domNode = document.getElementById('react-app');

if ( createRoot ) {
    let root = createRoot( domNode );
    root.render( <App /> );
} else {
    render( <App />, domNode );
}
