import React from 'react'
import PropTypes from 'prop-types'
import BoxItem from '../../Builder/List/ItemBox'
import Image from '../../Builder/List/Image'
import Name from '../../Builder/List/Name'

const Row = ({ item }) => (
  <div className="col-xs-6 col-sm-4 col-md-3 col-lg-2">
    <BoxItem diableHover>
      <Image side={item.side}><img alt={''} src={'/' + item.image} /></Image>
      <Name>{item.name}</Name>
    </BoxItem>
  </div>
    )

Row.propTypes = {
  item: PropTypes.shape({
    character: PropTypes.shape({
      id: PropTypes.number.isRequired,
      code: PropTypes.string.isRequired,
      image: PropTypes.string.isRequired,
      name: PropTypes.string.isRequired,
      side: PropTypes.number.isRequired,
    }).isRequired,
  }).isRequired,
}

export default Row
