import React from 'react'
import { connect } from 'react-redux'
import { FormGroup, FormControl, ControlLabel, HelpBlock } from 'react-bootstrap'

class Selectors extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
    }
  }

  changePrimary = (e) => {
    e.preventDefault()
    this.props.changePrimary(e.target.value)
  }

  changeSecondary = (e) => {
    e.preventDefault()
    this.props.changeSecondary(e.target.value)
  }

  render() {
    const { mods: { stats } } = this.props

    return (
      <FormGroup
        controlId="formBasicText"
      >
        <FormGroup controlId="primaryStat">
          <ControlLabel>Primary</ControlLabel>
          <FormControl componentClass="select" onChange={this.changePrimary} placeholder="select">
            <option value="select">select</option>
            {Object.keys(stats).map((key) => <option selected={this.props.primary === key ? 'selected' : ''} value={key}>{stats[key]}</option>)}
          </FormControl>
        </FormGroup>

        <FormGroup controlId="secondaryStat">
          <ControlLabel>Secondary</ControlLabel>
          <FormControl componentClass="select" onChange={this.changeSecondary} placeholder="select">
            <option value="select">select</option>
            {Object.keys(stats).map((key) => <option selected={this.props.secondary === key ? 'selected' : ''} value={key}>{stats[key]}</option>)}
          </FormControl>
        </FormGroup>
      </FormGroup>
    )
  }
}

const mapStateToProps = state => ({
  mods: state.mods.settings,
})

export default connect(mapStateToProps, null)(Selectors)
