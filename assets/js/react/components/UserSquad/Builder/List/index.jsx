import React from 'react'
import PropTypes from 'prop-types'
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
      items = items.filter(
        character => character.name.toLowerCase().indexOf(this.props.phrase) > -1 ||
        character.tags.toLowerCase().indexOf(this.props.phrase) > -1)
    }

    if (this.props.squadType === 1) {
      items = items.filter(item => item.side === 1)
    } else if (this.props.squadType === 2) {
      items = items.filter(item => item.side === 0)
    }

    return (
      <div className="row">
        {items.map(item => <Item
          key={item.id}
          active={this.props.active}
          toggleHandle={obj => this.props.toggleHandle(obj)}
          item={item}
          disabled={this.props.disabled !== undefined && item.id in this.props.disabled}
        />)}
      </div>
    )
  }
}

List.defaultProps = {
  disabled: {},
  active: [],
  characters: [],
  squadType: 0,
}

List.propTypes = {
  toggleHandle: PropTypes.func.isRequired,
  active: PropTypes.arrayOf(PropTypes.shape()),
  squadType: PropTypes.number,
  characters: PropTypes.arrayOf(PropTypes.shape()),
  phrase: PropTypes.string.isRequired,
  disabled: PropTypes.shape(),
}

export default List
