const Testimonial = ({ testimonial }) => {
  return (
    <div className="testimonial">
      <div className="testimonial-user">
        <h4 className="name">Person xyz </h4>
      </div>
      <div className="testimonial-body">
        <div className="message">
          <blockquote className="blockquote">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis
            ex consectetur tempora maiores ducimus cumque perferendis iure
            commodi, debitis aspernatur est, magnam adipisci repudiandae
            repellat harum quos deserunt officia odio.
            <div className="blockquote-footer">
              <ul className="list-inline">
                <li className="list-inline-item">
                  <i className="fa fa-envelope"></i>
                  siranjofuw@gmail.com
                </li>
                <li className="list-inline-item">
                  <i className="fa fa-phone"></i>
                  +254790983123
                </li>
              </ul>
            </div>
          </blockquote>
        </div>
      </div>
    </div>
  );
};

export default Testimonial;
