const CheckoutNav = () =>{
    return(
        <ul class=" nav nav-pills checkout-points" role="tablist">
            <li class="nav-item checkout-point">
                <a href="#" class="nav-link done" id="auth-tab"
                data-toggle="tab" data-target="#auth"
                aria-controls="#auth" aria-selected="true">
                    <i class="fa fa-dot-circle-o"></i>
                    Auth
                </a>
            </li>
            <li class="nav-item checkout-point">
                <a class="nav-link active" href="#" id="info-tab"
                data-toggle="tab" data-target="#info"
                aria-controls="#info" aria-selected="false">
                    <i class="fa fa-dot-circle-o"></i>
                    Information
                </a>
            </li>
            <li class="nav-item checkout-point">
                <a class="nav-link " href="#" id="payment-tab"
                data-toggle="tab" data-target="#payment"
                aria-controls="#payment" aria-selected="true">
                    <i class="fa fa-dot-circle-o"></i>
                    Payment
                </a>
            </li>
            <li class="checkout-point">
                <a class="nav-link " href="#" id="complete-tab"
                data-toggle="tab" data-target="#complete"
                aria-controls="#complete" aria-selected="true">
                    <i class="fa fa-dot-circle-o"></i>
                    Complete
                </a>
                
            </li>
        </ul>
    );
}
export default CheckoutNav;