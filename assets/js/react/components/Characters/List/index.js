import React from 'react';
import Item from './Item';

class List extends React.Component {
  constructor(props) {
    super(props);

    // this.state = {
    //   characters: {},
    // };
  }

  render() {
    if (this.props.characters.length === 0) {
      return (<div></div>);
    }

    //this.setState({
      //characters: this.props.characters,
    //});
console.log(this.props.phrase);

    var items = this.props.characters;
    if (this.props.phrase !== '') {
      items = items.filter(character => character.name.toLowerCase().indexOf(this.props.phrase) > -1);
    }

//console.log(this.props.characters.filter(character => character.name.indexOf(action.payload) > -1);
    return (
      <div className="row">
        {items.map((item) => <Item key={item.code} item={item} />)}
      </div>
    );
  }
};

export default List;
