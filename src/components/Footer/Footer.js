const Footer = () => {
  return (
    <footer>
      <div className="container-fluid">
        <div className="row">
          <div className="col-12 partners">
            <h5>IN PARTNERSHIP WITH</h5>
            <div className="cards">
              <div className="card">
                <img src="./images/logos/mpesa.png" alt="" />
              </div>
              <div className="card">
                <img src="./images/logos/paypal.png" alt="" />
              </div>
              <div className="card">
                <img src="./images/logos/kcb.png" alt="" />
              </div>
            </div>
            <p>
              <i className="fa fa-dot-circle-o"></i>
              Secure Online Payment
              <i className="fa fa-dot-circle-o"></i>
            </p>
          </div>
          <div className="col-12 text-center">
            <ul className="list-inline">
              <li className="list-inline-item">
                <a href="#facebook">
                  <i className="fa fa-2x fa-facebook"></i>
                </a>
              </li>
              <li className="list-inline-item">
                <a href="#twitter">
                  <i className="fa fa-2x fa-twitter"></i>
                </a>
              </li>
              <li className="list-inline-item">
                <a href="#insta">
                  <i className="fa fa-2x fa-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
          <div className="col-md-4 col-lg-3">
            <h5>E-Commerce Website</h5>
            <p className="lead">Shop with us.Save More</p>
            <ul className="list-unstyled">
              <li>
                <a href="tel:x">
                  <i className="fa fa-phone"></i>
                  +254712345678
                </a>
              </li>
              <li>
                <a href="mailto:x">
                  <i className="fa fa-envelope"></i>
                  ecommerce@domain.com
                </a>
              </li>
            </ul>
          </div>
          <div className="col-md-4 col-lg-3">
            <h5>Information</h5>
            <ul className="list-unstyled">
              <li>
                <a href="/about">About Us</a>
              </li>
              <li>
                <a href="/terms">Terms & Conditions</a>
              </li>
              <li>
                <a href="/privacy-policy">Privacy Policy</a>
              </li>
            </ul>
          </div>
          <div className="col-md-4 col-lg-3">
            <h5>Support</h5>
            <ul className="list-unstyled">
              <li>
                <a href="/shipping">Shipping & Delivery</a>
              </li>
              <li>
                <a href="/contact">Contact Us</a>
              </li>
            </ul>
          </div>
          <div className="col-12 col-lg-3">
            <p>
              Designed & Developed by
              <a href="mailto:siranjofuw@gmail.com">Wachiye Siranjofu</a>
            </p>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
