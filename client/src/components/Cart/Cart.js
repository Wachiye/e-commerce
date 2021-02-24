import CartItem from "./CartItem";

const Cart = ({ cart }) => {
    return(
        <table class="table table-bordered cart">
            <tr>
                <th>Image</th>
                <th>Details</th>
                <th>Quantity</th>
                <th>@ Price</th>
                <th>Actions</th>
            </tr>
            <CartItem />
            <tr>
                <td>
                    <button class="btn btn-sm cta-btn">
                        <i class="fa fa-cart-plus"></i>
                        Shop
                    </button>
                </td>
                <td class="total text-md-right" colspan="3">
                    Total: <span>Ksh 4, 000</span>
                </td>
                
                <td>
                    <button class="btn btn-sm btn-dark">Save Cart</button>
                    <button class="btn btn-sm cta-btn">Checkout Now</button>
                </td>
            </tr>
        </table>
    );
}

export default Cart;