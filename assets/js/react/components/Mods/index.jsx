import React from 'react'
import uuid from 'uuid'
import { confirmAlert } from 'react-confirm-alert'
import ReactTimeout from 'react-timeout'
import { connect } from 'react-redux'
import { Link } from 'react-router-dom'
import { createSelector } from 'reselect'
import Prototype from './Prototype'
import actions from '../../actions/mods'
import userActions from '../../actions/account'
import Loader from '../Loader/index'
import Buttons from './Prototype/components/Buttons'
import SaveButton from './Prototype/components/SaveButton'
import Tip from './Prototype/components/Tip'
import Exclude from './components/Exclude'

class Mods extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      stats: [],
    }

    this.protRef = null
    this.number = 0
    this.excludedToons= {}
  }

  componentDidMount() {
    this.props.getModsSettings()
    this.props.fetchUserCharacter()
    this.props.getMods().then((response) => {
      if (this.props.mods) {
        const mods = this.props.mods.mods
        this.setState({
          stats: this.props.mods.mods,
        })
      }
    })
  }

  handleUpdateMod = (number, state) => {
    const updatedStats = this.state.stats
    const stats = this.state.stats
    updatedStats[number] = state
    this.setState({
      stats: updatedStats,
    })

  }

  addPrototype = (key, map) => {
    const number = map !== undefined ? map.uuid : uuid.v4()

    const stats = this.state.stats
    stats[number] = {
      modNumber: 0,
      stats: {},
      primary: null,
      secondary: null,
    }

    this.setState({
      stats,
    })
  }

  removePrototype = (index) => {
    const stats = this.state.stats
    let iter = 0
    const newStats = []

    Object.keys(stats).map((key) => {
      if (key !== index) {
        newStats[key] = this.state.stats[key]
      }
      iter++
    })
    this.setState({
      stats: {},
    })

    this.props.setTimeout(() => {
      this.setState({
        stats: newStats,
      })
    }, 10)
    this.props.saveMods(newStats)
  }

  getStats(stats = null) {
    const params = []
    let maps = []
    if (!stats) {
      maps = this.state.stats
    } else {
      maps = stats
    }
    Object.keys(maps).map(key => params[maps[key].uuid || key] = {
      uuid: maps[key].uuid || key,
      stats: maps[key].stats,
      primary: maps[key].primary,
      secondary: maps[key].secondary,
    })

    return params
  }

  generate = () => {
    this.props.saveMods(this.getStats(), this.excludedToons).then(() => this.props.generate())
  }

  synchronizeMods = () => {
    this.props.synchronizeMods().then((response) => {
      if (response.payload.code === 200) {
        this.syncAlert(true)
      } else {
        this.syncAlert(false)
      }
    }, this)
  }

  excludeCharacters = (excludedToons) => {
    this.excludedToons = excludedToons
  }

  syncAlert = (success) => {
    confirmAlert({
      message: success ? 'Your mods will be fetched' : 'Your request is added to queue. Please wait',
      cancelLabel: 'OK',
    })
  }

  render() {
    if (this.props.isLoading) {
      return <Loader />
    }

    return (
      <div >
        {this.state.stats !== undefined && Object.keys(this.state.stats).length > 0 &&
        <div className="row">
          <Tip>
            <div className={'badge badge-light'}>TIP</div>
            Your account on swgoh.gg need to be sync if you want to synchronize mods in swogh-manager.
          </Tip>
          <Exclude characters={this.props.userCharacters} excluded={this.props.mods.excluded_characters}
                   excludeCharacters={this.excludeCharacters}/>
          <div className="col-12">
            <button className={'btn btn-info mr-20'} onClick={this.addPrototype}>+ Add mod template</button>
            <button className={'btn btn-danger pull-right'} onClick={this.synchronizeMods}>Synchronize mods</button>
          </div>
          <div className="col-12">
            <Buttons>
              <SaveButton className={'btn btn-success'} onClick={this.generate}>Save & Generate</SaveButton>
            </Buttons>
            {Object.keys(this.state.stats).map(number =>
              <Prototype
                templates={this.state.stats}
                handleUpdateMod={this.handleUpdateMod}
                data={this.state.stats[number]}
                removePrototype={this.removePrototype}
                generated={this.props.generated ? this.props.generated[number] : {}}
                number={number}
              />,
            )}
          </div>
        </div>
        }
        {!(this.state.stats !== undefined && Object.keys(this.state.stats).length > 0) &&
          <div className="alert alert-warning">
            You need to synchronize Your account to use this feature. <Link to={'/account'}>here</Link>
          </div>
        }
      </div>
    )
  }
}

const getModsSettings = () => state => state.mods.settings
const getUserMods = () => state => state.mods.mods
const getGeneratedMods = () => state => state.mods.generated
const getChars = () => state => state.account.userCharacters

const selector = createSelector(
  [getModsSettings(), getUserMods(), getGeneratedMods()],
  (settings, modData, generated) => {
    if (modData === undefined) {
      modData = {
        mods: {},
        excluded_characters: {},
      }
    }
    return {
      settings, mods: modData.mods, generated, excluded_characters: modData.excluded_characters
    }
  },
)

const characterSelector = createSelector(
  [getChars()],
  userCharacters => ({
    userCharacters,
  }),
)

function mapStateToProps(state) {
  return {
    mods: selector(state),
    userCharacters: characterSelector(state).userCharacters,
  }
}

const mapDispatchToProps = {
  getModsSettings: actions.getSettings,
  saveMods: actions.saveMods,
  getMods: actions.getMods,
  generate: actions.generate,
  synchronizeMods: actions.synchronizeMods,
  fetchUserCharacter: userActions.fetchPersonalCollection,
}

export default connect(mapStateToProps, mapDispatchToProps)(ReactTimeout(Mods))
