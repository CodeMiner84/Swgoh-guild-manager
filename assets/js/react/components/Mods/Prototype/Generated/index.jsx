import React from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import Item from './Item'
import Container from './Container'

const Generated = (props) => {
  const { generated, stats: { stats } } = props

  return (
    <div className={'row'}>
      <Container>
        {Object.keys(generated).map((key) => {
          const secondary =
            stats[key] !== undefined &&
            stats[key].secondary !== undefined ?
              this.props.mods.secondaryStats[stats[key].secondary] :
              this.props.secondary

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

const mapStateToProps = state => ({
  mods: state.mods.settings,
})

Generated.propTypes = {
  mods: PropTypes.shape.isRequired,
  stats: PropTypes.shape.isRequired,
  generated: PropTypes.shape.isRequired,
  secondary: PropTypes.number.isRequired,
}

export default connect(mapStateToProps, null)(Generated)
