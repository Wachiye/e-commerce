import React, { Component} from 'react';
import Subscribe from '../components/Auth/Subscribe';
import Category from '../components/Category/Category';
import Breadcrumb from '../components/Nav/Breadcrumb';
import Post from '../components/Post/Post';
import PostListItem from '../components/Post/PostListItem';

export default class BlogPage extends Component{
    render(){
        return(
            <main className="blog-main" id="main">
                <Breadcrumb />
                <h1 class="section title text-center">Our Recent Blog Posts</h1>
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-12 blog-list">
                            <PostListItem />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 mb-2">
                            <div class="card bg-transparent shadow-none ">
                                <h5 class="card-header">Categories</h5>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <Category type="post" />
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="card bg-transparent shadow-none ">
                                <h5 class="card-header">Subscribe</h5>
                                <div class="card-body">
                                    <Subscribe />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="card bg-transparent border-info shadow-none">
                                <h5 class="card-header">Request Authorship</h5>
                                <div class="card-body">
                                    <p class="card-text">
                                        Are you interested in writing on our blog? <br />
                                        Please fill free to contact us through our email.
                                        Attach your previous work done or any relevant sample work
                                    </p>
                                    <a href="mailto:#">emailhere@domain.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        )
    }
}