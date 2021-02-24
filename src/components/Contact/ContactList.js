const ContactList = ({ contacts, with_map }) =>{
    return(
        <div class="card bg-transparent border-0 shadow-none">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        Phone: <span class="pull-right"> +254790983123</span>
                    </li>
                    <li class="list-group-item">
                        Email: <span class="pull-right"> siranjofuw@gmail.com</span>
                    </li>
                    <li class="list-group-item">
                        Help Line: <span class="pull-right"> +254790983123</span>
                    </li>
                    <li class="list-group-item">
                        Address: <span class="pull-right"> Nakuru 536, Kenya</span>
                    </li>
                    {with_map && 
                    <li class="list-group-item">
                        <p class="text-center">
                            <i class="fa fa-map-marker fa-2x"></i>
                        </p>
                        <div id="map"></div>
                    </li>
                    }
                </ul>
            </div>
        </div>
    );
}

export default ContactList;