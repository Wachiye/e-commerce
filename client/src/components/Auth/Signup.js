const Signup = () => {
  return (
    <div id="signup" className="modal show fade" tab-index="-1">
      <div className="modal-dialog" role="dialog">
        <div className="modal-content" role="document">
          <div className="modal-header">
            <img src="#" alt="" />
            <h2>Create Customer Account</h2>
            <button
              className="btn close"
              data-dismiss="modal"
              data-target="#signup"
            >
              <i className="fa fa-times"></i>
            </button>
          </div>
          <div className="modal-body">
            <form action="" method="post" name="signup-form" id="signup-form">
              <div className="form-group">
                <div className="form-group mb-3">
                  <input
                    type="text"
                    className="form-control form-control-sm"
                    name="username"
                    id="username"
                    placeholder="Username"
                  />
                </div>
                <div className="form-group mb-3">
                  <input
                    type="email"
                    className="form-control form-control-sm"
                    name="email"
                    id="email"
                    placeholder="Email address"
                  />
                </div>
                <div className="form-group mb-3">
                  <input
                    type="tel"
                    className="form-control form-control-sm"
                    name="phone"
                    id="phone"
                    placeholder="Phone Number"
                  />
                </div>
                <div className="form-group mb-3">
                  <input
                    type="password"
                    className="form-control form-control-sm"
                    name="password"
                    id="password"
                    placeholder="Password"
                  />
                </div>
                <div className="form-group mb-3">
                  <input
                    type="password"
                    className="form-control form-control-sm"
                    name="password2"
                    id="password2"
                    placeholder="Re-enter Password"
                  />
                </div>
                <div className="form-group">
                  <button className="btn btn-sm btn-warning text-light">
                    <i className="fa fa-send"></i> Submit
                  </button>
                  <a href="#signin" className="pull-right">
                    Sign In
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Signup;
