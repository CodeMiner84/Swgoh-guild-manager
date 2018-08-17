import React from 'react'
import FontAwesome from 'react-fontawesome'
import PropTypes from 'prop-types'
import Box from './Box'
import Image from './Box/Image'
import Name from './Box/Name'
import Details from './Box/Details'
import DetailItem from './Box/DetailItem'
import StarIcon from './Box/StarIcon'
import GearIcon from './Box/GearIcon'

const Toon = ({ toon: { gear, level, stars, character } }) => (
  <div className="col-xs-6 col-sm-3 col-md-2">
    <Box>
      <Image side={character.side}>
        <img src={'/' + character.image} alt="" />
      </Image>
      <Details>
        <DetailItem title={`Level: ${level}`}>
          <FontAwesome name="level-up" /> {level}
        </DetailItem>
        <DetailItem title={`${stars} stars`}>
          {stars} <StarIcon name="star" />
        </DetailItem>
        <DetailItem title={`Gear: ${gear}`}>
          <GearIcon name="cog" className={`gear${gear}`} /> {gear}
        </DetailItem>
      </Details>
      <Name>{character.name}</Name>
    </Box>
  </div>
  )

Toon.propTypes = {
  toon: PropTypes.shape({
    gear: PropTypes.number.isRequired,
    level: PropTypes.number.isRequired,
    star: PropTypes.number.isRequired,
    character: PropTypes.number.isRequired,
  }).isRequired,
}

export default Toon
