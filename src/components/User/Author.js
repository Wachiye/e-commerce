const Author = ({ author}) =>{
    return (
        <div class="author">
            <img src="./images/user.png" alt="" width="70" height="70" />
            <div class="author-info">
                <h5 class="name">Wachiye Jeremiah Siranjofu</h5>
                <h6 class="title">Web Developer & Software Engineer</h6>
                <p class="bio">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe mollitia architecto repellat incidunt odit maiores beatae necessitatibus dicta, reprehenderit deleniti.
                </p>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="mailto:#">
                            <i class="fa fa-envelope"></i>
                            siranjofuw@gmail.com
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fa fa-phone"></i>
                            0790983123
                        </a>
                    </li>
                    </ul>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fa fa-github"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    );
}

export default Author;