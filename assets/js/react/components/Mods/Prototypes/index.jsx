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
    console.log('props', props);
  }

  render() {
    console.log('this.prop.data', this.props);
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
