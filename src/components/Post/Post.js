const Post = ({ post}) => {
    return(
        <div class="post">
            <div class="image">
                <img src="./images/products/t_shirts/white.png" alt="" />
                <h2 class="title">Title of blog here</h2>
            </div>
            <div class="meta-data">
                <p class="excerpt">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate neque maiores magni odit dolores saepe nobis officiis, reiciendis consequuntur quos assumenda ipsum quia in aliquid. Id placeat, tempore deleniti aperiam esse ad, excepturi, numquam dicta velit tenetur nostrum sed praesentium.
                </p>
            </div>
            <div class="tags">
                <ul class="list-inline">
                    <li class="list-inline-item tag">
                        <a href="#">
                            tag 1
                        </a>
                    </li>
                    <li class="list-inline-item tag">
                        <a href="#">
                            tag 2
                        </a>
                    </li>
                    <li class="list-inline-item tag">
                        <a href="#">
                            tag 3
                        </a>
                    </li>
                </ul>
            </div>
            <hr />
            <div class="content">
                <article>
                    <h2>Some header here</h2>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maxime, ducimus, dolorem dolor fugit error temporibus accusantium eum molestias sunt esse enim consectetur ratione beatae repellat vitae nobis cupiditate natus blanditiis!
                    </p>
                </article>
            </div>
        </div>
    )
}

export default Post;