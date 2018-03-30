import React from 'react'

const Filtering = () => (
  <div className={'filtering'}>
    <span>Filter:</span>
    <input
      className="form-control form-control-dark w-100" type="text" onChange={this.props.handleFiltering}
      placeholder="Search" aria-label="Search"
    />
  </div>
)

export default Filtering
