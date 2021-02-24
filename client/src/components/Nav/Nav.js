import CartPreview from "../Cart/CartPreview";

export default function Nav() {
  return (
    <nav className="navbar navbar-expand-lg navbar-bottom">
      <button
        type="button"
        className="btn border btn-sm d-lg-none navbar-toggle"
        data-toggle="collapse"
        data-target="#navbar-menu"
      >
        <i className="fa fa-bars"></i>
      </button>
      <div id="navbar-menu" className="collapse navbar-collapse">
        <ul className="navbar-nav mr-auto">
          <li className="nav-item active">
            <a href="/" className="nav-link">
              Home
            </a>
          </li>
          <li className="nav-item">
            <a href="/about" className="nav-link">
              About Us
            </a>
          </li>
          <li className="nav-item">
            <a href="/products" className="nav-link">
              Products
            </a>
          </li>
          <li className="nav-item">
            <a
              href="#categories"
              className="nav-link dropdown-toggle"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              Categories
            </a>
            <div id="categories" className="dropdown-menu">
              <a className="dropdown-item" href="/products/categories/shoes">
                Shoes
              </a>
              <a className="dropdown-item" href="/products/categories/beddings">
                Beddings
              </a>
              <a className="dropdown-item" href="/products/categories/grocery">
                Grocery
              </a>
            </div>
          </li>
          <li className="nav-item">
            <a href="/contact" className="nav-link">
              Contact Us
            </a>
          </li>
          <li className="nav-item">
            <a href="/blog" className="nav-link">
              Blog
            </a>
          </li>
        </ul>
      </div>
      <ul className="navbar-nav ml-auto nav-right">
        <li className="nav-item nav-right-item">
          <a href="#search" className="nav-link" id="search-toggle">
            <i className="fa fa-search"></i>
          </a>
        </li>
        <li className="nav-item nav-right-item d-lg-none" title="Filter">
          <a href="#filter" id="filter-toggle" className="nav-link">
            <i className="fa fa-filter"></i>
          </a>
        </li>
        <li className="nav-item nav-right-item">
          <a href="#cart-preview" className="nav-link">
            <i className="fa fa-shopping-cart"></i>
          </a>
          <span className="badge">0</span>
          <div id="cart"></div>
        </li>
        <CartPreview />
      </ul>
    </nav>
  );
}
