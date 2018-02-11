import React from 'react';
import { Link } from 'react-router-dom';

export default [{
  Header: 'Code',
  accessor: 'code',
}, {
  Header: 'Name',
  accessor: 'name',
  Cell: row =>
    (
      <Link to={`/users/${row.original.code}`}>{row.value}</Link>
    ),
}];
