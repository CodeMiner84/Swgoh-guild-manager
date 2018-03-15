import React from 'react'
import ImageContainer from './ImageContainer'
import CharacterImageContainer from './CharacterImageContainer'
import Container from './Container'
import StatsContainer from './StatsContainer'
import Stat from './Stat'

class Item extends React.Component {
  render() {
    const mod = this.props.mod
    if (mod === null) {
      return <Container></Container>
    }

    return (
      <Container>
        <ImageContainer>
          <img src={`/img/mods/${mod.image}`} />
          <CharacterImageContainer>
            <img src={mod.character.image} />
          </CharacterImageContainer>
        </ImageContainer>
        <StatsContainer >
          {mod.stats.length > 0 &&
            Object.keys(mod.stats).map(key => <Stat active={this.props.secondary == mod.stats[key].name && !mod.stats[key].type} kind={mod.stats[key].kind}>{mod.stats[key].name} +{mod.stats[key].value}</Stat>)}
        </StatsContainer>
      </Container>
    )
  }
}

export default Item
