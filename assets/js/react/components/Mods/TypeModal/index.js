import React from 'react'
import { Modal, Button, ButtonGroup } from 'react-bootstrap'
import { connect } from 'react-redux'
import actions from '../../../actions/user_squad_group'
import StatContainer from './StatContainer'
import Stat from './Stat'

class Example extends React.Component {
  constructor(props, context) {
    super(props, context);

    this.state = {
      show: false,
      active: -1,
    };
  }

  handleClose = () => {
    this.props.handleModalClose()
  }

  toggleStat = (active) => {
    this.props.handleModalClose(active)
  }

  render() {
    const { mods: { images, stats } } = this.props
    if (!images || !stats) {
      return <div>loadins</div>
    }

    return (
      <div>
        <p>Click to get the full Modal experience!</p>

        <Modal show onHide={this.handleClose} animation={false}>
          <Modal.Header closeButton>
            <Modal.Title>Modal heading</Modal.Title>
          </Modal.Header>
          <Modal.Body>
            <StatContainer>
              {Object.keys(images).map((key) =>
                <Stat
                  className={'btn btn-sm btn-default'}
                  active={this.state.active === key}
                  onClick={() => this.toggleStat(key)}
                >
                  <img src={images[key]} width={'30'}  />
                </Stat>
              )}
            </StatContainer>
          </Modal.Body>
          <Modal.Footer>
            <Button onClick={this.handleClose}>Close</Button>
          </Modal.Footer>
        </Modal>
      </div>
    );
  }
}

const mapStateToProps = state => ({
  mods: state.mods.settings,
})

export default connect(mapStateToProps, null)(Example)
