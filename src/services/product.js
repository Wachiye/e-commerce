import http from "./common-http";

class Product {
  //get all products
  async getAll() {
    let data;
    await http.get("product/read.php").then((res) => {
      data = res.data;
    });
    return data;
  }
}

export default new Product();
