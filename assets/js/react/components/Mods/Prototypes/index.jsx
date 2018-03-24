import React from 'react'
import FontAwesome from 'react-fontawesome'
import { connect } from 'react-redux'
import Prototype from '../Prototype'

class Prototypes extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
    }
  }

  componentDidMount(props) {
  }

  render() {
    return (
      <div >
        test
      </div>
    )
  }
}

const mapStateToProps = state => ({
  mods: state.mods.settings,
  templates: state.mods.mods,
  generated: state.mods.generated,
})

export default connect(mapStateToProps, null)(Prototypes)
