const ProductSearch = () => {
  return (
    <div className="container search p-3 d-none">
      <div className="card bg-transparent border-0">
        <div className="card-header bg-transparent">
          <form action="#">
            <div className="form-group">
              <input
                type="search"
                name="search"
                id="search"
                placeholder="Search ..."
                className="form-control"
              />
            </div>
            <small className="form-text text-black-50">
              <span className="search-total">36</span> items found
            </small>
          </form>
        </div>
        <div className="card-body">
          <ul className="list-group list-group-flush search-items">
            <li className="list-group-item py-0">
              <a
                href="./product.html"
                className="d-inline-flex align-items-center"
              >
                <img
                  src="./images/products/bag/suitcase_1.png"
                  alt=""
                  width="64"
                  height="64"
                  className="img-thumbnail mr-2"
                />
                <div>
                  <h6 className="card-title mr-2">
                    Product Name here (Ksh <span className="price">1230</span>)
                    --
                    <span className="stock"> 23</span> in stock
                  </h6>
                  <p className="small">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Aut dolorem nostrum error ex nemo at!
                  </p>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  );
};

export default ProductSearch;
