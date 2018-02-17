import React from 'react'
import PropTypes from 'prop-types'
import { createSelector } from 'reselect'
import { connect } from 'react-redux'
import ReactTimeout from 'react-timeout'
import actions from '../../../actions/guild_squads'
import List from './List'
import Loader from '../../Loader'
import Filtering from '../../Layout/filtering'


class Builder extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      active: [],
      phrase: '',
      saving: false,
    }
  }

  componentDidMount() {
    if (undefined !== this.props.match.params.id) {
      this.props.getCollection(this.props.match.params.id).then(() => {
        const active = []
        const chars = this.props.characters
        this.props.squad.map(
           character =>
             chars.map(char => (char.id === character.character.id ? active.push(char) : null)),
         )

        this.setState({
          active,
        })
      })
    }
  }

  handleFiltering = (e) => {
    this.setState({
      phrase: e.target.value,
    })
  }

  save = () => {
    const params = []
    this.state.active.map(item => params.push(item.id))
    this.props.saveSquad(this.props.match.params.id, {
      collection: params,
    })
    this.setState({saving: true})
    this.props.setTimeout(() => this.setState({saving: false}), 1000)
  }

  toggleHandle = (elem) => {
    if (this.state.active.filter(item => item.id === elem.id).length === 0) {
      const active = this.state.active
      active.push(elem)
      this.setState({
        active,
      })
    } else {
      this.setState({
        active: this.state.active.filter(item => item.id !== elem.id),
      })
    }
  }

  render() {
    if (this.props.isLoading) {
      return <Loader />
    }

    if (this.props.characters.length === 0) {
      return null
    }

    return (
      <div >
        <Filtering handleFiltering={(e) => this.handleFiltering(e)} />
        {
          this.state.saving &&
          <div className={'alert alert-success'}>Squad updated!</div>
        }
        <div className="card">
          <div className="list-group list-group-flush">
            <div className="card-header">
              <h3 className={'pull-left'}>Selected characters</h3>
              {this.state.active.length > 0 &&
                <input
                  type={'submit'}
                  className={'btn btn-info btn-sm pull-right'}
                  onClick={() => this.save()}
                  value={'Save squad'}
                />
              }
            </div>
            <div className="list-group-item">
              <List
                phrase={''}
                chosen
                active={[]}
                characters={this.state.active}
                toggleHandle={this.toggleHandle}
              />
            </div>
          </div>
        </div>
        <div className="card mt-5">
          <div className="list-group list-group-flush">
            <div className="card-header">
              <h3>Your collection</h3>
            </div>
            <div className="list-group-item">
              <List
                active={this.state.active}
                phrase={this.state.phrase}
                characters={this.props.characters}
                toggleHandle={this.toggleHandle}
              />
            </div>
          </div>
        </div>
      </div>
    )
  }
}

const getCharacters = () => state => state.character.characters
const getSquads = () => state => state.guild_squads.squad
const checkLoading = () => state => state.guild_squads.isLoading

const selector = createSelector(
  [getCharacters(), getSquads(), checkLoading()],
  (characters, squad, isLoading) => ({
    characters,
    squad,
    isLoading,
  }),
)

function mapStateToProps(state) {
  return selector(state)
}

const mapDispatchToProps = {
  saveSquad: actions.updateCollection,
  getCollection: actions.getCollection,
}

Builder.defaultProps = {
  isLoading: false,
}

Builder.propTypes = {
  saveSquad: PropTypes.func.isRequired,
  getSquad: PropTypes.func.isRequired,
  match: PropTypes.shape.isRequired,
  characters: PropTypes.shape.isRequired,
  squad: PropTypes.shape.isRequired,
  isLoading: PropTypes.bool,
  getCollection: PropTypes.func.isRequired,
  setTimeout: PropTypes.func.isRequired,
}

export default connect(mapStateToProps, mapDispatchToProps)(ReactTimeout(Builder))
