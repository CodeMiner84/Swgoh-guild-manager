import React from 'react'
import PropTypes from 'prop-types'
import Item from './Item'

const MiniList = props => <div className="row">
  {Object.keys(props.items).map(item => <Item key={props.items[item].id} item={props.items[item].character} />)}
</div>


MiniList.propTypes = {
  items: PropTypes.array.isRequired,
}

export default MiniList
