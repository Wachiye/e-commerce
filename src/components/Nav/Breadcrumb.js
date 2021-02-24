const Breadcrumb = ({ routes }) => {
  return (
    <div className="container-fluid">
      <div className="row">
        <div className="col-12">
          <nav className="breadcrumb">
            <a href="#route1" className="breadcrumb-item">
              Home
            </a>
            <a href="#router2" className="breadcrumb-item active">
              About Us
            </a>
          </nav>
        </div>
      </div>
    </div>
  );
};
export default Breadcrumb;
