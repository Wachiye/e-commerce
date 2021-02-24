const Subscribe = ({ title, text }) => {
  return (
    <div className="subscribe">
      <h2>{title}</h2>
      <p>{text}</p>
      <form
        className="form-inline"
        action="#"
        method="post"
        id="subscribe-form"
        name="subscribe-form"
      >
        <input
          type="text"
          name="sub_username"
          id="sub_username"
          className="form-control my-1"
          placeholder="Username"
        />
        <input
          type="email"
          name="sub_email"
          id="sub_email"
          className="form-control my-1"
          placeholder="Email"
        />
        <button
          className="btn cta-btn"
          type="submit"
          name="subscribe"
          value="subscribe"
        >
          <i className="fa fa-heart"></i> Subscribe
        </button>
      </form>
    </div>
  );
};
export default Subscribe;
