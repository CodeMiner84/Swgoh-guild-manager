import React from 'react'

export default class Filtering extends React.Component {

  render() {
    return (
      <div className={'filtering'}>
        <span>Filter:</span>
        <input
          className="form-control form-control-dark w-100" type="text" onChange={this.props.handleFiltering}
          placeholder="Search" aria-label="Search"
        />
      </div>
    )
  }

}
