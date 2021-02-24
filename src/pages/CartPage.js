import React, { Component } from 'react';
import Cart from '../components/Cart/Cart';
import Products from '../components/Product/Products';
export default class CartPage extends Component{
    render(){
        return(
            <main className="cart-main" id="main">
                <div class="container">
                    <div class="row my-2">
                        <div class="col-12">
                            <div class="card cart-card">
                                <div class="card-header">
                                    <div class="pull-left">Your Cart Items</div>
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button class="btn btn-primary btn-sm">
                                                Add More
                                            </button>
                                            <button class="btn  btn-secondary btn-sm">
                                                Empty Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <Cart />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container my-2">
                        <h3 class="text-center">The Top 4 Most Purchased Products That Might Surprise You</h3>
                        <p class="lead text-center">83% of customers have added one of these items on their carts</p>
                    </div>
                    <Products /> 
                </div>
            </main>
        );
        
    }
}
