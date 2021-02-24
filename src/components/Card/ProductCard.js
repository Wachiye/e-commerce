const ProductCard = ({ product }) => {
  return (
    <div className="card">
      <div className="card-img-top">
        <img
          src="https://res.cloudinary.com/cloudsirah/image/upload/v1605116749/pi4g0xpgehvumykolfip.png"
          alt=""
          className="img-thumbnail img-fluid"
        />
      </div>
      <div className="card-body">
        <h5 className="card-title">{product.name}</h5>
        <ul className="list-inline">
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
        <PriceSection
          on_offer={product.on_offer}
          price={product.price}
          dicount={product.discount}
        />
        <div className="actions">
          <a href="/products/cart/add/id/2" className="add-to-cart">
            <i className="fa fa-plus"></i>
          </a>
          <a href="/products/slug/this-is-the-slug">More</a>
        </div>
      </div>
    </div>
  );
};
const PriceSection = ({ on_offer, price, discount }) => {
  if (on_offer) {
    return (
      <div class="price-list">
        <span class="price has-discount">Ksh {price}</span>
        <span class="price discount">Ksh {price - discount}</span>
        <p className="lead small text-success">Save Ksh {discount}</p>
      </div>
    );
  } else {
    return (
      <div className="price-list">
        <span className="price">Ksh {price}</span>
      </div>
    );
  }
};
export default ProductCard;
