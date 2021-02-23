import React, { Component } from "react";

import Header from "../components/Header/Header";
import Breadcrumb from "../components/Nav/Breadcrumb";
import ProductSearch from "../components/Search/ProductSearch";
import Footer from "../components/Footer/Footer";
import Product from "../components/Product/Product";
import Products from "../components/Product/Products";
export default class ProductPage extends Component {
  render() {
    return (
      <>
        <Header site_info={{ name: "Home Decor" }} />
        <main className="products-main" id="main">
          <ProductSearch />
          <Breadcrumb />
          <div className="container">
            <Product />
            <hr />
            <div className="row">
              <div className="col-12">
                <h4>Customers also viewed this items</h4>
              </div>
            </div>
            <Products />
          </div>
        </main>
        <Footer />
      </>
    );
  }
}
