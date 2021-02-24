import React from "react";
import ProductCard from "../Card/ProductCard";

const Products = ({ records }) => {
  if (records) {
    return (
      <div id="products" className="row products">
        {records.map((product, index) => {
          return (
            <div className="col-sm-6 col-md-4 col-lg-3 product" key={index}>
              <ProductCard product={product} />
            </div>
          );
        })}
      </div>
    );
  } else {
    return "No products found";
  }
};

export default Products;
