const Login = () => {
  return (
    <div id="signin" className="modal show fade" tab-index="-1">
      <div className="modal-dialog" role="dialog">
        <div className="modal-content" role="document">
          <div className="modal-header">
            <img src="#" alt="" />
            <h2>User Authentication</h2>
            <button
              className="btn close"
              data-dismiss="modal"
              data-target="#login"
            >
              <i className="fa fa-times"></i>
            </button>
          </div>
          <div className="modal-body">
            <form action="" method="post" name="login-form" id="login-form">
              <div className="form-group">
                <div className="input-group mb-3">
                  <input
                    type="email"
                    className="form-control form-control-sm"
                    name="login_email"
                    id="login_email"
                    placeholder="Email address"
                  />
                  <div className="input-group-append">
                    <span className="input-group-text">
                      <i className="fa fa-user"></i>
                    </span>
                  </div>
                </div>
                <div className="input-group mb-3">
                  <input
                    type="password"
                    className="form-control form-control-sm"
                    name="login_password"
                    id="login_password"
                    placeholder="Password"
                  />
                  <div className="input-group-append">
                    <span className="input-group-text">
                      <i className="fa fa-user-secret"></i>
                    </span>
                  </div>
                </div>
                <p>
                  <a href="#forgot-password">Forgot Password?</a>
                </p>
                <div className="form-group">
                  <button className="btn btn-sm btn-warning text-light">
                    <i className="fa fa-sign-in"></i> Sign in
                  </button>
                  <a href="#signup" className="pull-right">
                    Sign up
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

export default Login;
