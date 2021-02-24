const Pagination = ({ pages }) => {
  return (
    <ul className="pagination">
      <li className="page-item active">
        <a href="?page=1" className="page-link ">
          1
        </a>
      </li>
      <li className="page-item">
        <a href="?page=2" className="page-link">
          2
        </a>
      </li>
      <li className="page-item">
        <a href="?page=3" className="page-link">
          3
        </a>
      </li>
      <li className="page-item">
        <a href="?page=4" className="page-link">
          4
        </a>
      </li>
      <li className="page-item">
        <a href="?page=5" className="page-link">
          5
        </a>
      </li>
    </ul>
  );
};

export default Pagination;
