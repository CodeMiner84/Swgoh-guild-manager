import React from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { withRouter } from 'react-router-dom'
import { WithContext as ReactTags } from 'react-tag-input'
import Tag from './Tag'
import TagLabel from './TagLabel'
import actions from '../../../../actions/character'

class Exclude extends React.Component {

  constructor(props) {
    super(props)

    this.state = {
      tags: [],
      suggestions: [],
      characters: [],
    }
    this.handleDelete = this.handleDelete.bind(this)
    this.handleAddition = this.handleAddition.bind(this)
    this.handleDrag = this.handleDrag.bind(this)
  }

  componentDidMount() {
    this.props.getAll().then(() => {
    const toons = this.props.characters || []
    const tags = []
      if (Object.keys(toons).length > 0) {
        const suggestions = []
        const characters = []
        Object.keys(toons)
          .map((key) => {
            suggestions.push(toons[key].name)
            characters[toons[key].name] = toons[key].id

            Object.keys(this.props.excluded)
              .filter(exKey => {
                if (this.props.excluded[exKey] === toons[key].id) {
                  tags.push({
                    id: toons[key].id,
                    text: toons[key].name,
                  });
                }
              })
          })

        this.props.excludeCharacters(this.props.excluded);

        this.setState({
          suggestions,
          characters,
          tags,
        })
      }
    })
  }

  handleDelete(i) {
    const tags = this.state.tags
    tags.splice(i, 1)
    this.setState({ tags })

    const list = []
    Object.keys(tags).map(key => list.push(this.state.characters[tags[key].text]))
    this.props.excludeCharacters(list);
  }

  handleAddition(tag) {
    const tags = this.state.tags
    tags.push({
      id: tags.length + 1,
      text: tag,
    })
    this.setState({ tags })
    const list = []
    Object.keys(tags).map(key => list.push(this.state.characters[tags[key].text]))

    this.props.excludeCharacters(list);
  }

  handleDrag(tag, currPos, newPos) {
    const tags = this.state.tags

    // mutate array
    tags.splice(currPos, 1)
    tags.splice(newPos, 0, tag)

    // re-render
    this.setState({ tags })
  }

  handleSuggestion = (textInputValue, possibleSuggestionsArray) =>
    possibleSuggestionsArray.filter(
      suggestion => suggestion.toLowerCase().includes(textInputValue.toLowerCase())
    )

  render() {
    const { tags, suggestions } = this.state
    return (
      <Tag>
        <TagLabel>Type character to exclude from mods:</TagLabel>
        <div className="tagsContainer">
          <ReactTags
            classNames={{
              tags: 'tags',
              tagInput: 'tagInput',
              tagInputField: 'tagInputField',
              selected: 'selected',
              tag: 'tag',
              remove: 'remove',
              suggestions: 'suggestions',
              activeSuggestion: 'activeSuggestion',
            }}
            tags={tags}
            placeholder={'Type character name'}
            suggestions={suggestions}
            handleDelete={this.handleDelete}
            handleAddition={this.handleAddition}
            handleDrag={this.handleDrag}
            handleFilterSuggestions={
              (textInputValue, possibleSuggestionsArray) =>
                this.handleSuggestion(textInputValue, possibleSuggestionsArray)
            }

          />
        </div>
      </Tag>
    )
  }
}

Exclude.defaultProps = {
  excludeCharacters: () => {},
  characters: [],
};

Exclude.propTypes = {
  excludeCharacters: PropTypes.func,
  characters: PropTypes.arrayOf(PropTypes.shape()),
};


function mapStateToProps(state) {
  return {
    characters: state.character.characters,
  };
}

const mapDispatchToProps = {
  getAll: actions.fetchCharacters,
};

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(Exclude));
