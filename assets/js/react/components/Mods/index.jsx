import React from 'react'
import { connect } from 'react-redux'
import { createSelector } from 'reselect'
import Prototype from './Prototype'
import actions from '../../actions/mods'
import Loader from '../../components/Loader'
import { Button } from 'react-bootstrap'

class Mods extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      mods: [],
      stats: [],
    }

    props.getModsSettings();
    this.protRef = null;
    this.number = 0;
  }

  componentDidMount() {
    this.props.getMods().then(() => {
      if (this.props.mods) {
        this.setState({
          stats: this.props.mods.mods,
        })
        this.props.mods.mods.map((map, key) => this.addPrototype(key, map))
      }
    })
  }

  handleUpdateMod = (number, state) => {
    const updatedSatats = this.state.stats
    updatedSatats[number] = state
    this.setState({
      stats: updatedSatats
    })
  }

  addPrototype = (key, map) => {
    const mods = this.state.mods
    const number = this.number++
    
    mods.push(<Prototype update={this.handleUpdateMod} data={map} number={number} />)

    this.setState({
      mods,
    })
  }

  save = () => {
    const params = [];
    const maps = this.state.stats
    Object.keys(maps).map(key => params.push({
      stats: maps[key].stats,
      primary: maps[key].primary,
      secondary: maps[key].secondary,
    }))

    this.props.saveMods(params)
  }

  render() {
    if (this.props.isLoading) {
      return <Loader />
    }

    return (
      <div >
        <div className="container">
          <div className="col-12">
            <button className={'btn btn-default'} onClick={this.addPrototype}>+ Add mod</button>
          </div>
          <div className="col-12">
              {Object.keys(this.state.mods).length > 0 &&
              this.state.mods.filter(item => <div>{item}</div>)}
            <Button className={'btn btn-info'} onClick={this.save}>Save</Button>
          </div>
        </div>
      </div>
    )
  }
}

const getModsSettings = () => state => state.mods.settings
const getUserMods = () => state => state.mods.mods

const selector = createSelector(
  [getModsSettings(), getUserMods()],
  (settings, mods) => ({
    settings, mods
  }),
)

function mapStateToProps(state) {
  return {
    mods: selector(state),
  }
}

const mapDispatchToProps = {
  getModsSettings: actions.getSettings,
  saveMods: actions.saveMods,
  getMods: actions.getMods,
}

export default connect(mapStateToProps, mapDispatchToProps)(Mods)
