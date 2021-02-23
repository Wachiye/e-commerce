const FilterNav = ({ features }) => {
  return (
    <div className="navigation">
      <div className="nav-container">
        <div className="filter">
          <div className="filter">
            <h5>Filter</h5>
            <form action="#" method="get">
              <div className="form-group">
                <label htmlFor="price">By Price</label>
                <select
                  name="price"
                  id="price"
                  className="form-control form-control-sm"
                  defaultValue="all"
                >
                  <option value="0-3000">0 - 3000</option>
                  <option value="3001-6000">3001 - 6000</option>
                  <option value="6001-9000">6001 - 9000</option>
                  <option value="9001-12000">9001 - 12000</option>
                  <option value="12001-15000">12001 - 15000</option>
                  <option value=">15000">{">"} 15000</option>
                  <option value="all">All</option>
                </select>
              </div>
              <div className="form-group">
                <label htmlFor="size">By Size</label>
                <select
                  name="size"
                  id="size"
                  className="form-control form-control-sm"
                  defaultValue="all"
                >
                  <option value="XS">XS</option>
                  <option value="S">S</option>
                  <option value="L">L</option>
                  <option value="XL">XL</option>
                  <option value="M">M</option>
                  <option value="XXL">XX</option>
                  <option value="4-6">4-6</option>
                  <option value="6-9">6-9</option>
                  <option value=">9"> {">"}9</option>
                  <option value="all">All</option>
                </select>
              </div>
              <div className="form-group">
                <label htmlFor="color">By Color</label>
                <select
                  name="color"
                  id="color"
                  className="form-control form-control-sm"
                  defaultValue="all"
                >
                  <option value="black">Black</option>
                  <option value="white">White</option>
                  <option value="red">Red</option>
                  <option value="green">Green</option>
                  <option value="pink">Pink</option>
                  <option value="blue">Blue</option>
                  <option value="all">All</option>
                </select>
              </div>
              <div className="form-group">
                <label htmlFor="gender">By Gender</label>
                <select
                  name="gender"
                  id="gender"
                  className="form-control form-control-sm"
                  defaultValue="all"
                >
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="all">All</option>
                </select>
              </div>
              <div className="form-group">
                <label htmlFor="brand">By Brand</label>
                <select
                  name="brand"
                  id="brand"
                  className="form-control form-control-sm"
                  defaultValue="all"
                >
                  <option value="adidas">Adidas</option>
                  <option value="nike">nike</option>
                  <option value="puma">Puma</option>
                  <option value="all">all</option>
                </select>
              </div>
              <button className="btn btn-sm btn-primary" type="submit">
                <i className="fa fa-filter"></i> Apply
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default FilterNav;
