import React from 'react';
import Box from './Box';
import Image from './Box/Image';
import Name from './Box/Name';
import Details from './Box/Details';
import DetailItem from './Box/DetailItem';
import StarIcon from './Box/StarIcon';
import GearIcon from './Box/GearIcon';
import ImageContainer from './Box/GearIcon';
import FontAwesome from 'react-fontawesome';

const Toon = ({ toon: {gear, level, stars, character} }) => {

  return (
    <div className="col-xs-6 col-sm-3 col-md-2">
      <Box >
        <Image>
          <img src={character.image} alt="" />
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
  );
};

export default Toon;
