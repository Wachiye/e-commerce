import React, { Component } from "react";
import Breadcrumb from "../components/Nav/Breadcrumb";
import Testimonial from "../components/Comment/Testimonial";

export default class AboutPage extends Component {
  render() {
    return (
      <>
        <main className="about-main" id="main">
          <Breadcrumb />
          <div className="container">
            <h3 className="section-title text-center"> About Us</h3>
            <div className="row my-2">
              <div className="col-md-10 offset-md-1 the-strory">
                <p>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                  Cupiditate ducimus, corporis voluptas vero ipsam similique
                  nostrum? Voluptatum mollitia hic, dolorem dignissimos quas,
                  laboriosam, culpa numquam itaque ipsa temporibus ex modi?
                </p>
                <p>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                  Cupiditate ducimus, corporis voluptas vero ipsam similique
                  nostrum? Voluptatum mollitia hic, dolorem dignissimos quas,
                  laboriosam, culpa numquam itaque ipsa temporibus ex modi?
                </p>
                <p>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                  Cupiditate ducimus, corporis voluptas vero ipsam similique
                  nostrum? Voluptatum mollitia hic, dolorem dignissimos quas,
                  laboriosam, culpa numquam itaque ipsa temporibus ex modi?
                </p>
              </div>
            </div>
            <div className="row mb-2">
              <div className="col-md-4">
                <h4 className="text-center">Our Vision</h4>
              </div>
              <div className="col-md-4">
                <h4 className="text-center">Our Mission</h4>
              </div>
              <div className="col-md-4">
                <h4 className="text-center">Core Values</h4>
              </div>
            </div>
            <div className="class row mb-2 store">
              <div className="col-md-7">
                <h4 className="text-center">Our Store & Office</h4>
              </div>
              <div className="col-md-5">
                <h4 className="text-center">Our Contacts</h4>
                <div className="card bg-transparent border-0 shadow-none">
                  <div className="card-body">
                    <ul className="list-group list-group-flush">
                      <li className="list-group-item">
                        Phone:{" "}
                        <span className="pull-right"> +254790983123</span>
                      </li>
                      <li className="list-group-item">
                        Email:{" "}
                        <span className="pull-right">
                          {" "}
                          siranjofuw@gmail.com
                        </span>
                      </li>
                      <li className="list-group-item">
                        Help Line:{" "}
                        <span className="pull-right"> +254790983123</span>
                      </li>
                      <li className="list-group-item">
                        Address:{" "}
                        <span className="pull-right"> Nakuru 536, Kenya</span>
                      </li>
                      <li className="list-group-item">
                        <p className="text-center">
                          <i className="fa fa-map-marker fa-2x"></i>
                        </p>
                        <div id="map"></div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="row mb-2">
              <div className="col-12">
                <h4 className="text-center">Our Products</h4>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Adipisci pariatur architecto, quisquam illo accusantium eaque
                  officia quibusdam harum. Vero, doloribus?
                </p>
              </div>
            </div>
            <div className="row mb-2 team">
              <div className="col-12">
                <h4 className="text-center">Our Team</h4>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Adipisci pariatur architecto, quisquam illo accusantium eaque
                  officia quibusdam harum. Vero, doloribus?
                </p>
              </div>
              <div className="col-sm-6 col-md-3">
                <div className="card"></div>
              </div>
              <div className="col-sm-6 col-md-3">
                <div className="card"></div>
              </div>
              <div className="col-sm-6 col-md-3">
                <div className="card"></div>
              </div>
              <div className="col-sm-6 col-md-3">
                <div className="card"></div>
              </div>
            </div>

            <div className="row mb-2 cta">
              <div className="col-12">
                <h4 className="text-center">More Details</h4>
                <ul className="list-inline text-center">
                  <li className="list-inline-item">
                    <button className="btn btn-sm btn-dark">
                      Terms & Conditions
                    </button>
                  </li>
                  <li className="list-inline-item">
                    <button className="btn btn-sm btn-dark">
                      Shipping & Delivery
                    </button>
                  </li>
                  <li className="list-inline-item">
                    <button className="btn btn-sm btn-dark">
                      Privacy Policy
                    </button>
                  </li>
                  <li className="list-inline-item btn-dark">
                    <button className="btn btn-sm btn-dark">
                      Return Policy
                    </button>
                  </li>
                  <li className="list-inline-item">
                    <button className="btn btn-sm btn-dark">
                      Selling with us
                    </button>
                  </li>
                </ul>
              </div>
            </div>

            <div className="row mb-2">
              <div className="col-12 mb-2">
                <h3 className="text-center">What People Say About Us</h3>
              </div>
              <div className="col-md-8 offset-md-2">
                <Testimonial />
              </div>
            </div>
          </div>
        </main>
      </>
    );
  }
}
