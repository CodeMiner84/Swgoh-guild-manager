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
    this.addPrototype()
  }

  handleUpdateMod = (number, state) => {
    let updatedSatats = this.state.stats
    updatedSatats[number] = state
    this.setState({
      stats: updatedSatats
    })
  }

  addPrototype = () => {
    const mods = this.state.mods
    const number = this.number++
    mods.push(<Prototype update={this.handleUpdateMod} test={123} number={number} />)

    this.setState({
      mods,
    })
  }

  save = () => {
    console.log('this.state', this.state.stats);
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

const getModsSettings = state => state.mods.settings

const selector = createSelector(
  getModsSettings,
  settings => settings,
)

function mapStateToProps(state) {
  return {
    mods: selector(state),
  }
}

const mapDispatchToProps = {
  getModsSettings: actions.getSettings,
}

export default connect(mapStateToProps, mapDispatchToProps)(Mods)
