import React from 'react';
import { Link } from 'react-router';
import Title from './Title';
import StyledItem from './StyledItem';
import Outer from './Outer';

class Item extends React.Component {
  render() {
    const item = this.props.item;

    return (
      <Outer className="col-xs-12">
        <StyledItem>
          <Title>
            <Link to={'/users/' + item.code}>{item.name}</Link>
          </Title>
        </StyledItem>
      </Outer>
    );
  }
}

export default Item;
