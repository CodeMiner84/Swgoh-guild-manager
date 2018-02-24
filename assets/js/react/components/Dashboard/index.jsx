import React from 'react'
import { createSelector } from 'reselect'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import characterActions from '../../actions/character'

class Dashboard extends React.Component {
  constructor(props) {
    super(props)

    this.props.getCharacters()
  }

  render() {
    return (
      <div >DASHBOARD</div>
    )
  }

}

const getUserCharacters = state => state.character.characters

const selector = createSelector(
  getUserCharacters,
  characters => characters,
)

function mapStateToProps(state) {
  return {
    characters: selector(state),
  }
}

const mapDispatchToProps = {
  getCharacters: characterActions.fetchCharacters,
}

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard)
