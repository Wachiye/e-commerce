import React , { Component} from 'react';
import CommentForm from '../components/Comment/CommentForm';
import Testimonial from '../components/Comment/Testimonial';
import Breadcrumb from '../components/Nav/Breadcrumb';
import Post from '../components/Post/Post';
import Author from '../components/User/Author';
import Category from '../components/Category/Category';
import Subscribe from '../components/Auth/Subscribe';
export default class PostPage extends Component{
    render(){
        return(
            <main class="blog-main" id="main">
                <Breadcrumb />
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 blog-post">
                            <Post />
                            <Author />
                            <div id="comment-list" class="comment-list py-2">
                                <p class="lead">The End. Thanks For Reading</p>
                                <div class="comments">
                                    <Testimonial />
                                </div>
                                <button class="btn btn-sm btn-outline-dark">
                                    <i class="fa fa-2x fa-angle-up"></i>
                                    View Comments
                                </button>
                            </div>
                            <div class="comment-cta my-2">
                                <h5>Let's hear from you. Please leave a comment</h5>
                                <CommentForm />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="well">
                                <div class="card bg-transparent shadow-none mb-2">
                                    <h5 class="card-header">Categories</h5>
                                    <div class="card-body">
                                        <ul className="list-group list-group-flush">
                                            <Category type="post"/>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card bg-transparent shadow-none mb-2">
                                    <h5 class="card-header">Subscribe</h5>
                                    <div class="card-body">
                                        <Subscribe />
                                    </div>
                                </div>
                                <div class="card bg-transparent shadow-none mb-2">
                                    <div class="card-body">
                                        <h4 class="card-title">Other Related Posts</h4>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <h5>Title of a post here</h5>
                                                <a href="#">Read</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        )
    }
} 