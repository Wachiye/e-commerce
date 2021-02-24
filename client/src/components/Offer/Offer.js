const Offer = ({ offer }) => {
  return (
    <div className="offer">
      <img src="./images/courier.png" alt="" />
      <div className="desc">
        <h3>FREE DELIVERY WITHIN NAKURU</h3>
        <p>
          We are offering free delivery for orders
          <span>above 5OK</span> within Nakuru
        </p>
        <div className="actions">
          <button className="btn add-to-cart">Shop Now</button>
        </div>
      </div>
    </div>
  );
};
export default Offer;
