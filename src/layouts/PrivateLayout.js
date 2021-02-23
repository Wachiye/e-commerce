import React from "react";

import "../css/admin.css";

import AdminNav from "../components/Nav/AdminNav";

const PrivateLayout = ({ children }) => {
  return (
    <>
      <AdminNav />
      <>{children}</>
    </>
  );
};

export default PrivateLayout;
