import React from 'react'
import { Link } from 'react-router-dom'

export default [{
  Header: 'Uuid',
  accessor: 'uuid',
}, {
  Header: 'Name',
  accessor: 'name',
  Cell: row =>
    (
      <Link to={`/user/${row.original.uuid}`}>{row.value}</Link>
    ),
}]

