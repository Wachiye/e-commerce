const CartItem = ({ item }) => {
    return(
        <tr>
            <td class="image-col">
                <div class="w-100 h-100">
                    <img src="./images/products/electronics/laptop_notebook_2.png" alt="" />
                </div>
            </td>
            <td class="details-col">
                <a href="#">Sumsang Laptop Notebook 340PcDU</a>
                <p class="stock small"><span>23</span> items in stock</p>
                <p class="small price-list">
                    <span class="price has-discount">Ksh 49, 000</span>
                </p>
            </td>
            <td class="size-col">
                <div class="input-group">
                    <div class="input-group-preppend">
                        <button class="btn btn-sm">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control form-control-sm" value="0" />
                    <div class="input-group-preppend">
                        <button class="btn btn-sm">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </td>
            <td class="price-col">4000</td>
            <td class="action-col">
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary">
                        View
                    </button>
                    <button class="btn btn-sm btn-secondary" title="Save Item for Later">
                        <i class="fa fa-save"></i>
                    </button>
                    <button class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
                                
    )
}
export default CartItem;