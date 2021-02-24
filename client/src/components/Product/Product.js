const Product = ({ product }) => {
  return (
    <div className="row product-details">
      <div className="col-12 col-md-6">
        <h4 className="product-name">{product.name}</h4>
        <div className="desc">
          <p className="lead">
            {product.short_description}
            <button className="btn cta-btn">
              <i className="fa fa-arrow-down"></i>More
            </button>
          </p>
          <p id="more" className="more"></p>
        </div>
        <p className="price-list">
          <span className="price has-discount">Ksh 49, 000</span>
          <span className="price">Ksh 45, 000</span>
        </p>
        <p className="stock">
          <span>23</span> items in stock
        </p>
        <p className="warranty">Warrant: 2years</p>
        <div className="actions">
          <button className="btn add-to-cart">
            Add To Cart
            <span className="fa fa-check"></span>
          </button>
          <button className="btn cta-btn">Product Reviews</button>
          <button className=" btn cta-btn">
            <i className="fa fa-phone"></i>
            Help line
          </button>
          <button className=" btn cta-btn">
            <i className="fa fa-share-alt"></i>
            Share
          </button>
        </div>
      </div>
      <div className="col-12 col-md-6">
        <div className="features-package">
          <div className="features">
            <h6>Features</h6>
            <ul className="feature-list">
              <li>SSD 500GB ROM</li>
              <li>8GB RAM</li>
              <li>Silver Gray</li>
              <li>Core i7</li>
              <li>Bluetooth, Wi-Fi, Intel Graphics</li>
              <li>15' Display</li>
            </ul>
          </div>
          <div className="package">
            <h6>Package Items</h6>
            <ul>
              <li>1 Laptop</li>
              <li>1 Charger</li>
              <li>1 Laptop Bag</li>
            </ul>
          </div>
        </div>
        <div className="ranking">
          <h6>Product Ranking</h6>
          <ul className="list-inline rating">
            <li className="list-inline-item text-warning">
              <i className="fa fa-star"></i>
            </li>
            <li className="list-inline-item text-warning">
              <i className="fa fa-star"></i>
            </li>
            <li className="list-inline-item text-warning">
              <i className="fa fa-star"></i>
            </li>
            <li className="list-inline-item text-warning">
              <i className="fa fa-star"></i>
            </li>
            <li className="list-inline-item ">
              <i className="fa fa-star text-black-50"></i>
            </li>
          </ul>
          <div className="voting">
            <ul className="list-group">
              <li className="list-goup-item">
                <a href="/products/xyx/ratings">
                  <span className="rate">1 Star</span>
                  <span className="votes">7 Votes</span>
                </a>
              </li>
              <li className="list-goup-item">
                <a href="/products/xyx/ratings">
                  <span className="rate">2 Star</span>
                  <span className="votes">9 Votes</span>
                </a>
              </li>
              <li className="list-goup-item">
                <a href="/products/xyx/ratings">
                  <span className="rate">3 Star</span>
                  <span className="votes">3 Votes</span>
                </a>
              </li>
              <li className="list-goup-item">
                <a href="/products/xyx/ratings">
                  <span className="rate">4 Star</span>
                  <span className="votes">17 Votes</span>
                </a>
              </li>
              <li className="list-goup-item">
                <a href="/products/xyx/ratings">
                  <span className="rate">5 Star</span>
                  <span className="votes">56 Votes</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <p className="shipping-dates">
          This item will be shipped two days after order
        </p>
      </div>
    </div>
  );
};

export default Product;
