import React,  { Component} from 'react';
import CheckoutNav from '../components/Nav/CheckoutNav';
export default class CheckoutPage extends Component{
    render(){
        return(
            <main class="checkout-main" id="main">
                <div class="container">
                    <div class="row">
                        <div class="col-12 py-1">
                            <div class="checkout-card">
                                <CheckoutNav />
                            </div>
                            <div id="checkout-panel" class="card tab-content">
                                <div class="tab-panel fade " id="auth" role="tabpanel"
                                aria-labelledby="auth-tab">
                                    Auth
                                </div>
                                <div class="tab-panel fade show active" id="info" role="tabpanel"
                                aria-labelledby="info-tab">
                                    Info
                                </div>
                                <div class="tab-panel fade" id="payment" role="tabpanel"
                                aria-labelledby="payment-tab">
                                    Payment
                                </div>
                                <div class="tab-panel fade" id="complete" role="tabpanel"
                                aria-labelledby="complete-tab">
                                    Complete
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </main>
        )
    }
}