import React, { Component } from "react";

import Breadcrumb from "../components/Nav/Breadcrumb";
import ProductSearch from "../components/Search/ProductSearch";
import FilterNav from "../components/Nav/FilterNav";
import Products from "../components/Product/Products";
import Pagination from "../components/Nav/Pagination";

import ProductSvc from "../services/product";

export default class ProductsPage extends Component {
  state = {
    products: []
  };
  async componentDidMount() {
    let data = await ProductSvc.getAll();
    this.setState({
      products: data
    });
  }
  render() {
    let { products } = this.state;
    return (
      <>
        <main className="products-main" id="main">
          <ProductSearch />
          <Breadcrumb />
          <div className="products-panel">
            <FilterNav />
            <div className="container-fluid products-container">
              <Products records={products} />
              <div className="pages" id="pages">
                <Pagination />
              </div>
            </div>
          </div>
        </main>
      </>
    );
  }
}
