import React from 'react'
import Item from './Item'
import Container from './Container'

class Generated extends React.Component {
  render() {
    const mods = this.props.mods

    return (
      <div className={'row'}>
        <Container>
          {Object.keys(mods).map(key => <Item className={'col-sm col.md col.lg'} secondary={this.props.secondary} mod={mods[key]} />)}
        </Container>
      </div>
    )
  }
}

export default Generated
