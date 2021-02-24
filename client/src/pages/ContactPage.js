import React, { Component } from "react";
import ContactForm from "../components/Contact/ContactForm";
import ContactList from "../components/Contact/ContactList";
import Breadcrumb from "../components/Nav/Breadcrumb";

export default class ContactPage extends Component{
    render(){
        return(
            <main className="contact-main" id="main">
                <Breadcrumb />
                <h1 class="section title text-center">Contact Us</h1>
                <div class="container">
                    <div class="row shadow p-2">
                        <div class="col-md-8">
                            <ContactForm />
                        </div>
                        <div className="col-md-4">
                            <ContactList with_map="true"/>
                        </div>
                    </div>
                /</div>
            </main>
        )
    }
}