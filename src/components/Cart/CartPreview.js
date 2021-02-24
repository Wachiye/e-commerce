export default function CartPreview(){
  return(
      <div id="cart-preview" className="d-none">
          <div className="card bg-light shadow rounded-top">
              <div className="card-header">
                  <h5 className="pull-left">
                      <span>1</span> Items in cart</h5>
                  <button className="btn add-to-cart btn-sm pull-right">Continue Shopping</button>
              </div>
              <div className="card-body">
                  <table className="table table-bordered table-sm">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Image</th>
                              <th>Name</th>
                              <th>Price(Ksh)</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>1</td>
                              <td>
                                  <img src="./images/products/t_shirts/black.png" alt=""
                                  width="35" height="35" />
                              </td>
                              <td>A black T-shirt</td>
                              <td>800</td>
                          </tr>
                          <tr>
                              <td>1</td>
                              <td>
                                  <img src="./images/products/t_shirts/black.png" alt=""
                                  width="35" height="35" />
                              </td>
                              <td>A black T-shirt</td>
                              <td>800</td>
                          </tr>
                          <tr>
                              <td>1</td>
                              <td>
                                  <img src="./images/products/t_shirts/black.png" alt=""
                                  width="35" height="35" />
                              </td>
                              <td>A black T-shirt</td>
                              <td>800</td>
                          </tr>
                      </tbody>
                      <tfoot>
                          <tr>
                              <th>Total Price</th>
                              <td colSpan="3" className="text-right">2400</td>
                          </tr>
                          <tr>
                              <th>Total Taxes</th>
                              <td colSpan="3" className="text-right">100</td>
                          </tr>
                          <tr>
                              <th>Total Cost</th>
                              <td colSpan="3" className="text-right">2500</td>
                          </tr>
                      </tfoot>
                  </table>
              </div>
              <div className="cart-footer p-2">
                  <button className="btn btn-block btn-primary">View Cart</button>
              </div>
          </div>
      </div>
  );
}