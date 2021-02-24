const Category = ({ category, type }) => {
  if (type === "product") {
    return (
      <div className="category">
        <div className="card h-100">
          <div className="card-img-top">
            <img src="./images/bg-comps.png" alt="" />
          </div>
          <div className="card-body">
            <h6 className="cart-title category-name">Electronics</h6>
          </div>
        </div>
      </div>
    );
  }
  return (
    <li>
      <a href="#category">Category 1</a>
    </li>
  );
};

export default Category;
