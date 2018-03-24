import React from 'react'
import uuid from 'uuid'
import ReactTimeout from 'react-timeout'
import { Button } from 'react-bootstrap'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import Prototype from './Prototype'
import actions from '../../actions/mods'
import Loader from '../../components/Loader'
import Buttons from './Prototype/components/Buttons'

class Mods extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      stats: [],
    }

    this.protRef = null;
    this.number = 0;
  }

  componentDidMount() {
    this.props.getModsSettings();
    this.props.getMods().then((response) => {
      if (this.props.mods) {
        const mods = this.props.mods.mods
        this.setState({
          stats: mods,
        })
      }
    })
  }

  handleUpdateMod = (number, state) => {
    let updatedStats = this.state.stats
    const stats = this.state.stats
    updatedStats[number] = state
    this.setState({
      stats: updatedStats
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

    Object.keys(stats).map(key => {
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

  save = () => {
    this.props.saveMods(this.getStats())
  }

  getStats(stats = null) {
    const params = [];
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
    this.props.generate();
  }

  synchronizeMods = () => {
    this.props.synchronizeMods().then(() => {
    })
  }

  render() {
    if (this.props.isLoading) {
      return <Loader />
    }

    return (
      <div >
        <div className="row">

          <divstats className="col-12">
            <button className={'btn btn-default mr-20'} onClick={this.addPrototype}>+ Add mod</button>
            <button className={'btn btn-info'} onClick={this.synchronizeMods}>Synchronize mods</button>
          </divstats>
          <Buttons>
            <Button className={'btn btn-primary mr-20'} onClick={this.save}>Save</Button>
            <Button className={'btn btn-success'} onClick={this.generate}>Generate mods</Button>
          </Buttons>
          <div className="col-12">
            {Object.keys(this.state.stats).map(number =>
              <Prototype
                templates={this.state.stats}
                handleUpdateMod={this.handleUpdateMod}
                data={this.state.stats[number]}
                removePrototype={this.removePrototype}
                generated={this.props.generated ? this.props.generated[number] : {}}
                number={number}
              />
            )}
          </div>
        </div>
      </div>
    )
  }
}

const getModsSettings = () => state => state.mods.settings
const getUserMods = () => state => state.mods.mods
const getGeneratedMods = () => state => state.mods.generated

const selector = createSelector(
  [getModsSettings(), getUserMods(), getGeneratedMods()],
  (settings, mods, generated) => ({
    settings, mods, generated,
  }),
)

function mapStateToProps(state) {
  return {
    mods: selector(state),
  }
}

const mapStateToProps2 = state => ({
  mods: state.mods !== undefined ? state.mods.mods : {},
  settings: state.mods !== undefined ? state.mods.settings : {},
  generated: state.mods !== undefined ? state.mods.generated : {},
})

const mapDispatchToProps = {
  getModsSettings: actions.getSettings,
  saveMods: actions.saveMods,
  getMods: actions.getMods,
  generate: actions.generate,
  synchronizeMods: actions.synchronizeMods,
}

export default connect(mapStateToProps, mapDispatchToProps)(ReactTimeout(Mods))
