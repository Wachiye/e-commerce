import Nav from "../Nav/Nav";
const Header = ({ site_info }) => {
  return (
    <header>
      <div className="container">
        <div className="row">
          <div className="col-6">
            <h2 className="site-title">{site_info.name}</h2>
          </div>
          <div className="col-6">
            <div className="navbar">
              <ul className="navbar-nav ml-auto top-nav">
                <li className="nav-item">
                  <a
                    className="nav-link"
                    data-toggle="modal"
                    data-target="#signin"
                    href="#signin"
                  >
                    Sign in
                  </a>
                </li>
                <li className="nav-item">
                  <a
                    className="nav-link"
                    data-toggle="modal"
                    data-target="#signup"
                    href="#signup"
                  >
                    Sign up
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div className="container-fluid p-0">
        <Nav />
      </div>
    </header>
  );
};

export default Header;
