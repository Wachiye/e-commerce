const ContactForm = () => {
    return(
        <form action="#" name="contact-form" id="contact-form">
            <div class="form-group">
                <p class="form-text">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis laborum aliquid ipsam laboriosam laudantium exercitationem.
                </p>
            </div>
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" name="name" id="name" class="form-control"
                placeholder="Your Name" />
            </div>
            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" name="email" id="email" class="form-control"
                placeholder="Your Email Address" />
            </div>
            <div class="form-group">
                <label for="phone">Your Phone</label>
                <input type="tel" name="phone" id="phone" class="form-control"
                placeholder="Your Phone Number" />
                <p class="form-text small text-info">Input form 2547xxxxxxxx</p>
            </div>
            <div class="form-group">
                <label for="reason">Reason for Contacting Us</label>
                <input type="text" name="reason" id="reason" class="form-control"
                placeholder="Reason for Contacting Us" />
            </div>
            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea name="message" id="message" class="form-control"
                placeholder="Your Message" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-dark btn-sm">Send Message</button>
        </form>
    )
}

export default ContactForm;