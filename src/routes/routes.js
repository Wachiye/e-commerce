import React from "react";
import { BrowserRouter as Router, Switch } from "react-router-dom";

//import layouts
import PublicLayout from "../layouts/PublicLayout";
// import PrivateLayout from '../layouts/PrivateLayout';

//import public and private route functions
import PublicRoute from "./PublicRoute";
// import PrivateRoute from './PrivateRoute';

//import pages
import HomePage from "../pages/HomePage";
import AboutPage from "../pages/AboutPage";
import ProductsPage from "../pages/ProductsPage";
import ProductPage from "../pages/ProductPage";
const routes = () => {
  return (
    <Router>
      {/* //define paths and routes */}
      <Switch>
        <PublicRoute
          path="/"
          exact
          component={HomePage}
          layout={PublicLayout}
        />
        <PublicRoute
          path="/about"
          exact
          component={AboutPage}
          layout={PublicLayout}
        />
        <PublicRoute
          path="/products"
          exact
          component={ProductsPage}
          layout={PublicLayout}
        />
        <PublicRoute
          path="/products/:slug"
          exact
          component={ProductPage}
          layout={PublicLayout}
        />
      </Switch>
    </Router>
  );
};
export default routes;
