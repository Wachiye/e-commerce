const CommentForm = () =>{
    return(
        <form action="#" name="comment-form" id="comment-form">
            <div class="form-group">
                <label for="full_name" class="required">Full Name</label>
                <input type="text" name="full_name" id="full_name" 
                class="form-control" placeholder="Full Name" />
            </div>
            <div class="form-group">
                <label for="email_address" class="required">Email Address</label>
                <input type="email" name="email_address" id="email_address" 
                class="form-control" placeholder="Email Address" />
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="email" name="phone_number" id="phone_number" 
                class="form-control" placeholder="Phone Number" />
            </div>
            <div class="form-group">
                <label for="message" class="required">Message</label>
                <textarea name="message" id="message"  rows="5"
                class="form-control" placeholder="Your Message here"></textarea>
            </div>
            <div class="form-check my-2">
                <input type="checkbox" name="add_subscriber" id="add_subscriber" 
                class="form-check-input" />
                <label for="add_subscriber" class="form-check-label">Add me to subscriber list</label>
                
            </div>
            <button type="submit" class="btn btn-dark btn-sm">
                <i class="fa fa-send"></i>
                Submit Comment
            </button>
        </form>
    );
}

export default CommentForm;