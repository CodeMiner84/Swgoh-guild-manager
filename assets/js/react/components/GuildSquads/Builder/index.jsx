import React from 'react'
import { connect } from 'react-redux'
import actions from "../../../actions/guild_squads";

class Builder extends React.Component {

  render() {

    console.log('props', this.props);

    return (
      <div >
        <h3>Active items</h3>

        <h3>Collection</h3>


      </div>
    )
  }
}


function mapStateToProps(state) {
  console.log('state', state);
  return {
    collection: state.account,
  }
}

const mapDispatchToProps = {

}

export default connect(mapStateToProps, mapDispatchToProps)(Builder)
