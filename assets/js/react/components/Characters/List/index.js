import React from 'react'
import Item from './Item'

class List extends React.Component {
  render() {
    if (this.props.characters.length === 0) {
      return (<div />)
    }

    let items = this.props.characters
    if (this.props.phrase !== '') {
      items = items.filter(character => character.name.toLowerCase().indexOf(this.props.phrase) > -1)
    }

    return (
      <div className="row">
        {items.map(item => <Item key={item.code} item={item} />)}
      </div>
    )
  }
}

export default List
