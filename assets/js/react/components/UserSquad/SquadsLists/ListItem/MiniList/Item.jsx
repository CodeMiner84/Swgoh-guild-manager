import React from 'react'
import PropTypes from 'prop-types'
import BoxItem from './ItemBox'
import Name from './Name'
import Image from './Image'

const Item = ({ item }) => (
  <div className="col-xs-6 col-sm-4 col-md-3 col-lg-2" >
    <BoxItem>
      <Image side={item.side}><img alt={''} src={item.image} /></Image>
      <Name>{item.name}</Name>
    </BoxItem>
  </div>
  )

Item.propTypes = {
  item: PropTypes.shape().isRequired,
}

export default Item
