import React from 'react'
import PropTypes from 'prop-types'
import Item from './Item'

const MiniList = props => <div className="row">
  {Object.keys(props.items).map(item => <Item item={props.items[item].character} />)}
</div>

MiniList.propTypes = {
  items: PropTypes.shape().isRequired,
}

export default MiniList
