const PostListItem = ({ post}) =>{
    return(
        <div class="blog-item">
            <div class="image">
                <img src="./images/bg-comps.png" alt="" />
                <a href="./post.html?slug=title-of-blog-here-2021-02-19-12-25-35">
                    <i class="fa fa-2x fa-angle-right"></i>
                </a>
            </div>
            <div class="blog-item-body">
                <h2 class="title">Title of blog here</h2>
            </div>
        </div>
    );
}

export default PostListItem;