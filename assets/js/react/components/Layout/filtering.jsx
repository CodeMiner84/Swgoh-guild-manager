import React from 'react'
import PropTypes from 'prop-types'

const Filtering = (props) => (
  <div className={'filtering'}>
    <span>Filter:</span>
    <input
      className="form-control form-control-dark w-100" type="text" onChange={props.handleFiltering}
      placeholder="Search" aria-label="Search"
    />
  </div>
)

Filtering.propTypes = {
  handleFiltering: PropTypes.func.isRequired,
}

export default Filtering
