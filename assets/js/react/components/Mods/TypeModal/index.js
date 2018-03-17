import React from 'react'
import { Modal, Button, FormGroup, FormControl, ControlLabel } from 'react-bootstrap'
import { connect } from 'react-redux'
import TypeContainer from './components/TypeContainer'
import Stat from './components/Stat'

class Example extends React.Component {
  constructor(props, context) {
    super(props, context)

    this.state = {
      active: -1,
      mod: null,
      primary: null,
      secondary: null,
    }
  }

  handleClose = () => {
    this.props.handleModalClose()
  }

  changeMod = (mod) => {
    this.setState({
      mod,
      active: mod,
    })
  }

  changePrimary = (e) => {
    this.setState({
      primary: e.target.value,
    })
  }

  changeSecondary = (e) => {
    this.setState({
      secondary: e.target.value,
    })
  }

  saveModStats = () => {
    this.props.saveStat({
      mod: this.state.mod,
      primary: this.state.primary,
      secondary: this.state.secondary,
    })
  }

  render() {
    const { mods: { images, stats, primaryStats, secondaryStats } } = this.props
    if (!images || !stats) {
      return <div>loadins</div>
    }
    console.log('this.state.active', this.state.active);
    console.log('this.props', this.props);

    return (
      <div>
        <Modal show onHide={this.handleClose} animation={false}>
          <Modal.Header closeButton>
            <Modal.Title>Change mod</Modal.Title>
          </Modal.Header>
          <Modal.Body>
            <TypeContainer>
              {Object.keys(images).map(key =>
                <Stat
                  className={'btn btn-sm btn-default'}
                  active={this.state.active === key}
                  onClick={() => this.changeMod(key)}
                >
                  <img src={images[key]} width={'30'} />
                </Stat>,
              )}
            </TypeContainer>
            <FormGroup
              controlId="formBasicText"
            >
              <FormGroup controlId="primaryStat">
                <ControlLabel>Primary</ControlLabel>
                <FormControl componentClass="select" onClick={this.changePrimary} placeholder="select">
                  <option value="select">select</option>
                  {Object.keys(primaryStats).map(key => <option selected={this.props.primary === key ? 'selected' : ''} value={key}>{primaryStats[key]}</option>)}
                </FormControl>
              </FormGroup>
              <FormGroup controlId="secondaryStat">
                <ControlLabel>Secondary</ControlLabel>
                <FormControl componentClass="select" onClick={this.changeSecondary} placeholder="select">
                  <option value="select">select</option>
                  {Object.keys(secondaryStats).map(key => <option selected={this.props.secondary === key ? 'selected' : ''} value={key}>{secondaryStats[key]}</option>)}
                </FormControl>
              </FormGroup>
            </FormGroup>
          </Modal.Body>
          <Modal.Footer>
            <Button className={'btn btn-success'} onClick={this.saveModStats}>Save</Button>
            <Button onClick={this.handleClose}>Close</Button>
          </Modal.Footer>
        </Modal>
      </div>
    )
  }
}

const mapStateToProps = state => ({
  mods: state.mods.settings,
})

export default connect(mapStateToProps, null)(Example)
