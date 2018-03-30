import React from 'react'
import { connect } from 'react-redux'
import Item from './Item'
import Container from './Container'

class Generated extends React.Component {
  render() {
    const { generated, stats: { stats } } = this.props

    return (
      <div className={'row'}>
        <Container>
          {Object.keys(generated).map((key) => {
            const secondary = stats[key] != undefined && stats[key].secondary != undefined ? this.props.mods.secondaryStats[stats[key].secondary] : this.props.secondary

            return (<Item
              className={'col-sm col.md col.lg'}
              secondary={secondary}
              mod={generated[key]}
              stats={stats[key]}
            />)
          })}
        </Container>
      </div>
    )
  }
}

const mapStateToProps = state => ({
  mods: state.mods.settings,
})

export default connect(mapStateToProps, null)(Generated)
