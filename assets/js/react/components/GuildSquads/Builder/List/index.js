import React from 'react'
import PropTypes from 'prop-types'
import { createSelector } from 'reselect'
import Item from './Item'

class List extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      active: false,
    }
  }

  render() {
    if (this.props.characters.length === 0) {
      return (<div className={'alert alert-danger mb-0'}>No data</div>)
    }

    let items = this.props.characters
    if (this.props.phrase !== '') {
      items = items.filter(character => character.name.toLowerCase().indexOf(this.props.phrase) > -1 ||
        character.tags.toLowerCase().indexOf(this.props.phrase) > -1)
    }

    return (
      <div className="row">
        {items.map(item => <Item
          key={item.code}
          active={this.props.active}
          toggleHandle={item => this.props.toggleHandle(item)}
          item={item}
        />)}
      </div>
    )
  }
}

List.defaultProps = {

}

List.propTypes = {
  toggleHandle: PropTypes.func.isRequired,
  item: PropTypes.shape.isRequired,
  active: PropTypes.shape.isRequired,
  characters: PropTypes.shape.isRequired,
  phrase: PropTypes.string.isRequired,
  disabledHover: PropTypes.string.isRequired,
}

export default List
