import React from 'react'
import { connect } from 'react-redux'
import { FormGroup, FormControl, ControlLabel, HelpBlock } from 'react-bootstrap'

class Selectors extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
    }
  }

  render() {
    const { mods: { stats } } = this.props
    return (
      <div className={'col-sm-6 col-md-8'}>
        <FormGroup
          controlId="formBasicText"
        >
          <ControlLabel>Primary</ControlLabel>
          <FormGroup controlId="primaryStat">
            <ControlLabel>Select</ControlLabel>
            <FormControl componentClass="select" placeholder="select">
              <option value="select">select</option>
              {Object.keys(stats).map((key) => <option value="{key}">{stats[key]}</option>)}
            </FormControl>
          </FormGroup>

          <HelpBlock>Validation is based on string length.</HelpBlock>
        </FormGroup>
      </div>
    )
  }
}

const mapStateToProps = state => ({
  mods: state.mods.settings,
})

export default connect(mapStateToProps, null)(Selectors)
