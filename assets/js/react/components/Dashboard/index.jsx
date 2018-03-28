import React from 'react'
import { createSelector } from 'reselect'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import { connect } from 'react-redux'
import characterActions from '../../actions/character'
import List from './components/List'

class Dashboard extends React.Component {
  render() {
    return (
      <div>
        <List>
          <li>
            <b>Where my data comes from ?</b><br/>
            All data is fetched from http://swgoh.gg, and if your profile needs to be public. If not - then your data won't fetch.
          </li>
          <li>
            <b>Where can I connect my from with swgoh.gg ?</b><br/>
            <Link to={'/account'}>Here</Link> you can link your profile
          </li>
          <li>
            <b>What do I need to link my profile ?</b><br/>
            You only need to know your nickname from this path: https://swgoh.gg/u/YOUR_USERNAME
          </li>
          <li>
            <b>What do I need to link my guild ?</b><br/>
            You need both guild ID and guild ALIAS, also from swgoh.gg from pattern https://swgoh.gg/g/GUILD_ID/GUILD_ALIAS/
          </li>
          <li>
            <b>How can I sync my data ?</b><br/>
            One you type your nickname your data is synchronize in background after user click on red button Synchronize data <Link to={'/account'}>Here</Link>. After click data will be fetch more or less in few minutes.
          </li>
          <li>
            <b>How can I fetch my mods ?</b><br/>
            Mods module is <Link to={'/mods'}>HERE</Link>. You can also synchronize your mods the same like account.
          </li>
          <li>
            <b>How can I suits the best mods ?</b><br/>
            After your mods are synchronized you need to add mod template.<br/>
            Then you can set up each mod type (Potency, Health etc) in each six slots. Each slot coresponding to the same position in game.<br/>
            After click on spot you see a modal where you can set up type, primary or secondary stats for each slot. <br/>
            If you don't set up primary and secondary stats for each slot separately you can do this globally for template by selecting one of available value in primary and secondary select placed next to mod template.
            When your template are done - hit SAVE & GENERATE button. System will automatically suits the best mods acording to selected stats.
          </li>
          <li>
            <b>What will happend when I generate mods without setting anything except globall secondary stat ?</b><br/>
            System find the best mods for you. But only secondary / priamry stats. The percentage boost from mode isn't calculated.
          </li>
          <li>
            <b>Is percentage stats of mods are calculating ?</b><br/>
            No only primary / secondary stats are matter. For example system don't see difference in speed betwen 4 healt and 4 speed mods.
          </li>
        </List>
      </div>
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

Dashboard.propTypes = {
  getCharacters: PropTypes.func.isRequired,
};

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard)
