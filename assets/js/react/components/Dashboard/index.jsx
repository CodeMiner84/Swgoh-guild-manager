import React from 'react'
import { createSelector } from 'reselect'
import YouTube  from 'react-youtube'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import { connect } from 'react-redux'
import characterActions from '../../actions/character'
import List from './components/List'

class Dashboard extends React.Component {
  render() {
    const opts = {
      height: '200',
      width: '320',
      playerVars: {
        autoplay: 0,
      },
    };

    return (
      <div>
        <List>
          <li>
            <b>Why do I need to register ?</b><br/>
            Registration allow you to connect with swgoh.gg profile and have your own data.
          </li>
          <li>
            <b>My e-mail address is using for some marketing stuff ?</b><br/>
            No, e-mail is used only for registration process. No newsletter will be send, no third party company has access to it. Your email is safe and it's private.
          </li>
          <li>
            <b>Where my data comes from ?</b><br/>
            All data is fetched from http://swgoh.gg, and if your profile needs to be public. If not - then your data won't fetch.
          </li>
          <li>
            <b>Where can I connect my profile with swgoh.gg ?</b><br/>
            <Link to={'/account'}>Here</Link> you can link your profile. <br/>
            Just type Your swgoh.gg account name
          </li>
          <li>
            <b>What do I need to link my profile ?</b><br/>
            You only need to know your nickname from this path: https://swgoh.gg/u/YOUR_USERNAME<br/>
            Important note: nickname from swgoh.com and in game nick might be different. This nickname is taken from swgoh.gg, and not from game !
          </li>
          <li>
            <b>How can I sync my data ?</b><br/>
            Once You type Your nickname You need to synchronize data. In account page click on red button Synchronize data <Link to={'/account'}>Here</Link>. After click data will be fetch more or less in few minutes.
          </li>
          <li>
            <b>How can I fetch my mods ?</b><br/>
            Mods module is <Link to={'/mods'}>HERE</Link>. You can also synchronize your mods, similar to account page.
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
            <b>I wan't to set up mods for my B squad. How to do this ?</b>
            If You set up mods for Your main squad You can exclude few characters from mod generator.<br/>
            This option will fetch mods except mods from selected characters.
          </li>
          <li>
            <b>What will happend when I generate mods without setting anything except globall secondary stat ?</b><br/>
            System find the best mods for you. But only secondary / primary stats. The percentage boost from mode isn't calculated.
          </li>
          <li>
            <b>User squad - whats for ?</b><br/>
            You can group your squads per TB / TW / Sith raid or whatever. Each group can have their own squads, but one toon can be set once in each group.<br/>
            If you have wide squad and sometime you add one toon to few squads and then need to edit and check what toon is in used than this will help you to manage this. <br/>
            You can set as many squads you want, and then you can easily set up your rooster in game.
          </li>
          {/*<li>*/}
            {/*<b>Guild squad - whats for ?</b><br/>*/}
            {/*You can use it in many ways. Guild leader can manage squad for territory battles between guilds. After you set up squad for example Nighsisters you can check how many ppl in guild have this squad. <br/>*/}
            {/*This is usefull also for Sith raid when you need to check how many JTR squad did your guild have ...*/}
          {/*</li>*/}
          {/*<li>*/}
            {/*<b>Guild squad - full squad option - what is it ?</b><br/>*/}
            {/*Sometimes you need squad that can be build from more that 5 toons. At the begining of the game there was only 5 resistance character and you can't match other toon for this squad. Now there is a lot more and by checking this full squad option and you will set up squad with more than 5 toons, than in your <Link to={'/guild'}>guild module</Link> you will see the 5 best toons of this squad in each guild member. <br/>*/}
            {/*<br/><YouTube*/}
            {/*videoId="rlo3IEz5lBQ"*/}
            {/*opts={opts}*/}
          {/*/>*/}
          {/*</li>*/}
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
