import React from 'react';
import { BrowserRouter } from 'react-router-dom';

import './Index.css';
import Routes from './Routes';

export default function Index() {
    return (
        <BrowserRouter>
            <Routes />
        </BrowserRouter>
    );
}
