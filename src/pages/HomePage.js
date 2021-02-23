import React, { Component } from "react";

import Category from "../components/Category/Category";

import Offer from "../components/Offer/Offer";

import ProductSvc from "../services/product";

export default class HomePage extends Component {
  state = {
    offers: []
  };
  async componentDidMount() {
    let offers = await ProductSvc.getAll();
    this.setState({
      offers: offers
    });
  }
  render() {
    let { offers } = this.state;
    return (
      <>
        <main className="index-main" id="main">
          {/* carousel*/}
          {/* top selling products*/}
          {/* offers */}
          <div className="offers">
            <h2 className="section-header">Our SUPER Offers</h2>
            <div className="offer-list">
              {offers.length > 0 &&
                offers.map((offer_data, index) => {
                  return <Offer offer={offer_data} key={index} />;
                })}
            </div>
          </div>
          {/* categories */}
          <div className="category-list">
            <h3>Quick Links</h3>
            <div className="categories">
              <Category type="post" />
            </div>
          </div>
        </main>
      </>
    );
  }
}
