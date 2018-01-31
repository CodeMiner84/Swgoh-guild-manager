import React from 'react'

export default class RowItem extends React.Component {

  render() {
    return (
      <tr>
        <td>{this.props.item.title}</td>
      </tr>
    )
  }

}
