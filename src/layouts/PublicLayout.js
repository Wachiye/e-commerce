import React from "react";

import "../css/style.css";

import Header from "../components/Header/Header";
import Footer from "../components/Footer/Footer";

const PublicLayout = ({ children }) => {
  return (
    <>
      <Header site_info={{ name: "Home" }} />
      <>{children}</>
      <Footer />
    </>
  );
};

export default PublicLayout;
