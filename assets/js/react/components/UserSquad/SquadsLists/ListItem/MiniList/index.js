import React from 'react'
import Item from './Item'

const MiniList = props => <div className="row">
  {Object.keys(props.items).map(item => <Item item={props.items[item].character} />)}
</div>

export default MiniList
